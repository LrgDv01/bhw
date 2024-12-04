<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\ServicesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class ServicesController extends Controller
{
    public function index()
    {   
        $technicians = User::where('user_type', 2)->select('id', 'full_name', 'address', 'contact')->get();
        $user = auth()->id();
        $hiredTechnicians = ServicesModel::where('user_id', $user)->pluck('technician_id')->toArray();
        return view('user.pages.services', [
            'technicians' => $technicians,
            'hiredTechnicians' => $hiredTechnicians,
        ]);
    }


    public function hireTechnician(Request $request)
    {
        $request->validate([
            'technician_id' => 'required|integer',
        ]);
        $user_id = auth()->id();
        $farmer_name = auth()->user()->full_name;
        $request_id = rand(10000, 99999);
        $confirmation = new ServicesModel();
        $confirmation->user_id = $user_id;
        $confirmation->technician_id = $request->technician_id; 
        $confirmation->farmer_name = $farmer_name;
        $confirmation->request_id = $request_id;
        $confirmation->status = 'pending';
        $confirmation->save();

         // Add a flash session message for success
        Session::flash('success', 'Account created successfully');
        return response()->json(['success' => true,  'message' => 'Technician hired successfully!']);
    }

    public function hired() {
        $user = auth()->id();
        $hired = ServicesModel::select('technician_id')
            ->where('user_id', $user)
            ->get();
        if ($hired) {
            return response()->json([
                'success' => true,
                'hired' => $hired,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Hired not found'
            ], 404);
        }
    }

    public function status($id, $status) {
        $requestDetails = ServicesModel::findOrFail($id);
        // dd($status);
        // Update the status to 'accepted'
        $requestDetails->status =  $status;
        $requestDetails->save();

        if($status === 'accepted') {
            // Redirect back with a success message
            return redirect()->route('user.notifications')->with($status, 'Request has been accepted successfully.');
        }else if($status === 'declined') {
            // Redirect back with a success message
            return redirect()->route('user.notifications')->with($status, 'Request has been declined successfully.');
        }else {
            return redirect()->route('user.notifications')->with('error', 'Action Unsuccessful !.');
        }
    }

    public function show($id) {

        $technician = User::join('technicians', 'users.id', '=', 'technicians.user_id')
        ->where('users.id', $id)
        ->select('users.*', 'technicians.*')
        ->first();

        if ($technician) {
            return response()->json([
                'success' => true,
                'technician' => $technician
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Technician not found'
            ], 404);
        }
    }


}
