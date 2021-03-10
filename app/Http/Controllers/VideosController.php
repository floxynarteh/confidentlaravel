<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function show(Request $request, $id)
    {
        $now_playing = Video::findOrFail($id);
        $user = $request->user();


        $userCanViewVideo = $now_playing->lesson->isFree()
           || $now_playing->lesson->product_id <= $user->order->product_id;

           abort_if(!$userCanViewVideo, 403);

        $user->last_viewed_video_id = $id;
        $user->save();

        return view('videos.show', compact('now_playing'));

    }




}
