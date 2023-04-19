<?php

namespace App\Http\Resources;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\URL;

class UserCertificatesDetails extends Resource
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

        $user_data = User::getUserDataById($request->user_id);
        $course_data = Course::getCourseDetailById($this->id,$user_data[0]->language_id);

        if($course_data[0]->video_file == ""){
            $video_file = $base_url."/uploads/user/default_user.png";
        }else{
            $video_file = $base_url.config('constants.MEDIA_IMAGE_PATH').$course_data[0]->video_file;
        }

        if($course_data[0]->video_file_thumb == ""){
            $video_file_thumb = $base_url."/images/image_holder.png";
        }else{
            $video_file_thumb = $base_url.config('constants.MEDIA_IMAGE_PATH').$course_data[0]->video_file_thumb;
        }

        if($course_data[0]->course_certificate_file == ""){
            $course_certificate_file = $base_url."/uploads/user/default_user.png";
        }else{
            $course_certificate_file = $base_url.config('constants.MEDIA_IMAGE_PATH')."certificate.png";
        }

        $response = [
            'course_id' => $this->id,
            'course_name' => $course_data[0]->course_name,
            'passing_percentage' => $course_data[0]->passing_percentage."%",
            'video_file' => $video_file,
            'video_file_thumb' => $video_file_thumb,
            'video_heading' => $course_data[0]->video_heading,
            'video_description' => $course_data[0]->video_description,
            'short_description' => (!empty($course_data[0]->video_description)) ? strip_tags($course_data[0]->video_description) : '',
            'course_type' => $course_data[0]->course_type,
            'course_certificate_file' => $course_certificate_file,
        ];
        return $response;
    }
}
