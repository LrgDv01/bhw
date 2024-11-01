<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\SlotModel;
use App\Models\AuditTrailModel;
use App\Models\BookingVisitor;
use App\Models\BookVisitationModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CallendarController extends Controller
{
    public function index()
    {
        $events = SlotModel::all()->map(function ($event) {
            if($event->title != "Blocked") {
                $title = 'Onsite visit (' . $event->slots . ' slots) and virtual visit (' . $event->virtual_slots . ' slots)';
            } else {
                $title = $event->title;
            }
        
            return [
                'id' => $event->id,
                'title' => $title,
                'start' => $event->start,
                'end' => $event->end,
                'color' => $event->color,
            ];
        });
        return response()->json($events);
    }
    public function getDates()
    {
        // Assuming you have a model called CalendarModel to fetch blocked dates
        $blockedDates = SlotModel::where('title', 'Blocked')->get()->pluck('start')->map(function ($date) {
            return Carbon::parse($date)->format('Y-m-d');
        });
        
        $SlotDates = SlotModel::where('title', 'Maximum Slot')->get()->pluck('start')->map(function ($date) {
            return Carbon::parse($date)->format('Y-m-d');
        });
        
        $ret = [
            'block' => $blockedDates,
            'slots' => $SlotDates,
        ];
        
        return response()->json($ret);
    }
    public function blockDates(Request $request)
    {
        $request->validate([
            'dates' => 'required|array',
            'dates.*' => 'required|date_format:Y-m-d',
        ]);
        $blockDate = [];
        foreach ($request->dates as $date) {
            $existingDate = SlotModel::where('start', $date)->first();
            if (!$existingDate) {
                SlotModel::create([
                    'title' => 'Blocked',
                    'start' => $date,
                    'end' => $date,
                    'color' => 'red',
                    'slots' => 0,
                    'virtual_slots' => 0
                ]);
            }
            $blockDate[] = $date;
        }
        
        $description = 'No dates were blocked.';
        if (!empty($blockDate)) {
            $blockDateStr = implode(', ', $blockDate);
            $description = 'Add block date(s): ' . $blockDateStr;
        }
    
        AuditTrailModel::create([
            'user_email' => Auth::user()->email,
            'action' => 'add block date',
            'description' => $description,
            'ip_address' => $request->ip(), // Fetch the IP address
        ]);
        return response()->json(['message' => 'Dates blocked successfully!']);
    }
    public function slotDates(Request $request) {
        $request->validate([
            'slots' => 'required|array',
            'slots.*' => 'required|integer|min:1',
            'virtualslot' => 'required|array',
            'virtualslot.*' => 'required|integer|min:1',
        ]);
        $slotsData = $request->slots;
        $virtualSlotsData = $request->virtualslot;
        
        foreach ($slotsData as $date => $slots) {
            $virtualSlots = $virtualSlotsData[$date] ?? 0;
            $existingDate = SlotModel::where('start', $date)->first();
            if(!$existingDate) {
                SlotModel::create([
                    'title' => 'Maximum Slot',
                    'start' => $date,
                    'end' => $date,
                    'color' => 'blue',
                    'slots' => $slots,
                    'virtual_slots' => $virtualSlots,
                ]);
            }
        }
        AuditTrailModel::create([
            'user_email' => Auth::user()->email,
            'action' => 'add block dates',
            'description' => 'Dates with slots added: ' . json_encode($slotsData),
            'ip_address' => $request->ip(),
        ]);
        return response()->json(['message' => 'Dates and slots blocked successfully!']);
    }
    public function deleteEvent(Request $request)
    {
        // Validate the request
        $request->validate([
            'id' => 'required|exists:slot_db,id',
        ]);

        // Find the event by ID
        $event = SlotModel::findOrFail($request->id);
        
        $eventDetails = [
            'title' => $event->title,
            'start' => $event->start,
            'end' => $event->end,
            'color' => $event->color,
        ];
        // Delete the event
        $event->delete();
        
        AuditTrailModel::create([
            'user_email' => Auth::user()->email,
            'action' => 'delete event',
            'description' => 'Deleted event: ' . json_encode($eventDetails),
            'ip_address' => $request->ip(),
        ]);
        // Return a response
        return response()->json(['message' => 'Event deleted successfully']);
    }
    
    public function calendarbook(Request $request) {
        $type = $request->type;
        $events = BookVisitationModel::where('type', $type)->get()->map(function ($event) {
            $title = $event->transaction_number;
            $color = '';
            switch ($event->status) {
                case 0 : 
                    $color = 'yellow';
                    break;
                case 1 : 
                    $color = 'blue';
                    break;
                case 2 : 
                    $color = 'red';
                    break;
            }
            // Combine date and time into a proper datetime format
            $start_date = date('Y-m-d', strtotime($event->start_visit));
            
            $start = $start_date . ' ' . date('H:i:s', strtotime($event->start_time));
            $end = $start_date . ' ' . date('H:i:s', strtotime($event->end_time));
            return [
                'id' => md5($event->id),
                'title' => $title,
                'start' => $start,
                'end' => $end,
                'color' => $color,
            ];
        });
        return response()->json($events);
    }
}
