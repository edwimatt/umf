<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\URL;

class Language extends Resource
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
        $flag = $base_url.config('constants.MEDIA_IMAGE_PATH').$this->flag;
        $response = [
            'language_id' => $this->id,
            'language_name' => $this->language_name,
            'flag' => $flag,
        ];
        return $response;
    }
}
