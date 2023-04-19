<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NotificationSetting extends Model
{
    protected $table = "notification_settings";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];


    public static function getById($user_id){
        $query = self::select();
        return $query->where('user_id', $user_id)
            ->first();
    }


    public static function getNotificationSettings($params)
    {

        $query = self::select('notification_settings.*')
                        ->where('notification_settings.user_id',$params['user_id'])
                        ->paginate(config('constants.PAGINATION_LIMIT'));
        return $query;
    }
}
