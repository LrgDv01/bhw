<?php

namespace App\Http\Controllers\admin\library;

use App\Http\Controllers\Controller;
use App\Models\admin\VisitorModel;
use App\Models\AuditTrailModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    public function show_add_visitor_page($id) {
        return view('admin.pages.add_visitor', ['pdl_id' => $id]);
    }
    public function get_visitor_info(Request $request) {
        $pdl_id = $request->pdl_id;
        $visitor_info = VisitorModel::where('pdlID', $pdl_id)
            ->leftjoin('user_position as b', 'b.userID', '=', 'visitor_pdl.userID')
            ->get();
        return response()->json($visitor_info);
    }
    public function tag_visitor(Request $request) {
        $user = User::where('id', $request->input('select_user'))->first();
        $insertVisitorData = [
            'userID' => $user->id,
            'pdlID' => $request->input('pdlID'),
            'name' => $user->name,
            'gender' => $user->gender,
            'email' => $user->email,
            'contact_number' => $user->contact,
        ];
        VisitorModel::create($insertVisitorData);
        
        $loggedInUser = Auth::user();
        
        AuditTrailModel::create([
            'userID' => $loggedInUser->id,
            'user_email' => $loggedInUser->email,
            'action' => 'tag visitor',
            'description' => 'Visitor tagged with pdlID: ' . $request->input('pdlID') . ' for userID: ' . $user->id,
            'ip_address' => $request->ip(),
        ]);
        return response()->json(['message' => 'Visitor tagged successfully'], 201);
    }
    public function deleteVisitor($id)
    {
        $visitor = VisitorModel::find($id);

        if (!$visitor) {
            return response()->json(['message' => 'Visitor not found'], 404);
        }

        $visitor->delete();

        return response()->json(['message' => 'Visitor deleted successfully'], 200);
    }
}
