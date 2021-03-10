<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class WatchesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Respone
     */

    public function store(Request $request)
    {
        \App\Models\Watch::create([
            'user_id' => $request->user()->id,
            'video_id' => $request->get('video_id')
        ]);
     // failure [-1]
        event('video.watched', [$request->user(),$request->get('video_id')]);

        // return response(null, 204);

        //improved
        return response()->noContent();
    }
}
