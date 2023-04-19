<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LoginAuth;
use App\Models\Notification;
use App\Models\NotificationIdentifier;
use App\Models\NotificationSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{

    function __construct()
    {

        parent::__construct();
        $this->middleware(LoginAuth::class, ['only' => ['store', 'index', 'destroy', 'show', 'update', 'clear', 'unreadCount']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $list = Notification::select('notification.*', 'ni.identifier')
            ->join('notification_identifier AS ni', 'ni.id', '=', 'notification.notification_identifier_id')
            ->where('notification.target_id', $params['user_id'])
            ->where('notification.deleted_at', '=', Null)
            ->orderBy('notification.id', 'desc')
            ->paginate(Config::get('constants.PAGINATION_PAGE_SIZE'));
        return $this->__sendResponse('Notification', $list, 200, 'Notification retrieved successfully.');
    }

    public function unreadCount(Request $request)
    {
        $list = Notification::selectRaw('count(*) as total_unread')->where('target_id', $request->user_id)->where('is_read', 0)->first();
        $this->__is_paginate = false;
        $this->__collection = false;
        return $this->__sendResponse('Notification', $list, 200, 'Total unread count retrieved successfully.');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clear(Request $request)
    {
        $params = $request->all();
        Notification::where('target_id', $request['user_id'])->Update(['deleted_at' => Carbon::now()]);
        $list = Notification::select('notification.*', 'ni.identifier')
            ->join('notification_identifier AS ni', 'ni.id', '=', 'notification.notification_identifier_id')
            ->where('notification.target_id', $params['user_id'])
            ->where('notification.deleted_at', '=', Null)
            ->orderBy('notification.id', 'desc')
            ->paginate(Config::get('constants.PAGINATION_PAGE_SIZE'));
        return $this->__sendResponse('Notification', $list, 200, 'Notification retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param_rules['admin_id'] = 'required';
        $param_rules['user_id'] = 'required';
        $param_rules['title'] = 'required';
        $param_rules['description'] = 'required';

        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if ($this->__is_error == true)
            return $response;

        $obj = new Notification();

        $obj->admin_id = $request->admin_id;
        $obj->user_id = $request->user_id;
        $obj->title = $request->title;
        $obj->description = $request->description;
        $obj->send_type = isset($request->send_type) ? $request->send_type : 'user';
        $obj->is_send = isset($request->is_send) ? $request->is_send : 0;

        $obj->save();

        $this->__is_paginate = false;
        return $this->__sendResponse('Notification', Notification::getById($obj->id), 200, 'Your notification has been added successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $param_rules['id'] = 'required|exists:notification';

        $response = $this->__validateRequestParams(['id' => $id], $param_rules);

        if ($this->__is_error == true)
            return $response;

        $this->__is_paginate = false;
        return $this->__sendResponse('Notification', Notification::getById($id), 200, 'notification retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [];
        $params = $request->all();
        if (!empty($params['is_read'])) {
            $data['is_read'] = 1;
        }
        if (!empty($params['is_viewed'])) {
            $data['is_viewed'] = 1;
        }
        $data['is_read'] = 1;
        $data['is_viewed'] = 1;
        Notification::where('id', $id)->update($data);

//        $list = Notification::select('notification.*', 'ni.identifier')
//            ->join('notification_identifier AS ni', 'ni.id', '=', 'notification.notification_identifier_id')->get();
        $list = Notification::select('notification.*', 'ni.identifier')
            ->join('notification_identifier AS ni', 'ni.id', '=', 'notification.notification_identifier_id')
            ->where('notification.target_id', $params['user_id'])
            ->where('notification.deleted_at', '=', Null)
            ->orderBy('notification.id', 'desc')
            ->paginate(Config::get('constants.PAGINATION_PAGE_SIZE'));

//        $this->__is_paginate = false;
//        $this->__is_collection = false;

        return $this->__sendResponse('Notification', $list, 200, 'notification updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function sendTestPushNotification(Request $request)
    {
        if ($request->device_type == 'ios') {
            $url = "https://fcm.googleapis.com/fcm/send";
            $token = $request->input('device_token');
            $serverKey = env('FCM_LEGACY_SERVER_KEY');
            $title = "Title";
            $body = "Body of the message";
            $notification = array('title' => $title, 'text' => $body, 'sound' => 'default', 'badge' => '1');
            $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority' => 'high');
            $json = json_encode($arrayToSend);
            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Authorization: key=' . $serverKey;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($ch);
            if ($response === FALSE) {
                die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
            die('success');
        } else {
            $json_data = [
                "to" => $request->input('device_token'),
                "notification" => [
                    "body" => "Title",
                    "title" => "Body of the message",
                    "icon" => "ic_launcher"
                ],
                "data" => [
                    "ANYTHING EXTRA HERE"
                ]
            ];
            $data = json_encode($json_data);
            //FCM API end-point
            $url = 'https://fcm.googleapis.com/fcm/send';
            $server_key = env('FCM_LEGACY_SERVER_KEY');
            $headers = array(
                'Content-Type:application/json',
                'Authorization:key=' . $server_key
            );
            //CURL request to route notification to FCM connection server (provided by Google)
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Oops! FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
            die('success');
        }
    }

    public function sendNotificationUsers(Request $request)
    {
        $param_rules = [
            //'id' => 'required',
            'user_ids' => 'required',
            'user_ids.*' => 'exists:user,id'
        ];

        $response = $this->__validateRequestParams($request->all(), $param_rules);

        if ($this->__is_error == true)
            return $response;

        $this->__is_paginate = false;
        $this->__collection = false;
        $this->__is_collection = false;

        $targetUsers = User::whereIn('id', $request->user_ids)->where('device_type', 'android')->whereNotNull('token')->get();
        if (count($targetUsers)) {
            $notification_data = [
                'targetUser' => $targetUsers
            ];
            $custom_data = [];
            $identufier = (object)
            [
                'identifier' => 'message_notification',
                'title' => 'message notification',
                'message' => isset($request->message) ? $request->message : 'test notification',
                'send_type' => 'target'
            ];

            NotificationIdentifier::sendPushNotification($identufier, $notification_data, $custom_data, true, false);
        }
        $targetUsers = User::whereIn('id', $request->user_ids)->where('device_type', 'ios')->whereNotNull('token')->get();
        if (count($targetUsers) > 0) {
            $notification_data = [
                'targetUser' => $targetUsers
            ];
            $custom_data = [];
            $identufier = (object)
            [
                'identifier' => 'message_notification',
                'title' => 'message notification',
                'message' => isset($request->message) ? $request->message : 'test notification',
                'send_type' => 'target'
            ];

            NotificationIdentifier::sendPushNotification($identufier, $notification_data, $custom_data, true, false);
        }

        return $this->__sendResponse('User', [], 200, 'Notification has sent successfully.');
    }

    public function userNotificationSettings(Request $request)
    {

        $params = $request->all();

        $notification_settings = DB::select("SELECT * FROM notification_settings WHERE user_id = '".$request->user_id."'");;
        if(count($notification_settings) == 0){
            $NotificationSetting = new NotificationSetting();
            $NotificationSetting->user_id = $request->user_id;
            $NotificationSetting->save();
        }


        $NotificationSetting = NotificationSetting::getById($request->user_id);
        $this->__is_paginate = false;
        $this->__collection = true;
        $this->__is_collection = false;
        return $this->__sendResponse('NotificationSetting', $NotificationSetting, 200, 'notification settings retrieved successfully.');
    }

    public function userUpdateNotificationSettings(Request $request)
    {

        $notification_settings = DB::select("SELECT * FROM notification_settings WHERE user_id = '" . $request->user_id . "'");;
        if (count($notification_settings) == 0) {
            $NotificationSetting = new NotificationSetting();
            $NotificationSetting->user_id = $request->user_id;
            $NotificationSetting->save();
        }
        $data['is_notification_on'] = $request->is_notification_on;
        NotificationSetting::where('user_id',$request->user_id)->update($data);

        $NotificationSetting = NotificationSetting::getById($request->user_id);
        $this->__is_paginate = false;
        $this->__collection = true;
        $this->__is_collection = false;
        return $this->__sendResponse('NotificationSetting', $NotificationSetting, 200, 'notification settings retrieved successfully.');
    }
}
