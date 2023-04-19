<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class UserQuiz extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $base_url = URL::to('/');
        $user_data = DB::select("SELECT * FROM `user` WHERE id = '".$request->user_id."'");
        $course_quizzes = DB::select("SELECT * FROM `course_quizzes` WHERE id = '".$this->course_quiz_id."'");
        $course = Course::getCourseDetailById($course_quizzes[0]->course_id,$user_data[0]->language_id);

        if($course[0]->video_file == ""){
            $video_file = $base_url."/uploads/user/default_user.png";
        }else{
            $video_file = $base_url.config('constants.MEDIA_IMAGE_PATH').$course[0]->video_file;
        }

        if($course[0]->video_file_thumb == ""){
            $video_file_thumb = $base_url."/images/image_holder.png";
        }else{
            $video_file_thumb = $base_url.config('constants.MEDIA_IMAGE_PATH').$course[0]->video_file_thumb;
        }

        if($course[0]->course_certificate_file == ""){
            $course_certificate_file = $base_url."/uploads/user/default_user.png";
        }else{

        }

        $course_certificate_file = $base_url.config('constants.MEDIA_IMAGE_PATH')."certificate.png";

        $response = [
            'is_quiz_passed' => $this->is_quiz_passed,
            'course_certificate_file' => $course_certificate_file,
            'course_quiz_id' => $course[0]->course_quiz_id,
            'category_id' => $this->id,
            'course_name' => $course[0]->course_name,
            'video_file' => $video_file,
            'video_file_thumb' => $video_file_thumb,
            'video_heading' => $course[0]->video_heading,
            'video_description' => $course[0]->video_description,
            'short_description' => (!empty($course[0]->video_description)) ? strip_tags($course[0]->video_description) : '',
            'course_type' => $course[0]->course_type,


        ];
        return $response;
    }
}
