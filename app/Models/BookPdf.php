<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BookPdf extends Model {

    protected $table = 'pdf';
    protected $guarded = [];

    // protected $fillable = [
    //     ‘title’,
    //     ‘description’,
    //     ‘body’
    // ];

    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class,'book_id');
    }

    public function topic()
    {
        return $this->belongsTo(\App\Models\Topic::class,'topic_id');
    }

}