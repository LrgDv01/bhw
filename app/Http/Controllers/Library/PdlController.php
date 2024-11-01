<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\AuditTrailModel;
use App\Models\Library\PdlModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PdlController extends Controller
{
    public function index(Request $request) {
        $query = PdlModel::query();
    
        // Apply gender filter if provided
        if ($request->has('gender') && $request->gender != '') {
            $query->where('gender', $request->gender);
        }
    
        // Apply crime category filter if provided
        if ($request->has('crimeCategory') && $request->crimeCategory != '') {
            $query->where('crimeCategory', $request->crimeCategory);
        }
    
        // Get the filtered data
        $pld_data = $query->get();
    
        // Return the filtered data as a JSON response
        return response()->json($pld_data);
    }
    public function update_pdl_status(Request $request) {
        // Validate the incoming request
        $request->validate([
            'pdl_id' => 'required|integer|exists:pdl_data,id',
            'pdl_status' => 'required', // Assuming status is a boolean
        ]);
        $pdl_data = PdlModel::find($request->pdl_id);
        if (!$pdl_data) {
            return response()->json(['message' => 'PDL data not found'], 404);
        }
        $pdl_data->status = $request->pdl_status;
        $pdl_data->save();
        AuditTrailModel::create([
            'userID' => Auth::id(),
            'user_email' => Auth::user()->email,
            'action' => 'change pdl status',
            'description' => 'update pdl status of pdl: ' .$request->pdl_id . 'to '. $request->pdl_status,
            'ip_address' => $request->ip(), // Fetch the IP address
        ]);
        // Return a success response
        return response()->json(['message' => 'PDL status updated successfully'], 200);
    }
    public function add_pdl_submit(Request $request) {
        // Validate the request data
        $build_input = [];
        $validator = Validator::make($request->all(), [
            'pdl_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'birthday' => 'required|string|max:255',
            'crimeCategory' => 'required|string|max:255',
            'specify_case' => 'required|string',
        ]);
        if ($validator->fails()) {
            AuditTrailModel::create([
                'userID' => Auth::id(),
                'user_email' => Auth::user()->email,
                'action' => 'add pdl',
                'description' => 'Add pdl failed',
                'ip_address' => $request->ip(), // Fetch the IP address
            ]);
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($request->has('pdl_id')) {
            $build_input['pdl_id'] = $request->input('pdl_id');
        }
        if ($request->has('name')) {
            $build_input['name'] = $request->input('name');
        }
        if ($request->has('gender')) {
            $build_input['gender'] = $request->input('gender');
        }
        if ($request->has('birthday')) {
            $build_input['birthday'] = $request->input('birthday');
        }
        if ($request->has('crimeCategory')) {
            $build_input['crimeCategory'] = $request->input('crimeCategory');
        }
        if ($request->has('specify_case')) {
            $build_input['specify_case'] = $request->input('specify_case');
        }
        if ($request->hasFile('pdl_img')) {
            $pdl_imgPath = $request->file('pdl_img')->store('pdl', 'public');
            $build_input['profile_img'] = $pdl_imgPath;
        }
        $build_input['status'] = 'Active';
        $check_record = PdlModel::where('pdl_id', $request->input('pdl_id'))->first();
        if($check_record) {
            AuditTrailModel::create([
                'userID' => Auth::id(),
                'user_email' => Auth::user()->email,
                'action' => 'add pdl',
                'description' => 'Add pdl failed already has record for PDL ID ' . $request->input('pdl_id'),
                'ip_address' => $request->ip(), // Fetch the IP address
            ]);
            return response()->json(['errors' => 'Add pdl failed already has record for PDL ID ' . $request->input('pdl_id')], 422);
        } else {
            PdlModel::create($build_input);
        }
        
        $description = "Add new data in pdl"; 
        AuditTrailModel::create([
            'userID' => Auth::id(),
            'action' => 'add pdl',
            'description' => $description,
            'ip_address' => $request->ip(), // Fetch the IP address
        ]);
        return response()->json(['message' => $description, "status" => 200]);
    }
    
    public function showUpdatePdlData($id) {
        $pdl_data = PdlModel::where('id', $id)->first();
        return view('admin.pages.library.update_pdl', compact('pdl_data'));
    }
    
    public function update_pdl_submit(Request $request) {
        $build_input = [];
        $pdl_data = PdlModel::where('id', $request->input('data_id'))->first();
        $validator = Validator::make($request->all(), [
            'pdl_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'birthday' => 'required|string|max:255',
            'crimeCategory' => 'required|string|max:255',
            'specify_case' => 'required|string',
        ]);
        if ($validator->fails()) {
            AuditTrailModel::create([
                'userID' => Auth::id(),
                'user_email' => Auth::user()->email,
                'action' => 'update pdl',
                'description' => 'Update pdl failed',
                'ip_address' => $request->ip(), // Fetch the IP address
            ]);
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if ($request->has('pdl_id')) {
            $build_input['pdl_id'] = $request->input('pdl_id');
        }
        if ($request->has('name')) {
            $build_input['name'] = $request->input('name');
        }
        if ($request->has('gender')) {
            $build_input['gender'] = $request->input('gender');
        }
        if ($request->has('birthday')) {
            $build_input['birthday'] = $request->input('birthday');
        }
        if ($request->has('crimeCategory')) {
            $build_input['crimeCategory'] = $request->input('crimeCategory');
        }
        if ($request->has('specify_case')) {
            $build_input['specify_case'] = $request->input('specify_case');
        }
        if ($request->hasFile('pdl_img')) {
            // Delete old Profile Img if exists
            if ($pdl_data && $pdl_data->profile_img) {
                Storage::disk('public')->delete($pdl_data->profile_img);
            }
            $pdl_imgPath = $request->file('pdl_img')->store('pdl', 'public');
            $build_input['profile_img'] = $pdl_imgPath;
        }
        $build_input['status'] = $pdl_data->status;
        $pdl_data->update($build_input);       
        
        $description = "Update data for pdl id no. : $pdl_data->pdl_id"; 
        AuditTrailModel::create([
            'userID' => Auth::id(),
            'action' => 'update pdl',
            'description' => $description,
            'ip_address' => $request->ip(), // Fetch the IP address
        ]);
        return response()->json(['message' => $description, "status" => 200]);
    }
}
