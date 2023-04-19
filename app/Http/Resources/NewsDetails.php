<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\URL;

class NewsDetails extends Resource
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
        }else{
            $news_image = $base_url.'/'.$this->news_image;
        }
        $response = [
            'id' => $this->id,
            'news_title' => $this->news_title,
            'news_description' => $this->news_description,
            'news_image' => $news_image,
            'created_at' => date('Y-m-d H:i:s', strtotime($this->created_at)),
        ];
        return $response;
    }
}
