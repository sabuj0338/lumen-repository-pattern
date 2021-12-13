<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Validator;

class BookController extends Controller
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
            'bookName' => 'required|string|max:255',
        ]);

        if($validated->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validated->errors()]);
        }

        $book = Book::create([
            'bookName' => $request['bookName'],
        ]);

        return response()->json(['status' => 'success']);
    }
}
