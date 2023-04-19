<?php

namespace App\Models;

use App\Libraries\Notification\Notification;
use App\Models\Notification as NotificationModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class NotificationIdentifier extends Model
{
    protected $table = "notification_identifier";

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['identifier', 'notification_type', 'send_type', 'title', 'message', 'wildcard', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public static function notificationIdentifier($identifier, $data, $custom_data = [], $bulk_notification = false)
    {
        $identifier = self::where('identifier', $identifier)->first();
        if (isset($identifier->id)) {
            if ($identifier->notification_type != 'none') {
                if ($identifier->notification_type == 'push') {
                    self::sendPushNotification($identifier, $data, $custom_data, $bulk_notification);
                }
            }
        }
    }

    public static function sendPushNotification($identifier, $data, $customData = [], $bulk_notification = false)
    {
        echo "HELLO";
        exit;

        //convert array keys in variable
        extract($data);
        //notification title
//        $title = $identifier->title;
        eval("\$title = \"$title\";");
        //notitification message
//        $message = $identifier->message;
        eval("\$message = \"$message\";");
        //device token
        if ($bulk_notification == false) {
            $notifyUser = $identifier->send_type == 'actor' ? $user : $targetUser;
            $device_token = $notifyUser->device_token;
        } else {
            $notifyUsers = $identifier->send_type == 'actor' ? $user : $targetUser;
            foreach ($notifyUsers as $notifyUser) {
                $device_token[] = $notifyUser->device_token;
            }
        }

        if (!empty($device_token)) {

            $registrations_ids_key = is_array($device_token) ? 'registration_ids' : 'to';
            if ($notifyUser->device_type != 'ios') {

                $notification_data = [
                    $registrations_ids_key => $device_token,
                    'notification' => [
                        'body' => $message,
                        'sound' => 'default',
                        'badge' => 0//self::userNotificationBadge($notifyUser->id)
                    ],
                    'data' => [
                        'message' => [
                            'body' => $message,
                            'sound' => 'default',
                        ],
                        'custom_data' => $customData,
                        'identifier' => $identifier->identifier,
                        'user_badge' => 0//self::userNotificationBadge($notifyUser->id)
                    ]
                ];
            } else {
                $notification_data = [
                    $registrations_ids_key => $device_token,
                    'notification' => [
                        'title' => $title,
                        'text' => $message,
                        'body' => $message,
                        'sound' => 'default',
                        'badge' => 0,//self::userNotificationBadge($notifyUser->id),
                        'custom_data' => $customData,
                        'identifier' => $identifier->identifier,
                        'user_badge' => 0//self::userNotificationBadge($notifyUser->id)
                    ],
                    'priority' => 'high'
                ];
            }
            $notification = new Notification;
            $notification->pushNotification($notifyUser->device_type, $notification_data);

            //save notification data
            if ($bulk_notification == true) {
                $notifyUsers = $identifier->send_type == 'actor' ? $user : $targetUser;
                foreach ($notifyUsers as $notifyUser) {
                    $notification_buld_data[] = [
                        'notification_identifier_id' => $identifier->id,
                        'actor_id' => $user->id,
                        'target_id' => $notifyUser->id,
                        'reference_id' => $referenceId,
                        'reference_module' => $referenceModule,
                        'type' => 'push',
                        'title' => $title,
                        'description' => $message,
                        'created_at' => Carbon::now()
                    ];
                    if ($referenceModule == 'reservation_reminder') {
                        $booking = \App\Models\BookingAvailable::find($referenceId);
                        $booking->notify_booking_expired = 1;
                        $booking->save();

                    } elseif ($referenceModule == 'remind_deal_expiration') {
                        $dealStatus = \App\Models\Deal::find($referenceId);
                        $dealStatus->notify_deal_expired = 1;
                        $dealStatus->save();
                    }
                }
                NotificationModel::insert($notification_buld_data);
            } else {
                //save notification data
                NotificationModel::create([
                    'notification_identifier_id' => $identifier->id,
                    'actor_id' => $user->id,
                    'target_id' => $notifyUser->id,
                    'reference_id' => $referenceId,
                    'reference_module' => $referenceModule,
                    'type' => 'push',
                    'title' => $title,
                    'description' => $message,
                    'created_at' => Carbon::now()
                ]);
//                if ($referenceModule == 'reservation_reminder') {
//                    $booking = \App\Models\BookingAvailable::find($referenceId);
//                    $booking->notify_booking_expired = 1;
//                    $booking->save();
//
//                } elseif ($referenceModule == 'remind_deal_expiration') {
//                    $dealStatus = \App\Models\Deal::find($referenceId);
//                    $dealStatus->notify_deal_expired = 1;
//                    $dealStatus->save();
//                }
            }
        }
    }

    /**
     * This function is used for count user notification badge
     * @param {int} $user_id
     */
    public static function userNotificationBadge($user_id)
    {
        return \DB::table('notification')->where('target_id', $user_id)->where('is_read', 0)->count();
    }
}
