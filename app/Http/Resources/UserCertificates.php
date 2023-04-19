<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class UserCertificates extends Resource
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
        $user_data = DB::select("SELECT * FROM `user` WHERE id = '".$this->user_id."'");
        $course = Course::getCourseDetailById($this->course_id,$user_data[0]->language_id);
        //dd($course[0]->course_certificate_file);

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
            $course_certificate_file = $base_url.config('constants.MEDIA_IMAGE_PATH').$course[0]->course_certificate_file;
        }



        $response = [
            'course_id' => $this->course_id,
            'is_quiz_passed' => $this->is_quiz_passed,
            'course_certificate_file' => $course_certificate_file,
            'course_quiz_id' => $course[0]->course_quiz_id,
            'user_quiz_id' => $this->user_quiz_id,
            'category_id' => $this->id,
            'course_name' => $course[0]->course_name,
            'video_file' => $video_file,
            'video_file_thumb' => $video_file_thumb,
            'video_heading' => $course[0]->video_heading,
            'course_type' => $course[0]->course_type,
            'video_description' => $course[0]->video_description,
            'short_description' => (!empty($course[0]->video_description)) ? strip_tags($course[0]->video_description) : '',
            'quiz_percentage' => $this->quiz_percentage,


        ];
        return $response;
    }
}
