<?php

namespace App\Models;

use App\Libraries\Notification\Notification as PushNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = "notification";
    protected $guarded = array();


    public static function getById($id)
    {

        $query = self::select();
        return $query->where('id', $id)
            //->where("is_viewed" , 0)
            ->first();
    }

    public static function getUserNotifications($params)
    {
        $user_id = $params['user_id'];

        $query = self::select();
        $query->where('target_id', $user_id)
            ->orderBy('id', 'DESC');

        //->where("is_viewed" , 0)
        //->get();
        return $query->paginate(config('constants.PAGINATION_PAGE_SIZE'));
    }

    public static function UpdateNotification($params)
    {
        $user_id = $params['user_id'];
        $id = $params['id'];

        \DB::statement('UPDATE notification SET is_viewed=1 WHERE id = ' . $id . ' AND target_id=  ' . $user_id . ' ');
        return true;

    }

    /**
     * @param $identifier
     * @param $data
     * @param array $customData
     * @param bool $bulk_notification
     * @param $device_type
     */
    public static function sendPushNotification($identifier, $notification_data, $customData = [], $bulk_notification = false, $device_type = 'android')
    {
        $unique_id = uniqid();
        //device token
        $identifier_data = NotificationIdentifier::where('identifier', $identifier)->first();
        if ($bulk_notification == false) {
            $notifyUser = $notification_data['target'];
            if(!empty($notifyUser->device_token)){
                $device_token[] = $notifyUser->device_token;
            }
        } else {
            $notifyUsers = $notification_data['target'];
            foreach ($notifyUsers as $notifyUser) {
                if(!empty($notifyUser->device_token)){
                    $device_token[] = $notifyUser->device_token;
                }
            }
        }


        $customData['unique_id'] = $unique_id;
        if (!empty($device_token)) {
            if ($bulk_notification) {
                $badge = 0;
            } else {
                $badge = !empty($notification_data['badge']) ? $notification_data['badge'] : 0;
            }

            $pushNotification = new PushNotification;
            $pushNotification->sendPush($device_token,
                $device_type,
                $notification_data['title'],
                $notification_data['message'],
                $badge,
                $customData);
        }


        //save notification data
        if ($bulk_notification == true) {
            $notifyUsers = $notification_data['target'];
            foreach ($notifyUsers as $notifyUser) {
                $notification_buld_data[] = [
                    //'unique_id'                  => $unique_id,
                    //'identifier'                 => $identifier,
                    'notification_identifier_id' => $identifier_data->id,
                    'actor_id' => $notification_data['actor']->id,
                    'target_id' => $notifyUser->id,
                    'reference_id' => $notification_data['reference_id'],
                    'is_anonymous' => $notification_data['is_anonymous'],
                    'reference_module' => $notification_data['reference_module'],
                    'type' => 'push',
                    'title' => $notification_data['title'],
                    'description' => $notification_data['message'],
                    'created_at' => Carbon::now()
                ];
            }
            self::insert($notification_buld_data);
        } else {


            //dd($notifyUser);

            //save notification data
            self::create([
                //'unique_id'                  => $unique_id,
                'notification_identifier_id' => $identifier_data->id,
                'actor_id' => 0,
                'target_id' => $notifyUser->id,
                'reference_id' => $notification_data['reference_id'],
                //'is_anonymous'               => $notification_data['is_anonymous'],
                'reference_module' => $notification_data['reference_module'],
                'type' => 'push',
                'title' => $notification_data['title'],
                'description' => $notification_data['message'],
                'created_at' => Carbon::now()
            ]);
        }
    }

    public static function getBadge($user_id)
    {
        $query = \DB::table('notification')
            ->where('target_id', $user_id)
            ->where('is_read', 0)
            ->count();
        return $query;
    }
}
