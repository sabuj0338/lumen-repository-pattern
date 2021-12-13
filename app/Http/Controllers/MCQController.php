<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\MCQ;
use App\Jobs\ImportMCQJob;
use Illuminate\Http\Request;
use App\Repositories\MCQRepositoryInterface;

class MCQController extends Controller
{
    private $MCQRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MCQRepositoryInterface $MCQRepository)
    {
        $this->MCQRepository = $MCQRepository;
    }

    public function all()
    {
        $allMcq = $this->MCQRepository->all();
        return response()->json(['status' => 'success', 'data' => $allMcq]);
    }

    public function show($id)
    {
        $item = $this->MCQRepository->findById($id);
        return response()->json(['status' => 'success', 'data' => $item]);
    }

    public function delete($id)
    {
        $this->MCQRepository->delete($id);
        return response()->json(['status' => 'success']);
    }
    
    public function import(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'mcq' => 'required|array',
            'mcq.*.exam_id' => 'required|integer|exists:exams,id',
            'mcq.*.questionName' => 'required|string:max:255',
            'mcq.*.questionDescription' => 'required|string:max:500',
            'mcq.*.optionOne' => 'required|string:max:255',
            'mcq.*.optionTwo' => 'required|string:max:255',
            'mcq.*.optionThree' => 'required|string:max:255',
            'mcq.*.optionFour' => 'required|string:max:255',
            'mcq.*.answer' => 'required|string:max:255'
        ]);

        if($validated->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validated->errors()]);
        }

        // ImportMCQJob::dispatch($request['mcq']);
        dispatch(new ImportMCQJob($request['mcq']));

        return response()->json(['status' => 'success']);
    }

    public function store(Request $request)
    {
        // $validated = $this->validate($request, [
        $validated = Validator::make($request->all(), [
            'exam_id' => 'required|integer|exists:exams,id',
            'questionName' => 'required|string:max:255',
            'questionDescription' => 'required|string:max:500',
            'questionOne' => 'required|string:max:255',
            'questionTwo' => 'required|string:max:255',
            'questionThree' => 'required|string:max:255',
            'questionFour' => 'required|string:max:255',
            'answer' => 'required|string:max:255'
        ]);

        if($validated->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validated->errors()]);
        }


        MCQ::create([
            'exam_id' => $item['exam_id'],
            'questionName' => $item['questionName'],
            'questionDescription' => $item['questionDescription'],
            'questionOne' => $item['questionOne'],
            'questionTwo' => $item['questionTwo'],
            'questionThree' => $item['questionThree'],
            'questionFour' => $item['questionFour'],
            'answer' => $item['answer'],
        ]);

        return response()->json(['status' => 'success']);
    }
}
