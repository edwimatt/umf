<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class CourseCategoryDetails extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $base_url = URL::to('/');
        if(!empty($this->id)){
            $user_data = User::getUserDataById($request->user_id);
            $hospital_courses_data = DB::table("courses")
                ->select("courses.*","language_to_courses.*")
                ->selectRaw("IF(((SELECT count(*) FROM user_course_attempt where user_course_attempt.course_id = courses.id AND user_course_attempt.user_id = {$request->user_id}) > 0) ,1,0 ) AS is_completed")
                ->selectRaw('IF(courses.course_type = "quiz" , (SELECT COUNT(*) FROM `course_quizzes` WHERE course_quizzes.`course_id` = courses.id)  ,1) AS is_course')
                ->leftJoin("user_course_attempt","user_course_attempt.course_id","=","courses.id")
                ->leftJoin("language_to_courses","language_to_courses.course_id","=","courses.id")
                ->leftJoin("categories","categories.id","=","courses.category_id")
                ->leftJoin("quiz_questions","quiz_questions.course_id","=","courses.category_id")
                ->where("language_to_courses.language_id",$user_data[0]->language_id)
                ->where("courses.is_publish",1)
                ->where("courses.category_id",$this->id)
				->orderBy('language_to_courses.is_intro','asc')
                ->having('is_course','>','0')->groupBy("courses.id")->get();

            $hospital_courses_data_array = array();
            $hospital_courses_data_array2 = array();

            if($hospital_courses_data && count($hospital_courses_data) > 0){
                $course_ids = array_pluck($hospital_courses_data,["course_id"]);
                if($hospital_courses_data && count($hospital_courses_data) > 0){
                    $course_ids = array_pluck($hospital_courses_data,["course_id"]);
                    foreach ($hospital_courses_data as $hospital_courses_data_item)
                    {
                        if($hospital_courses_data_item->is_completed == 1){
                            if (($key = array_search($hospital_courses_data_item->course_id, $course_ids)) !== false) {
                                unset($course_ids[$key]);
                            }
                        }


                        $check_lock = (array_first($course_ids) == $hospital_courses_data_item->course_id) ? 1 : 0;
						//$check_lock = 1;
                        $hospital_courses_data_array['course_id'] = $hospital_courses_data_item->course_id;
                        $hospital_courses_data_array['course_name'] = $hospital_courses_data_item->course_title;

                        if($hospital_courses_data_item->video_file == ""){
                            $video_file = $base_url."/images/image_holder.png";
                        }else{
                            $video_file = $base_url.config('constants.MEDIA_IMAGE_PATH').$hospital_courses_data_item->video_file;
                        }

                        if($hospital_courses_data_item->video_file_thumb == ""){
                            $video_file_thumb = $base_url."/images/image_holder.png";
                        }else{
                            $video_file_thumb = $base_url.config('constants.MEDIA_IMAGE_PATH').$hospital_courses_data_item->video_file_thumb;
                        }
						$hospital_courses_data_array['is_intro'] = $hospital_courses_data_item->is_intro;
                        $hospital_courses_data_array['video_file'] = $video_file;
                        $hospital_courses_data_array['video_file_thumb'] = $video_file_thumb;
                        $hospital_courses_data_array['video_heading'] = $hospital_courses_data_item->video_heading;
                        $hospital_courses_data_array['video_description'] = $hospital_courses_data_item->video_description;
                        $hospital_courses_data_array['short_description'] = (!empty($hospital_courses_data_item->video_description)) ? strip_tags($hospital_courses_data_item->video_description) : '';
                        $hospital_courses_data_array['course_type'] = $hospital_courses_data_item->course_type;
                        if($hospital_courses_data_item->course_type == "video"){
                            $hospital_courses_data_array['is_completed'] = 1;
                        }else{
                            $hospital_courses_data_array['is_completed'] = ($hospital_courses_data_item->is_completed == 1) ? 1 : $check_lock ;
                        }
                        $hospital_courses_data_array['user_id'] = $request->user_id;
                        $hospital_courses_data_array2[] = $hospital_courses_data_array;
                    }

                }

            }

            $response = [
                'id' => $this->id,
                //'category_name' => $this->category_name,
                'category_type' => $this->category_type,
                //'description' => $this->description,
                'category_name' => (!empty($user_data[0]->language_id) && $user_data[0]->language_id == 1) ? $this->category_name : $this->spanish_category_name,
                'description' => (!empty($user_data[0]->language_id) && $user_data[0]->language_id == 1) ? $this->description : $this->spanish_description,
                'certificate_requirement' => $this->certificate_requirement,
                'certificate_confirmation' => $this->certificate_requirement,
                'hospital_courses' => $hospital_courses_data_array2,
            ];
            return $response;
        }else{
            return [];
        }
    }
}
