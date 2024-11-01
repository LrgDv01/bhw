<?php

namespace App\Http\Controllers;

use App\Models\AuditTrailModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
class AuditController extends Controller
{
    public function index(Request $request) {
        // Get the date from the request, or use today's date as the default
        $date = $request->input('date', Carbon::now()->format('Y-m-d'));

        // Validate the date format (Y-m-d)
        $request->validate([
            'date' => 'date_format:Y-m-d'
        ]);

        // Filter the audit trails by the provided date
        $auditTrails = AuditTrailModel::whereDate('created_at', $date)->get();

        // Return the audit trails as a JSON response
        return response()->json($auditTrails);
    }
}
