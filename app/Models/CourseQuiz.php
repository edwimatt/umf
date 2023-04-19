<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class CourseQuiz extends Model
{
    protected $table = "course_quizzes";

    public static function getUserQuizDetailsById($id){
        $query = self::select();
        return $query->where('id', $id)
            ->first();
    }
}
