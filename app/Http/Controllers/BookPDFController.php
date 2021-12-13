<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookPdf;
use Validator;

class BookPDFController extends Controller
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
            'topic_id' => 'required|integer|exists:topics,id',
            'pdf' => 'required|max:1000|mimes:pdf',
        ]);

        if($validated->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validated->errors()]);
        }

        // $uniqueFileName = uniqid() . $request->get('pdf')->getClientOriginalName() . '.' . $request->get('pdf')->getClientOriginalExtension();

        // $request->get('pdf')->move(public_path('files') . $uniqueFileName);

        // return redirect()->back()->with('success', 'File uploaded successfully.');

        $picName = $request->file('pdf')->getClientOriginalName();
        $picName = uniqid() . '_' . $picName;
        $destinationPath = storage_path('/app/public/pdf'); // upload path
        // File::makeDirectory($destinationPath, 0777, true, true);
        $request->file('pdf')->move($destinationPath, $picName);

        $bookpdf = BookPdf::create([
            'book_id' => $request['book_id'],
            'topic_id' => $request['topic_id'],
            'pdfName' => $picName,
        ]);

        return response()->json(['status' => 'success']);
    }

    public function import(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'pdf' => 'required|array',
            'pdf.*.book_id' => 'required|integer|exists:books,id',
            'pdf.*.topic_id' => 'required|integer|exists:topics,id',
            'pdf.*.pdfName' => 'required|string|max:255',
        ]);

        if($validated->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validated->errors()]);
        }

        // $bookpdf = BookPdf::create([
        //     'book_id' => $validated['book_id'],
        //     'topic_id' => $validated['topic_id'],
        //     'pdfName' => $validated['pdfName'],
        // ]);

        BookPdf::insert($request->all());

        return response()->json(['status' => 'success']);
    }
}
