<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use Validator;

class TopicController extends Controller
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
            'book_id' => 'required|integer|exists:books,id',
            'topicName' => 'required|string|max:255',
        ]);

        if($validated->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validated->errors()]);
        }

        $topic = Topic::create([
            'book_id' => $request['book_id'],
            'topicName' => $request['topicName'],
        ]);

        return response()->json(['status' => 'success']);
    }
}
