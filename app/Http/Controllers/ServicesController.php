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
        return view('user.pages.services');
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
