<?php
namespace App\Http\Controllers\user\technician;

use App\Models\User;
use App\Models\ServicesModel;
use App\Models\technician\ReportsModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Add this line to import the Log facade

class ReportsController extends Controller
{
    public function index()
    {
        $recipient = auth()->user()->full_name;
        $reports = ServicesModel::with(['user', 'userFarms']) 
            ->where([
                ['technician_id', auth()->id()],
                ['status', '=', 'accepted']
            ])
            ->get();
        return view('user.technician.pages.reports',
            compact(
                'reports',
                'recipient'
            ));
    }

 
public function submitReport(Request $request)
{
    
    try {
        // Find the report by ID
        $report = ServicesModel::findOrFail($request->input('report_id'));

        // Create a new ReportDetail record
        $reportDetail = ReportsModel::create([
            'report_id' => $report->id,
            'farmer_name' => $report->farmer_name,
            'contact_no' => $report->user->contact,
            'recipient' => $request->input('recipient'),
            'farm_location' => $request->input('farm_location'),
            'farm_size' => $request->input('farm_size'),
            'coconut_trees' => $request->input('coconut_trees'),
            'coconut_variety' => $request->input('coconut_variety'),
            'soil_type' => $request->input('soil_type'),
            'disease_type' => json_encode($request->input('disease_types')),
            'note' => $request->input('note'),
        ]);
        
        $reportDetail->save();

            // Redirect or return a response
            return redirect()->route('user.reports')->with('success', 'Report submitted successfully');
        } catch (\Exception $e) {
            // In case of any errors, log and return a failure message
            Log::error('Error submitting report: ' . $e->getMessage());
            return redirect()->route('user.reports')->with('error', 'An error occurred while submitting the report.');
        }
    }

    
}
