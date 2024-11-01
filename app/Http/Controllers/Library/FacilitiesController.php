<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\AuditTrailModel;
use App\Models\Library\FacilitiesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FacilitiesController extends Controller
{
    public function index(Request $request) {
        // Filter the audit trails by the provided date
        $facility_data = FacilitiesModel::all();

        // Return the audit trails as a JSON response
        return response()->json($facility_data);
    }
    public function add_facilities_submit(Request $request) {
        $validator = Validator::make($request->all(), [
            'facilities' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            AuditTrailModel::create([
                'userID' => Auth::id(),
                'user_email' => Auth::user()->email,
                'action' => 'add facilities',
                'description' => 'Add facilities failed',
                'ip_address' => $request->ip(), // Fetch the IP address
            ]);
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($request->has('facilities')) {
            $build_input['facility_name'] = $request->input('facilities');
        }
        $build_input['status'] = 'Active';
        FacilitiesModel::create($build_input);
        $description = "Add facilities named : " . $request->input('facilities'); 
        AuditTrailModel::create([
            'userID' => Auth::id(),
            'action' => 'add facilities',
            'description' => $description,
            'ip_address' => $request->ip(), // Fetch the IP address
        ]);
        return response()->json(['message' => $description, "status" => 200]);
    }
    public function update_facility_status(Request $request) {
        $validator = Validator::make($request->all(), [
            'facility_id' => 'required|integer',
            'facility_status' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            AuditTrailModel::create([
                'userID' => Auth::id(),
                'user_email' => Auth::user()->email,
                'action' => 'update facilities',
                'description' => 'Update facilities failed',
                'ip_address' => $request->ip(), // Fetch the IP address
            ]);
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($request->has('facility_status')) {
            $build_input['status'] = $request->input('facility_status');
        }
        $facility = FacilitiesModel::find($request->facility_id);
        if ($facility) {
            $facility->update($build_input);
            AuditTrailModel::create([
                'userID' => Auth::id(),
                'action' => 'update facilities',
                'description' => 'Update the facility status to ' . $build_input['status'],
                'ip_address' => $request->ip(), // Fetch the IP address
            ]);
            return response()->json(['message' => 'Update the facility status to ' . $build_input['status'], "status" => 200]);
        } else {
            // Log if the facility was not found
            AuditTrailModel::create([
                'userID' => Auth::id(),
                'user_email' => Auth::user()->email,
                'action' => 'update facilities',
                'description' => 'Update facilities failed because the facility was not found',
                'ip_address' => $request->ip(),
            ]);
    
            return response()->json(['message' => 'Facility not found', "status" => 404]);
        }
        
    }
}
