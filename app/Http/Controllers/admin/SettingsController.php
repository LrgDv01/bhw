<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\AppInfoModel;
use App\Models\AuditTrailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function updateapp_info(Request $request) {

        $build_input = [];
        $check_record = AppInfoModel::find(1);
        // Validate and process each input field
        if ($request->has('appname')) {
            $build_input['app_name'] = $request->input('appname');
        }
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($check_record && $check_record->logo) {
                Storage::disk('public')->delete($check_record->logo);
            }
            // Store new logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            $build_input['logo'] = $logoPath;
        }
        if ($request->hasFile('banner')) {
            // Delete old banner if exists
            if ($check_record && $check_record->banner) {
                Storage::disk('public')->delete($check_record->banner);
            }
            // Store new banner
            $bannerPath = $request->file('banner')->store('banners', 'public');
            $build_input['banner'] = $bannerPath;
        }
        if ($request->has('applink')) {
            $build_input['website'] = $request->input('applink');
        }
        if ($request->has('facebooklink')) {
            $build_input['facebook'] = $request->input('facebooklink');
        }
        if ($request->has('youtubelink')) {
            $build_input['youtube'] = $request->input('youtubelink');
        }
        if ($request->has('contact')) {
            $build_input['contact'] = $request->input('contact');
        }
        if ($request->has('address')) {
            $build_input['address'] = $request->input('address');
        }
        if ($request->has('email')) {
            $build_input['email'] = $request->input('email');
        }
        if ($request->has('guidelines')) {
            $build_input['guidelines'] = $request->input('guidelines');
        }
        if ($request->has('sum_mission_vision')) {
            $build_input['mission_vission'] = $request->input('sum_mission_vision');
        }
        if ($request->has('terms_and_condition')) {
            $build_input['terms_and_condition'] = $request->input('terms_and_condition');
        }
        if ($request->has('about_us')) {
            $build_input['about_us'] = $request->input('about_us');
        }
        // Check if have record 

        $check_record = AppInfoModel::find(1);
        $action = $check_record ? 'update' : 'create';
        $description = $check_record ? 'Updated app info' : 'Created new app info';
        if ($check_record) {
            // update 
            $check_record->update($build_input);       
        } else {
            // insert
            AppInfoModel::create($build_input);
        }
        // Record audit trail
        AuditTrailModel::create([
            'userID' => Auth::id(),
            'action' => $action,
            'description' => $description,
            'ip_address' => $request->ip(), // Fetch the IP address
        ]);
        
        return response()->json(['message' => $description, "status" => 200]);
    }

}
