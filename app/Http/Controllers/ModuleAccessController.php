<?php

namespace App\Http\Controllers;

use App\Models\AuditTrailModel;
use App\Models\ModuleAccessDetails;
use App\Models\ModuleAccessModel;
use App\Models\User;
use App\Services\ModuleAccessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleAccessController extends Controller
{
    protected $moduleAccessService;
    public function __construct(ModuleAccessService $moduleAccessService)
    {
        $this->moduleAccessService = $moduleAccessService;
    }
    public function checkAccess(Request $request)
    {
        $userID = $request->user()->id;
        $moduleCode = $request->input('module_code');

        if ($this->moduleAccessService->userHasAccess($userID, $moduleCode)) {
            return response()->json(['message' => 'Access granted'], 200);
        } else {
            return response()->json(['message' => 'Access denied'], 403);
        }
    }
    public function display_module_access($id)
    {
        $get_user_module_access = ModuleAccessModel::where('userID', $id)
            ->leftjoin('module_access_details as b', 'b.code', '=', 'module_access_data.module_code')
            ->select('module_access_data.id','module_access_data.module_code', 'b.name as module_name', 'b.description', 'userID')
            ->get()->toArray();
        $get_access_code = [];
        foreach($get_user_module_access as $key => $value) {
            $get_access_code[] = $value['module_code'];
        }
        
        $get_module_access_details = ModuleAccessDetails::all();
        
        $html = view('admin.pages.module_access', [
            'userID' => $id,
            'moduleAccessDetails' => $get_module_access_details,
            'moduleAccess' => $get_user_module_access,
            'access_code' => $get_access_code,
        ])->render();
        return response()->json($html);
    }
    public function add_module_access(Request $request) {
        $validatedData = $request->validate([
            'userID' => 'required|integer',
            'module_code' => 'required|integer',
        ]);
        // Check if the user already has access to this module
        $existingAccess = ModuleAccessModel::where('userID', $validatedData['userID'])
            ->where('module_code', $validatedData['module_code'])
            ->first();
        // Create a new module access record
        $moduleAccess = new ModuleAccessModel();
        $moduleAccess->userID = $validatedData['userID'];
        $moduleAccess->module_code = $validatedData['module_code'];
        $moduleAccess->save();
        $userName = User::find($validatedData['userID'])->name;
        AuditTrailModel::create([
            'userID' => Auth::id(),
            'action' => 'Add module access',
            'description' => 'Added module access for user : '. $userName . ' (' . $validatedData['userID'] . ') and module code: ' . $validatedData['module_code'],
            'ip_address' => $request->ip(), // Fetch the IP address
        ]);
    
        if ($existingAccess) {
            return response()->json(['error' => 'User already has access to this module.'], 400);
        }
        
        // Return a success response
        return response()->json(['message' => 'Module access added successfully', 'id' => $validatedData['userID']]);
    }
    public function delete_module_access($id, $userid) {
        $moduleAccess = ModuleAccessModel::find($id);
        if (!$moduleAccess) {
            return response()->json(['error' => 'Module access not found.'], 404);
        }
        $userName = User::find($userid)->name;
        
        // Fetch IP address using Request facade
        $ipAddress = request()->ip();
        AuditTrailModel::create([
            'userID' => Auth::id(),
            'action' => 'delete module access',
            'description' => 'Deleted module access for user : '. $userName . ' (' . $userid . ') and module code: ' . $moduleAccess->module_code,
            'ip_address' => $ipAddress, // Fetch the IP address
        ]);
    
        $moduleAccess->delete();
    
        return response()->json(['message' => 'Module access deleted successfully.']);
    }
}
