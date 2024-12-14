<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Detection\MobileDetect;

class deviceIdentifierController extends Controller
{
    public function index()
    {
        $detect = new MobileDetect;
        $isMobile = $detect->isMobile();
        $isTablet = $detect->isTablet();
        return $isMobile;
    }
}
