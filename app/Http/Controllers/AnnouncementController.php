<?php

namespace App\Http\Controllers;

use App\Models\AnnouncementModel;
use App\Models\AuditTrailModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
  public function showAnnouncementLandingPage() {
    $announcement = [];
    $announcement = AnnouncementModel::where('status', 1)
    ->orderBy('created_at', 'desc')->limit(4)
    ->get();
    return $announcement;
  }
  public function showAnnouncement($id = null) {
    $announcement = [];
    $otherAnnouncements = [];
  
    $announcement = AnnouncementModel::where('status', 1)->orderBy('created_at','desc')->first(); // Assuming 'status' column indicates active announcements
    if($id != null) {
      $announcement = AnnouncementModel::where('status', 1)->where('id', $id)->first(); // Assuming 'status' column indicates active announcements
    }
    if(!empty($announcement)) {
      $otherAnnouncements = AnnouncementModel::where('status', 1)
      ->where('id', '!=', $announcement->id)
      ->orderBy('created_at', 'desc')
      ->get();
    }

    
    return view('frontpage.announcement', compact('announcement', 'otherAnnouncements'));
  }
  public function get_announcement(Request $request)
  {
    $announcements = AnnouncementModel::all();

    // Return the announcements as a JSON response
    return response()->json($announcements);
  }
  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'content' => 'required|string',
    ]);

    // Handle file upload
    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('announcements', 'public');
    } else {
      $imagePath = null;
    }
    // Save the announcement to the database
    AnnouncementModel::create([
      'userID' => Auth::id(),
      'title' => $request->input('title'),
      'image' => $imagePath,
      'content' => $request->input('content'),
      'status' => 1,
    ]);

    AuditTrailModel::create([
      'userID' => Auth::id(),
      'action' => 'Add announcement',
      'description' => 'Successfully add announcement entitled : ' . $request->input('title'),
      'ip_address' => $request->ip(), // Fetch the IP address
    ]);
    return response()->json(['message' => "Successfully add announcement", "status" => 200]);
  }
  public function update(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
    ]);
    $announcement = AnnouncementModel::findOrFail($request->announcement_id);
    // Update announcement data
    $announcement->title = $request->title;
    $announcement->content = $request->content;
    // Handle image upload
    if ($request->hasFile('image')) {
      // Remove previous image if exists
      if ($announcement->image) {
        Storage::delete($announcement->image);
      }

      // Upload new image
      $imagePath = $request->file('image')->store('announcements', 'public');
      $announcement->image = $imagePath;
    }
    // Save the announcement
    $announcement->save();
    
    AuditTrailModel::create([
      'userID' => Auth::id(),
      'action' => 'update announcement',
      'description' => 'Successfully update announcement with the id : ' . $request->input('announcement_id'),
      'ip_address' => $request->ip(), // Fetch the IP address
    ]);
    
    // Return success response
    return response()->json(['message' => 'Announcement updated successfully']);
  }
  public function delete(Request $request)
  {
    $announcement = AnnouncementModel::findOrFail($request->announcement_id);
    $announcement->status = 0;
    $announcement->save();
    AuditTrailModel::create([
      'userID' => Auth::id(),
      'action' => 'deactivate announcement',
      'description' => 'Successfully deactivate announcement with the id : ' . $request->announcement_id,
      'ip_address' => $request->ip(), // Fetch the IP address
    ]);
    
    return response()->json(['message' => 'Announcement deactivated successfully']);
  }

  public function updateAnnouncement($id)
  {
    // Load the announcement data based on the ID
    $announcement = AnnouncementModel::findOrFail($id);
    // Return the view with the announcement data
    return view('admin.pages.update_announcement', compact('announcement'));
  }
}
