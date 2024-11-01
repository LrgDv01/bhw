<?php

namespace App\Http\Controllers;

use App\Models\admin\AppInfoModel;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function get_app_info() {
        $get_record = AppInfoModel::find(1);
        return response()->json(['data' => $get_record, "status" => 200]);
    }
}
