<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Validator;

class ImportController extends Controller
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
        $file = $_FILES['file']['tmp_name'];
        $handle = fopen($file, "r");
        $c = 0;

        $data = [];
        $filesop = fgetcsv($handle, 1000, ",");


        // while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        // {
        //     $fname = $filesop[0];
        //     $data[] = $filesop[0];
        //     // $sql = "insert into excel(fname,lname) values ('$fname','$lname')";
        //     // $stmt = mysqli_prepare($conn,$sql);
        //     // mysqli_stmt_execute($stmt);

        //     // $c = $c + 1;
        // }
        return response()->json(['status' => 'success', 'data' => $filesop]);
    }
}
