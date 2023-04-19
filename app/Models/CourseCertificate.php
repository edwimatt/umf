<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class CourseCertificate extends Model
{
    protected $table = "course_certificates";

    public static function getUserQuizDetailsById($id){
        $query = self::select();
        return $query->where('id', $id)
            ->first();
    }
}
