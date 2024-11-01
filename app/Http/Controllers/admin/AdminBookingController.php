<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Mail\ApproveNotification;
use App\Mail\DeclineNotification;
use App\Mail\UpdateMeetingLinkNotification as MailUpdateMeetingLinkNotification;
use App\Models\admin\VisitorModel;
use App\Models\AuditTrailModel;
use App\Models\BookingVisitor;
use App\Models\BookVisitationModel;
use App\Models\ExcludeBookModel;
use App\Models\user_verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminBookingController extends Controller
{
    public function get_booking_per_type($type){
        $get_booking = BookingVisitor::leftJoin('book_visitation as b', 'booking_visitor.booking_id', '=', 'b.id')
            ->leftJoin('pdl_data as c', 'c.id', '=', 'b.pdl_id')
            ->select(
                DB::raw('MD5(b.id) as bookID'),
                'b.status',
                'b.type',
                'b.valid_id',
                'b.verification_docs',
                'c.name as pdl_name',
                'b.transaction_number',
                'b.meeting_link as link',
                DB::raw('DATE(b.start_visit) as date'),
                DB::raw('CONCAT(b.start_time, " - ", b.end_time) as time')
            );
        if($type == "Virtual visit") {
            $get_booking = $get_booking->where('b.type', 'Virtual');
        } else {
            $get_booking = $get_booking->where('b.type', 'Physical');
        }
        $get_booking = $get_booking->groupBy('bookID') // Group by booking_id
        ->get();
        return response()->json($get_booking);
    }
    public function get_custom_booking(Request $request) {
        $get_custom_booking = ExcludeBookModel::where('pdlID', $request->input('pdl_id'))
            ->where('is_deleted', 0)->get();
        return response()->json($get_custom_booking);
    }
    public function custom_booking_submit(Request $request) {
        $request->validate([
            'pdl_id' => 'required|integer',
            'visitorID' => 'required|integer',
            'book_date' => 'required|date',
            'remark' => 'nullable|string',
            'book_type' => 'required|string|in:Physical,Virtual',
        ]);
        // Prepare the data to insert
        $data = [
            'userID' => auth()->user()->id, // Assuming the user is authenticated and we want to store the current user ID
            'pdlID' => $request->input('pdl_id'),
            'transaction_number' => 'book-'.uniqid(), // Generate a unique transaction number
            'type' => $request->input('book_type'),
            'start_event' => $request->input('book_date'),
            'remark' => $request->input('remark'),
            'is_deleted' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        
        // get visitor
        $visitors = VisitorModel::where('pdlID',$request->input('pdl_id'))->get()->toArray();
        
        if(!empty($visitors)) {
            foreach($visitors as $visitor) {
                $userID = $visitor['userID'];
                NotificationController::make_notification($userID,'Add custom booking', 'add custom booking for pdlID: ' . $request->pdl_id . ' for userID: ' . $request->userID, 'custom booking', 0);
            }
        }
        
        $loggedInUser = Auth::user();
        DB::table('excluded_booking')->insert($data);
        AuditTrailModel::create([
            'userID' => $loggedInUser->id,
            'user_email' => $loggedInUser->email,
            'action' => 'add custom booking',
            'description' => 'add custom booking for pdlID: ' . $request->pdl_id . ' for userID: ' . $request->userID,
            'ip_address' => $request->ip(),
        ]);
        return response()->json(['message' => 'Booking successfully saved.']);
    }
    public function custom_booking_delete($id) {
        $booking = ExcludeBookModel::where('id', $id)->first();
        if($booking) {
            $booking->is_deleted = 1; 
            $booking->save();
        }
        $loggedInUser = Auth::user();
        AuditTrailModel::create([
            'userID' => $loggedInUser->id,
            'user_email' => $loggedInUser->email,
            'action' => 'delete custom booking',
            'description' => 'custom booking id: ' . $id . ' is deleted.',
            'ip_address' => request()->ip(),
        ]);
        return response()->json(['status' => 'success', 'message' => 'Record Deleted']);
    }
    public function get_booking($transaction_number = null, $bookID = null){
        $get_booking = BookingVisitor::leftJoin('book_visitation as b', 'booking_visitor.booking_id', '=', 'b.id')
            ->leftJoin('pdl_data as c', 'c.id', '=', 'b.pdl_id')
            ->select(
                DB::raw('MD5(b.id) as bookID'),
                'b.status',
                'b.type',
                'b.valid_id',
                'b.verification_docs',
                'c.name as pdl_name',
                'b.transaction_number',
                'b.link_type',
                'b.meeting_link',
                DB::raw('DATE(b.start_visit) as date'),
                DB::raw('CONCAT(b.start_time, " - ", b.end_time) as time')
            );

        if ($transaction_number != null && $bookID != null) {
            $get_booking = $get_booking->whereRaw('MD5(b.id) = ?', [$bookID])->first();
                
            // get visitors 
            $get_visitors = BookingVisitor::leftJoin('book_visitation as b', 'booking_visitor.booking_id', '=', 'b.id')
                ->leftJoin('pdl_data as c', 'c.id', '=', 'b.pdl_id')
                ->leftJoin('users as d', 'd.id', '=', 'booking_visitor.visitor_id')
                ->where('transaction_number', $transaction_number)
                ->whereRaw('MD5(b.id) = ?', [$bookID])
                ->select('d.name')->get();
            $html = view('admin.pages.bookings.booking_detail', [
                'bookingDetail' => $get_booking,
                'visitors' => $get_visitors
            ])->render();
            return response()->json($html);
        }
        $get_booking = $get_booking->get();
        return response()->json($get_booking);
    }
    public function cancel_booking(Request $request) {
        $transaction_number = $request->input('transaction_number');
        $bookID = $request->input('bookID');
        $reason = $request->input('reason');

        // Find the booking and update the status to canceled
        $booking = BookVisitationModel::where('transaction_number', $transaction_number)
            ->whereRaw('MD5(id) = ?', [$bookID])
            ->first();

        if ($booking) {
            $booking->status = 3; // Assuming 3 is the status for declined
            $booking->cancel_reason = $reason;
            $booking->save();

            // Get the PDL name
            $pdl_data = DB::table('pdl_data')->where('id', $booking->pdl_id)->first();

            // Prepare booking details for the email
            $bookingDetails = [
                'transaction_number' => $transaction_number,
                'pdl_name' => $pdl_data->name,
                'date' => $booking->start_visit,
                'time' => $booking->start_time . ' - ' . $booking->end_time,
                'type' => $booking->type,
            ];
            // Get visitor emails
            $visitorEmails = BookingVisitor::where('booking_id', $booking->id)
                ->leftJoin('users', 'booking_visitor.visitor_id', '=', 'users.id')
                ->select('booking_visitor.visitor_id', 'users.email')->get()
                ->toArray();

            // Send cancellation email notification to each visitor
            $email_arr = [];
            foreach ($visitorEmails as $visitor) {
                $email_arr[] = $visitor['email'];
                NotificationController::make_notification($visitor['visitor_id'],'Booking Declined', 'Booking declined with transaction number: ' . $transaction_number . ' and reason: ' . $reason, 'booking', 0);
            }
            Mail::to($email_arr)
                ->cc($email_arr)
                ->send(new DeclineNotification($bookingDetails, $reason));

            AuditTrailModel::create([
                'userID' => Auth::id(),
                'user_email' => Auth::user()->email,
                'action' => 'Booking Declined',
                'description' => 'Booking declined with transaction number: ' . $transaction_number . ' and reason: ' . $reason,
                'ip_address' => $request->ip(),
            ]);
            return response()->json(['status' => 'success', 'message' => 'Booking declined successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Booking not found'], 404);
        }
    }
    public function approve_booking(Request $request) {
        $transaction_number = $request->input('transaction_number');
        $bookID = $request->input('bookID');

        $booking = BookVisitationModel::where('transaction_number', $transaction_number)
            ->whereRaw('MD5(id) = ?', [$bookID])
            ->first();

        if ($booking) {
            $booking->status = 1; // Assuming 1 is the status for approved
            $booking->save();
            // Get the PDL name
            $pdl_data = DB::table('pdl_data')->where('id', $booking->pdl_id)->first();

            // Prepare booking details for the email
            $bookingDetails = [
                'transaction_number' => $transaction_number,
                'pdl_name' => $pdl_data->name,
                'date' => $booking->start_visit,
                'time' => $booking->start_time . ' - ' . $booking->end_time,
                'type' => $booking->type,
            ];
            // Get visitor emails
            $visitorEmails = BookingVisitor::where('booking_id', $booking->id)
                ->leftJoin('users', 'booking_visitor.visitor_id', '=', 'users.id')
                ->select('booking_visitor.visitor_id', 'users.email')->get()
                ->toArray();

            // Send cancellation email notification to each visitor
            $email_arr = [];
            foreach ($visitorEmails as $visitor) {
                $email_arr[] = $visitor['email'];
                NotificationController::make_notification($visitor['visitor_id'],'Booking Approved', 'Booking approved with transaction number: ' . $transaction_number, 'booking', 0);
            }
            Mail::to($email_arr)
            ->cc($email_arr)
            ->send(new ApproveNotification($bookingDetails));
            AuditTrailModel::create([
                'userID' => Auth::id(),
                'user_email' => Auth::user()->email,
                'action' => 'Booking Approved',
                'description' => 'Booking approved with transaction number: ' . $transaction_number,
                'ip_address' => $request->ip(),
            ]);
            return response()->json(['status' => 'success', 'message' => 'Booking approved successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Booking not found'], 404);
        }
    }
    public function update_meeting_link(Request $request) {
        $request->validate([
            'bookID' => 'required',
            'link_type' => 'required',
            'meeting_link' => 'required',
        ]);
        $bookID = $request->bookID ?? '';
        $link_type = $request->link_type;
        $meeting_link = $request->meeting_link;
        $booking = BookVisitationModel::whereRaw('MD5(id) = ?', [$bookID])->first();
        if ($booking) {
            $booking->link_type = $link_type;
            $booking->meeting_link = $meeting_link;
            $booking->save();
            $transaction_number = $booking->transaction_number ?? '';
            // Prepare booking details for the email
            $bookingDetails = [
                'transaction_number' => $transaction_number,
                'date' => $booking->start_visit,
                'time' => $booking->start_time . ' - ' . $booking->end_time,
                'type' => $booking->type,
                'link_type' => $link_type,
                'meeting_link' => $meeting_link,
            ];
            // Get visitor emails
            $visitorEmails = BookingVisitor::where('booking_id', $booking->id)
                ->leftJoin('users', 'booking_visitor.visitor_id', '=', 'users.id')
                ->select('booking_visitor.visitor_id', 'users.email')->get()
                ->toArray();
            // Send email notification to each visitor
            $email_arr = [];
            foreach ($visitorEmails as $visitor) {
                $email_arr[] = $visitor['email'];
                NotificationController::make_notification($visitor['visitor_id'],'Booking Link/Code Add', 'Update booking link/code transaction number: ' . $transaction_number, 'booking', 0);
            }
            Mail::to($email_arr)
                ->cc($email_arr)
                ->send(new MailUpdateMeetingLinkNotification($bookingDetails));
            AuditTrailModel::create([
                'userID' => Auth::id(),
                'user_email' => Auth::user()->email,
                'action' => 'Booking Link/Code Add',
                'description' => 'Update booking link/code transaction number: ' . $transaction_number,
                'ip_address' => $request->ip(),
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Booking not found'], 404);
        }
        
        return response()->json(['status' => 'success', 'message' => '']);
    }
    public function get_visitation_of_pdl(Request $request) {
        $get_booking = BookingVisitor::leftJoin('book_visitation as b', 'booking_visitor.booking_id', '=', 'b.id')
        ->leftJoin('users as c', 'c.id', '=', 'booking_visitor.visitor_id')
        ->select(
            DB::raw('MD5(b.id) as bookID'),
            'b.status',
            'b.type',
            'b.valid_id',
            'b.verification_docs',
            'b.transaction_number',
            'b.link_type',
            'b.meeting_link',
            DB::raw('DATE(b.start_visit) as date'),
            DB::raw('CONCAT(b.start_time, " - ", b.end_time) as time')
        );
        $get_booking = $get_booking->where('b.pdl_id', $request->pdl_id);
        $get_booking = $get_booking->groupBy('bookID'); // Group by booking_id
        
        $get_booking = $get_booking->get();
        return response()->json($get_booking);
    }
    public function get_pendings() {
        $counts = BookVisitationModel::select(
            DB::raw('COUNT(CASE WHEN type = "physical" THEN 1 END) as physical_count_pending'),
            DB::raw('COUNT(CASE WHEN type = "virtual" THEN 1 END) as virtual_count_panding')
        )->where('status', 0)
         ->first();
    
        return response()->json([
            'physical' => $counts->physical_count ?? 0,
            'virtual' => $counts->virtual_count ?? 0
        ]);
    }
}
