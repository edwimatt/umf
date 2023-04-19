<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'news';



    public static function getById($id,$params=NULL){
        $query = self::select();
        if(!empty($params['hospital_id'])){
            $query->where("hospital_id",$params['hospital_id']);
        }
        return $query->where('id', $id)
            ->first();
    }

    public static function getNews($params = NULL)
    {
        $query = \DB::table('news');
        $query->select(
            'news.*'
        );

        if(!empty($params['hospital_id'])){
            $query->whereIn("hospital_id",[0, $params['hospital_id']]);
        }
        
        $query->whereNull('deleted_at');

        return $query->orderBy("id", "DESC")->paginate(200);
    }

    public static function getNewsDetailsById($id)
    {
        $query = \DB::table('news');
        $query->select(
            'news.*'
        );
        $query->where('news.id', '=', $id);
        $query->whereNull('deleted_at');
        return $query->first();
    }


}


