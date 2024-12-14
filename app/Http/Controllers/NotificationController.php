<?php

namespace App\Http\Controllers;
use App\Models\ServicesModel;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index() {
        $technicianId = auth()->id();
        $notifications = ServicesModel::where('technician_id', $technicianId)
            ->select('id', 'request_id', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.home', compact('notifications'));
    }

    public function viewDetails($id)
    {
        $requestDetails = ServicesModel::with('farms')->findOrFail($id);
        // dd($requestDetails->farm->name);
        return view('user.technician.pages.request_details', compact('requestDetails'));
    }
}
