<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Physician extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $image_url = !empty($this->image_url) ? config('constants.USER_IMAGE_PATH') . $this->image_url : 'image/default_user.png';
        $response = [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'hospital_id' => $this->hospital_id,
            'hospital_name' => $this->hospital_name,
            'email' => $this->email,
            'gender' => $this->gender,
            'image_url' => $image_url,
            'speciality_title' => $this->speciality_title,
            'token' => $this->token,
            'created_at' => date('m-d-Y', strtotime($this->created_at)),
        ];
        return $response;
    }
}
