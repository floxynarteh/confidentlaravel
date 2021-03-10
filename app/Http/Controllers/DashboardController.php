<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        if (!$user->last_viewed_video_id) {
            $user->last_viewed_video_id = 1;
            $user->save();
        }

        $now_playing = Video::find($user->last_viewed_video_id);


        return view('videos.show', compact('now_playing'));

    }
}
