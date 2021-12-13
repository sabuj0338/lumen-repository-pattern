<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model {
    protected $table = 'exams';
    protected $guarded = [];

    // protected $fillable = [
    //     ‘title’,
    //     ‘description’,
    //     ‘body’
    // ];

    public function mcq()
    {
        return $this->hasMany(\App\Models\MCQ::class);
    }

    public function results()
    {
        return $this->hasMany(\App\Models\Result::class);
    }
}