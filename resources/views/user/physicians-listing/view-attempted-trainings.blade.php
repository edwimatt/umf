@include('user.include.header')
@include('user.include.sidebar')
<div class="right_col" role="main">
   <div class="panel panel-default">

         <div class="panel-heading cust-head">Attempted Trainings</div>
      <table class="table table-striped jambo_table">
         <thead>
         <tr>
            <th scope="col">Course Title</th>
            <th scope="col">Course Quiz Title</th>
            <th scope="col">Percentage</th>
            <th scope="col">Is passed?</th>
         </tr>
         </thead>
         <tbody>

         <?PHP

         if(isset($user_quizzes) && count($user_quizzes) > 0){

         foreach ($user_quizzes as $user_quizzes_data){
            //dd($user_quizzes_data);
         ?>
         <tr>
            <td><?PHP echo $user_quizzes_data->course_title?> </td>
            <td><?PHP echo $user_quizzes_data->course_quiz_title?> </td>
            <td><?PHP echo $user_quizzes_data->quiz_percentage?> </td>
            <td><?PHP
               if($user_quizzes_data->is_quiz_passed == 1){
                  echo "Yes";
               }else{
                  echo "No";
               }
               ?>
            </td>

         </tr>
         <?PHP } ?>
         <?PHP } ?>
         </tbody>
      </table>




   </div>
   <hr class="border">
   <div class="row" id="pg-content">
   </div>



</div>

@include('user.include.footer')