<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class News extends Resource
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
        if($this->news_image == ""){
            $news_image = $base_url."/uploads/user/default_user.png";
        }elseif(!Storage::disk("public")->exists($this->news_image)){
            $news_image = $base_url."/uploads/user/default_user.png";
        }else{
            $news_image = url("storage/{$this->news_image}");
        }

        $response = [
            'id' => $this->id,
            'news_title' => $this->news_title,
            'hospital_id' => $this->hospital_id,
            'news_description' => strip_tags($this->news_description),
            'news_image' => $news_image,
            'created_at' => date('Y-m-d H:i:s', strtotime($this->created_at)),
        ];
        return $response;
    }
}
