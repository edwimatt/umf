<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class LanguageToCourseContent extends Model
{
    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'language_to_course_contents';
}


