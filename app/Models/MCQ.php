<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MCQ extends Model {
    protected $table = 'mcqs';

    // protected $fillable = [
    //     ‘title’,
    //     ‘description’,
    //     ‘body’
    // ];
    protected $guarded = [];

    public function format()
    {
        return [
            'id' => $this->id,
            'exam_id' => $this->exam_id,
            'questionName' => $this->questionName,
            'questionDescription' => $this->questionDescription,
            'optionOne' => $this->optionOne,
            'optionTwo' => $this->optionTwo,
            'optionThree' => $this->optionThree,
            'optionFour' => $this->optionFour,
            'answer' => $this->answer,
        ];
    }

    public function exam()
    {
        return $this->belongsTo(\App\Models\Exam::class,'exam_id');
    }

    public function results()
    {
        return $this->hasMany(\App\Models\Result::class);
    }
}