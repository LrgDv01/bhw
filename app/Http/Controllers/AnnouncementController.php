<?php 

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Announcement::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('admin.announcement')->with('success', 'Announcement posted successfully!');
    }
    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->route('admin.announcement')->with('success', 'Announcement deleted successfully.');
    }

}
