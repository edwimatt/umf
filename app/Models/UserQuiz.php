<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class UserQuiz extends Model
{
    protected $table = "user_quizzes";

    public static function getUserQuizDetailsById($id){
        $query = self::select();
        return $query->where('id', $id)
            ->first();
    }

    public static function getUserQuizzesByUserId($user_id)
    {
        $query = \DB::table('user_quizzes');
        $query->select(
            'user_quizzes.*',
            'course_quizzes.course_id',
            'courses.category_id'
        );
        $query->join('course_quizzes', 'course_quizzes.id', '=', 'user_quizzes.course_quiz_id');
        $query->join('courses', 'courses.id', '=', 'course_quizzes.course_id');
        $query->where('user_quizzes.user_id', '=', $user_id);
        //$query->groupBy('user_quizzes.course_quiz_id');
        $query->orderBy('user_quizzes.id','DESC');
        return  $query->paginate(Config::get('constants.PAGINATION_PAGE_SIZE'));
    }

    public static function getUserCertificatesByUserId($user_id,$language_id)
    {
        $query = \DB::table('user_quizzes');
        $query->select(
            'user_quizzes.*',
            'user_quizzes.id as user_quiz_id',
            'course_certificates.*',
            'course_quizzes.course_id'
        );
        $query->leftJoin('course_quizzes', 'course_quizzes.id', '=', 'user_quizzes.course_quiz_id');
        $query->leftJoin('courses', 'courses.id', '=', 'course_quizzes.course_id');
        $query->leftJoin('course_certificates', 'courses.id', '=', 'course_certificates.course_id');
        $query->where('user_quizzes.user_id', '=', $user_id);
        $query->where('course_certificates.language_id', '=', $language_id);
        $query->where('user_quizzes.is_quiz_passed', '=', 1);
        $query->groupBy('user_quizzes.course_quiz_id');
        return $query->get();
    }
}
