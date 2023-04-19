<?php

namespace App\Console\Commands;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExpireNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:expire_notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire Notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // php artisan command:profile_update_notification
        $current_date = \Carbon\Carbon::now();
        $users = DB::select("SELECT * FROM user WHERE is_approved = '1' AND plan_expiry_date IS NOT NULL");
        if(count($users) > 0){
            foreach ($users as $userItem){

                if($userItem->plan_expiry_date != ""){
                    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $userItem->plan_expiry_date);
                    $diff_in_days = $current_date->diffInDays($from);
                    if($diff_in_days == 7 || $diff_in_days == 6 || $diff_in_days == 5  || $diff_in_days == 4 || $diff_in_days == 3  || $diff_in_days == 2 || $diff_in_days == 1){
                        $user = User::where('id', 0)->first();
                        $targetUser = User::where('id', $userItem->id)->first();
                        $obj = new Notification();
                        $obj->actor_id = 0;
                        $obj->target_id = $targetUser->id;
                        $obj->title = 'Account Subscription Notification';
                        $obj->description = ucwords($targetUser->full_name)."Your account subscription will expire on ".date("F j, Y, g:i a", strtotime($userItem->plan_expiry_date)).".";
                        $obj->type = 'email';
                        $obj->is_viewed = '0';
                        $obj->save();
                    }
//                    if($diff_in_days)
                }
            }
        }
    }
}
