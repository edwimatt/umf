<?php

namespace App\Models;

//use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    //use Notifiable;

    protected $table = "user";

    public static function loginWeb($email, $password){
        $query = self::select();
        return $query->where('email', $email)
            ->where('password', $password)
            ->where('user_type', "hospital")
            ->where('is_approved', "1")
            ->whereNull('deleted_at')
            ->first();
    }
    public static function getByEmail2($email){
        $query = self::select();
        return $query->where('email', $email)
            ->where('user_type','hospital')
            ->limit(1)
            ->get();
    }
    public static function createUser($user)
    {
        $obj = new static();

        $name = explode(' ', $user['name']);

        $obj->image_url    = $user['image_url_path'];
        $obj->first_name    = $user['first_name'];
        $obj->last_name     = $user['last_name'];
        $obj->email         = $user['email'];
        $obj->department_id         = $user['department_id'];
        $obj->hospital_id         = $user['hospital_id'];
        $obj->password      = $user['password'];
        $obj->token         = self::getToken();
        $obj->device_type   = $user['device_type'];
        $obj->device_token  = $user['device_token'];
        $obj->device        = $user['device'];

        $obj->save();

        return $obj->id;
    }
    public static function createHospitalUser($user)
    {
        $obj = new static();
        $obj->first_name    = $user['first_name'];
        $obj->last_name     = $user['last_name'];
        $obj->email         = $user['email'];
        $obj->password      = $user['password'];
        
        if(!empty($user["hospital_image"])){
          $obj->image_url      = $user["hospital_image"];
        }
        
        $obj->user_type      = "hospital";
        $obj->save();
        return $obj->id;
    }

    public static function createUserSetting($user_id)
    {
        \DB::statement("INSERT INTO user_setting (SELECT id, $user_id, `value`, NOW(), NOW() FROM setting
                        WHERE key_type = 'user')");
        return true;
    }

    public static function getToken()
    {
        return md5(Config::get('constants.APP_SALT').time());
    }

    public static function getById($id){

        $query = self::select("user.*","user.id as user_user_id",'hospital.name AS hospital_name');
        return $query->where('user.id', $id)
            ->leftJoin('hospital', 'hospital.id','user.hospital_id')
            ->first();
    }

    public static function getByEmail($email){

        $query = self::select();
        return $query->where('email', $email)
            ->get();
    }

    public static function getBySocial($params){

        $query = self::select();
        return $query->where('social_id', $params['social_id'])
            ->where('social_type', $params['social_type'])
            ->get();
    }

    public static function getByPasswordHash($hash){

        $query = self::select();
        return $query->where('forgot_password_hash', $hash)
            ->get();
    }

    public static function auth($token){

        if(empty($token))
            return false;

        $query = self::select(["user.*","u.is_active AS hospital_is_active"]);
        $result = $query->where("user.token" ,$token)
            ->leftJoin("user AS u", "u.id","=","user.hospital_id")
            ->whereNull('user.deleted_at')
            ->first();

        if(!is_null($result) && $result->count())
            return $result;

        return false;
    }

    public static function updateByEmail($email, $data){

        $qry_params = [];

        foreach($data as $column => $row){
            $qry_params[] = " $column = '$row' ";
        }

        \DB::statement('UPDATE user SET ' . implode(', ', $qry_params) . " WHERE email = '$email'");
        return true;
    }

    public static function getUserByUserId($user_id){

        $query = self::select();
        return $query->where('id', $user_id)
            ->first();
    }
    public static function login($email, $password){

        $query = self::select(["user.*","u.is_active AS hospital_is_active"]);
        $result = $query->where("user.email" ,$email)
            ->leftJoin("user AS u", "u.id","=","user.hospital_id")
            ->whereNull('user.deleted_at')
            ->first();

        return $result;
    }

    public static function loginById($user_id, $password){

        $query = self::select("user.*",'hospital.name AS hospital_name');
        return $query->leftJoin('hospital', 'hospital.id','user.hospital_id')
            ->where('user.id', $user_id)
            ->where('user.password', $password)
            ->get()->unique();
    }

    public static function getUserDataById($user_id)
    {
        //return DB::select("SELECT * FROM `user` WHERE id = '".$user_id."'");
        return self::select("user.*")
            ->selectRaw("IF(user.language_id IS NOT NULL, languages.id, 1) AS language_id")
            ->selectRaw("IF(user.language_id IS NOT NULL, languages.language_name,'english') AS language_name")
            ->where("user.id",$user_id)
            ->leftJoin("languages" , "languages.id","=","user.language_id")
            ->get();
    }

    public static function getUserByID($id){
        $query = self::select();
        return $query->where('id', $id)
            ->limit(1)
            ->get();
    }

    public static function getTotalUser($data)
    {
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $sql = "";
        $sql .= "SELECT count(*) as users FROM user WHERE user.id  > 0 AND user.deleted_at IS NULL";
        if($from_date != ""){
            $sql .= " AND user.created_at >= '".$from_date."'";
        }
        if($to_date != ""){
            $sql .= " AND user.created_at <= '".$to_date."'";
        }
        $user = DB::select($sql);
        return $user;
    }

    public static function getTotalLiveUser($data)
    {
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $sql_user_live = "";
        $sql_user_live .= "SELECT count(*) as users_live FROM user WHERE user.device_type is not null AND user.deleted_at IS NULL";
        if($from_date != ""){
            $sql_user_live .= " AND user.created_at >= '".$from_date."'";
        }
        if($to_date != ""){
            $sql_user_live .= " AND user.created_at <= '".$to_date."'";
        }
        $user_live = DB::select($sql_user_live);
        return $user_live;
    }

    public static function getLanguages()
    {
        $query = \DB::table('languages');
        $query->select('languages.*');
        return $query->paginate(Config::get('constants.PAGINATION_PAGE_SIZE'));
    }

    public static function getHospitals()
    {
        $query = \DB::table('user');
        $query->select('user.*', 'hospital.*');
        $query->join('hospital', 'hospital.user_id', 'user.id');
        $result = $query->orderby('user.id','first_name')->paginate(50);
        return $result;
    }

    public static function getPhysicianList2()
    {
        $hospital_id = 0;
        $hospital_condition = '>';

        if(isset($_GET['hospital_id']))
        {
            $hospital_id = $_GET['hospital_id'];
            if($hospital_id > 0){
                $hospital_condition = '=';
            }else{
                $hospital_condition = '>';

            }
        }

        $name = '';

        if(isset($_GET['name']))
        {
            $name = $_GET['name'];
        }
        $query = \DB::table('user');
        $query->select('user.*','hospital.name as hospital_name','user.first_name','user.last_name','user.last_name',  'user.hospital_id');
        $query->join('hospital', 'hospital.id', 'user.hospital_id');
        $query->where('user.hospital_id', $hospital_condition, $hospital_id);
        $query->where(DB::raw('concat(first_name," ",last_name)'), 'like', '%'.$name.'%');
        $result = $query->orderby('user.first_name','asc')->paginate(50);



        return $result;
    }


    public static function deletePhysicianData($id)
    {
        DB::select("DELETE FROM notification WHERE target_id = $id");
    }

    public static function deletePhysicianDataAfter($id)
    {
        DB::select("DELETE FROM user WHERE id = $id");
        DB::select("DELETE FROM notification WHERE target_id = $id");
    }
} 