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
        return view('bhw.pages.services');
    }

    public function list() {
        return view('bhw.pages.list');

    }

    public function schedule() {
        return view('bhw.pages.schedule');

    }

    public function userActivity() {
        return view('bhw.pages.user_activity');
        
    }

    public function updateStatus(Request $request, $id, $status)
    {
        try {
            // Process the status update logic
            $requestDetails = ServicesModel::findOrFail($id);
            $requestDetails->status = $status;
            $requestDetails->save();
    
            return response()->json([
                'success' => true,
                'message' => "Request has been successfully {$status}."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request.'
            ], 500);
        }
    }
    
}
