<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use Validator;

class ResultController extends Controller
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
            'exam_id' => 'required|integer|exists:exams,id',
            // 'user_id' => 'required|integer',
            'answers' => 'required|array',
            'answers.*.mcq_id' => 'required|integer|exists:mcqs,id',
            'answers.*.answer' => 'required|integer',
        ]);

        if($validated->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validated->errors()]);
        }

        // $result = Result::create($validated);

        $data = [];
        foreach ($request['answers'] as $key => $item) {
            $data[] = [
                'exam_id' => $request['exam_id'],
                'user_id' => 1,
                'mcq_id' => $item['mcq_id'],
                'answer' => $item['answer'],
            ];
        }

        Result::insert($data);
        
        return response()->json(['status' => 'success']);
        // try {
        // } catch (\Exception $e) {
        //     return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        // }
    }
}
