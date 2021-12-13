<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Exam;
use App\Models\LatestTopic;
use App\Models\BookPdf;
use App\Models\MCQ;

class AppApiController extends Controller
{
    public function home()
    {
        $data['books'] = Book::with('topics:id,book_id,topicName')->select('id', 'bookName')->get();

        $data['exams'] = Exam::select('id','examName')->get();

        $data['latest_topics'] = LatestTopic::select('id','content')->limit(15)->get();

        return response()->json(['status' => 'success','data' => $data]);
    }
    
    public function topicPdfList($topic_id)
    {
        $data = BookPdf::select('id','book_id','topic_id',DB::raw("CONCAT('http://localhost:8000/', pdfName) AS pdf_url"))->where('topic_id', $topic_id)->get();
        return response()->json(['status' => 'success','data' => $data]);
    }
    
    public function examQuestions($exam_id)
    {
        $data = MCQ::select(
            'id',
            'exam_id',
            'questionName',
            'questionDescription',
            'optionOne',
            'optionTwo',
            'optionThree',
            'optionFour',
            'answer'
        )->where('exam_id', $exam_id)->get();
        return response()->json(['status' => 'success','data' => $data]);
    }
}
