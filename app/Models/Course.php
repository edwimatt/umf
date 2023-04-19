<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'courses';



    public static function getCourseDetailById($course_id,$language_id)
    {

        $query = \DB::table('courses');
        $query->select(
            'course_quizzes.id as course_quiz_id',
            'courses.id as course_id',
            'courses.passing_percentage as passing_percentage',
            'language_to_courses.*',
            'course_certificates.course_certificate_file',
            'course_certificates.course_certificate_title'
        );
        $query->leftJoin('language_to_courses', 'language_to_courses.course_id', '=', 'courses.id');
        $query->leftJoin('course_quizzes', 'courses.id', '=', 'course_quizzes.course_id');
        $query->leftJoin('course_certificates', 'courses.id', '=', 'course_certificates.course_id');
        $query->where('courses.id', '=', $course_id);
        $query->where('language_to_courses.language_id', '=', $language_id);
        //$query->where('course_certificates.language_id', '=', $language_id);


        return $query->get();
    }

    public static function getCourseContentsById($course_id,$language_id)
    {

        $query = \DB::table('language_to_course_contents');
        $query->select(
            ['language_to_course_contents.*','language_to_courses.*']
        )->leftJoin("language_to_courses","language_to_courses.course_id","=","language_to_course_contents.course_id");
        $query->where('language_to_course_contents.course_id', '=', $course_id);
        $query->where('language_to_course_contents.language_id', '=', $language_id);

        return $query->get();
    }

    public static function getCourseDetailsById($course_id,$language_id = NULL){
        $query = self::select(
            'courses.*',
            'language_to_courses.*',
            'course_quizzes.id as course_quiz_id',
            //'courses.id as course_id',
            'courses.passing_percentage as passing_percentage',
            'course_certificates.course_certificate_file',
            'course_certificates.course_certificate_title'
        )
        ->selectRaw('IF(courses.course_type = "quiz" , (SELECT COUNT(*) FROM `language_to_course_contents` WHERE language_to_course_contents.`course_id` = courses.id AND language_to_course_contents.`language_id` = '.$language_id.')  ,1) AS is_show');

        $query->leftJoin('language_to_courses', 'language_to_courses.course_id', '=', 'courses.id');
        $query->leftJoin('course_quizzes', 'courses.id', '=', 'course_quizzes.course_id');
        $query->leftJoin('course_certificates', 'courses.id', '=', 'course_certificates.course_id');
        $query->where('courses.id', '=', $course_id);
        if(!empty($language_id)){
            $query->where('language_to_courses.language_id', '=', $language_id);
        }
        $query->havingRaw("is_show > 0");
        $record = $query->first();

        return $record;
    }

    public static function getSearchCourse($data)
    {
        $query = \DB::table('courses');
        $query->select(
            'courses.*',
            'language_to_courses.*'
        );
        $query->leftJoin('language_to_courses', 'language_to_courses.course_id', '=', 'courses.id');
        $query->where('language_to_courses.language_id', '=', $data['language_id']);
        if (isset($data['search_keyword']) && $data['search_keyword'] != "") {
            $query->where('language_to_courses.course_name', 'like', '%' . $data['search_keyword'] . '%');
        }
        return $query->get();
    }

    public static function getQuizQuestionsByCourseId($course_id,$language_id)
    {

        $query = \DB::table('quiz_questions');
        $query->select(
            'quiz_questions.*'
        );
        $query->where('quiz_questions.course_id', '=', $course_id);

        if(!empty($language_id)){
            $query->where('quiz_questions.language_id', '=', $language_id);
        }

        return $query->get();
    }

    public static function getQuizAnswersByQuizQuestionId($question_id,$language_id)
    {

        $query = \DB::table('quiz_answers');
        $query->select(
            'quiz_answers.*'
        );
        $query->where('quiz_answers.quiz_question_id', '=', $question_id);
        $query->where('quiz_answers.language_id', '=', $language_id);

        return $query->get();
    }

}


