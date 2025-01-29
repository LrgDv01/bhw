<?php

namespace App\Http\Controllers\admin\admin_mdwf;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UseractivityController extends Controller
{
    public function userActivity() {
        return view('admin.admin_mdwf.user_activity');
    }
}
