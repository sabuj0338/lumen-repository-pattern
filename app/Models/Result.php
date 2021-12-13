<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Result extends Model {
    protected $table = 'results';
    protected $guarded = [];

    // protected $fillable = [
    //     ‘title’,
    //     ‘description’,
    //     ‘body’
    // ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function exam()
    {
        return $this->belongsTo(\App\Models\Exam::class, 'exam_id');
    }

    public function mcq()
    {
        return $this->belongsTo(\App\Models\MCQ::class, 'mcq_id');
    }
}