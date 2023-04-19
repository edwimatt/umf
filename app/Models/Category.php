<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $table = "categories";

    public static function getById($id)
    {
        $query = self::select();
        return $query->where('id', $id)
            ->first();
    }

    public static function getCategories($params,$category_id = NULL)
    {
        //$user_data = User::where("id",$params['user_id'])->first();
        $query = DB::table("categories")->select("categories.*")
            //->selectRaw('IF(language_to_courses.language_id = 1 , categories.category_name, categories.spanish_category_name) AS category_name')
            //->selectRaw('IF(((language_to_courses.language_id = 1) || language_to_courses.language_id IS NULL) , categories.description, categories.spanish_description) AS description')
            ->selectRaw('IF(categories.category_type = "quiz" , (SELECT COUNT(*) FROM `course_quizzes` WHERE course_quizzes.`course_id` = courses.id)  ,1) AS is_course');
        $query->leftJoin('courses', 'categories.id', '=', 'courses.category_id');
        $query->leftJoin('language_to_courses', 'language_to_courses.course_id', '=', 'courses.id');
        //$query->where('language_to_courses.language_id', $user_data->language_id);

        if(!empty($category_id)){
            $query->where('categories.id', $category_id);
            $query->groupBy('categories.id');
            return $query->get();
        }else{
            $query->where('courses.is_publish', 1);
            //$query->having('is_show','>','0');
            $query->having('is_course','>','0');
            $query->groupBy('categories.id');
			 return  $query->get();
	
        }
    }
}
