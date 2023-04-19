<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class NotificationSetting extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $response = [
            'user_id' => $this->user_id,
            'setting_title' => "When new course/training video uploads",
            'is_notification_on' => $this->is_notification_on,
            'created_at' => date('Y-m-d H:i:s', strtotime($this->created_at)),
        ];
        return $response;
    }
}
