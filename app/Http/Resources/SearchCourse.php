<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\URL;

class SearchCourse extends Resource
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

        if($this->video_file == ""){
            $video_file = $base_url."/uploads/user/default_user.png";
        }else{
            $video_file = $base_url.config('constants.MEDIA_IMAGE_PATH').$this->video_file;
        }

        if($this->video_file_thumb == ""){
            $video_file_thumb = $base_url."/images/image_holder.png";
        }else{
            $video_file_thumb = $base_url.config('constants.MEDIA_IMAGE_PATH').$this->video_file_thumb;
        }
        $response = [
            'course_id' => $this->course_id,
            'course_name' => $this->course_name,
            'passing_percentage' => $this->passing_percentage."%",
            'video_file' => $video_file,
            'video_file_thumb' => $video_file_thumb,
            'video_heading' => $this->video_heading,
            'video_description' => $this->video_description,
            'short_description' => (!empty($this->video_description)) ? strip_tags($this->video_description) : '',
            'course_type' => $this->course_type,
            ];
        return $response;
    }
}
