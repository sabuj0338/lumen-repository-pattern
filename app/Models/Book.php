<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Book extends Model {

    protected $table = 'books';

    protected $guarded = [];

    // protected $fillable = [
    //     ‘title’,
    //     ‘description’,
    //     ‘body’
    // ];

    public function topics()
    {
        return $this->hasMany(\App\Models\Topic::class);
    }

    public function pdf()
    {
        return $this->hasMany(\App\Models\BookPdf::class);
    }
}