<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCourseAttempt extends Model
{
    protected $table = "user_course_attempt";

    public static function getByKey ($key)
    {
        return self::select('value')
                ->where('key', $key)
                ->first();
    }
}
