<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model {
    protected $table = 'topics';
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

    public function pdf()
    {
        return $this->hasMany(\App\Models\BookPdf::class);
    }
}