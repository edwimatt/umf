<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class User extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $hospital_data = DB::select("SELECT * FROM hospital WHERE id = '".$this->hospital_id."'");
        //dd($hospital_data);

        $hospital_address = $hospital_data[0]->hospital_address;
        $owner_user_id = $hospital_data[0]->user_id;
        $hospital_name = $hospital_data[0]->name;
        $hospital_image = $hospital_data[0]->hospital_image;
        $base_url = URL::to('/');
        if($this->image_url == ""){
            $image_url = $base_url."/uploads/user/default_user.png";
        }else{
            $image_url = $base_url.'/uploads/user/'.$this->image_url;
        }

        if($hospital_image != NULL){

            $hospital_image_url = $base_url.'/uploads/user/'.$hospital_image;
        }else{
            $hospital_image_url  = $base_url."/uploads/user/banner-no-image.png";
        }

        $response = [
            'id' => $this->id,
            'owner_user_id' => $owner_user_id,
            'name' => !empty($this->name) ? $this->name  : $this->first_name . ' ' . $this->last_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'hospital_id' => $this->hospital_id,
            'hospital_name' => $hospital_name,
            'hospital_address' => $hospital_address,
            'hospital_image' => $hospital_image_url,
            'language_id' => $this->language_id,
            'email' => $this->email,
            'mobile_no' => (empty($this->mobile_no))? '' : $this->mobile_no,
            'hospital_name' => (empty($this->hospital_name))? '' : $this->hospital_name,
            'image_url' => $image_url,
            'token' => $this->token,
            'device_type' => $this->device_type,
            'device_token' => $this->device_token,
            'device' => $this->device,
            'created_at' => date('m-d-Y', strtotime($this->created_at)),
            'server_current_date_time' => date('Y-m-d H:i:s'),
        ];

        return $response;
    }
}


