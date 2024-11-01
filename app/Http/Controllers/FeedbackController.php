<?php

namespace App\Http\Controllers;

use App\Models\FeedbackModel;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function view() {
        // Count the number of happy, sad, and neutral reactions
        $happyCount = FeedbackModel::where('reaction', 'happy')->count();
        $sadCount = FeedbackModel::where('reaction', 'sad')->count();
        $neutralCount = FeedbackModel::where('reaction', 'neutral')->count();
    
        // Pass the counts to the view
        return view('admin.pages.feedback', [
            'happyCount' => $happyCount,
            'sadCount' => $sadCount,
            'neutralCount' => $neutralCount
        ]);
    }
    public function getFeedback()
    {
        $feedbacks = FeedbackModel::with('users')->get(); // Assuming `users` is a relationship in FeedbackModel
    
        return response()->json([
            'data' => $feedbacks
        ]);
    }
    public function create_feedback(Request $request) {
        // Validate the feedback input
        $request->validate([
            'comment' => 'required|string|max:500',
            'emoji' => 'required|string|max:500'
        ]);
    
        // Save the feedback
        FeedbackModel::create([
            'user_id' => auth()->user()->id,
            'comment' => $request->comment,
            'reaction' => $request->emoji,
        ]);
    
        return response()->json(['message' => 'Feedback submitted successfully!'], 200);
    }
}
