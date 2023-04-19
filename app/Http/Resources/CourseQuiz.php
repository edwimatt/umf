<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\URL;

class CourseQuiz extends Resource
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
        $quiz_questions = Course::getQuizQuestionsByCourseId($request->course_id,$this->language_id);


        if($this->video_file == ""){
            $video_file = $base_url."/uploads/user/default_user.png";
        }else{
            $video_file = $base_url.config('constants.MEDIA_IMAGE_PATH').$this->video_file;
        }

        if($this->video_file_thumb == ""){
            $video_file_thumb = $base_url."/images/image_holder.png";
        }else{
            $video_file_thumb = $base_url.config('constants.MEDIA_IMAGE_PATH').$this->video_file_thumb;
        }

        $quiz_questions_array = array();
        $quiz_questions_array2 = array();
        if($quiz_questions && count($quiz_questions) > 0){
            foreach ($quiz_questions as $quiz_question){
                $quiz_questions_array['question_id'] = $quiz_question->id;
                $quiz_questions_array['question_option_title'] = $quiz_question->question_option_title;
                $quiz_questions_array['question_title'] = $quiz_question->question_title;
                $quiz_questions_array['is_multiple_choice_question'] = $quiz_question->is_multiple_choice_question;
                $quiz_answers = Course::getQuizAnswersByQuizQuestionId($quiz_question->id,$quiz_question->language_id);
                $quiz_questions_array['quiz_answers'] = $quiz_answers;
                $quiz_questions_array2[] = $quiz_questions_array;

            }
        }
        
        $response = [
            'course_quiz_id' => $this->course_quiz_id,
            'category_id' => $this->category_id,
            'course_name' => $this->course_name,
            'video_file' => $video_file,
            'video_file_thumb' => $video_file_thumb,
            'video_heading' => $this->video_heading,
            'video_description' => $this->video_description,
            'short_description' => (!empty($this->video_description)) ? strip_tags($this->video_description) : '',
            'course_type' => $this->course_type,
            'quiz_questions' => $quiz_questions_array2,
        ];
        return $response;
    }
}
