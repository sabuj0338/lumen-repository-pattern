<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LatestTopic;
use Validator;

class LatestTopicController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'content' => 'required|string|max:255',
        ]);

        if($validated->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validated->errors()]);
        }

        $latestTopic = LatestTopic::create([
            'content' => $request['content'],
        ]);

        return response()->json(['status' => 'success']);
    }
}
