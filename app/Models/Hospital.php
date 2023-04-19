<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Hospital extends Model
{
    protected $table = "hospital";

    use SoftDeletes;
    public $timestamps = true;

    public static function getList($id = 0){

        $query = self::select();
        if($id > 0){
            $query = $query->where('id', $id);
        }
        $query->orderBy('name');
        $record = $query->whereNull('deleted_at')->get();
        return $record;
    }

    public static function getHospitalList()
    {
        return DB::select("SELECT * FROM hospital ORDER BY name ASC");
    }

    public static function deleteHospitalById($id)
    {
        $physicians = DB::select("SELECT * FROM user WHERE hospital_id = '" . $id . "'");
        if (count($physicians) > 0) {
            foreach ($physicians as $physician) {
                DB::select("DELETE FROM notification WHERE target_id = '" . $physician->id . "'");
                DB::select("DELETE FROM user WHERE id = '" . $physician->id . "'");
            }
        }
        DB::select("DELETE FROM hospital WHERE id = '" . $id . "'");
    }


}
