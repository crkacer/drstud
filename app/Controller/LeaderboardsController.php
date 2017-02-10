<?php
class LeaderboardsController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();           
    }
    public function index()
    {
       //////////////////// CUSTOM QUERY START ///////////////////////
        $scoreboard=$this->Leaderboard->query("SELECT `points`,`student_id`,`exam_given`,`name` FROM (SELECT ROUND(SUM(`percent`)/((SELECT COUNT( `id` ) FROM `exam_results` WHERE `student_id` = `ExamResult`.`student_id`)),2) AS `points` ,`student_id`,(SELECT COUNT( `id` ) FROM `exam_results` WHERE `student_id` = `ExamResult`.`student_id`) AS `exam_given`, `Student`.`name` FROM `exam_results` AS `ExamResult`INNER JOIN `students` AS `Student` ON `ExamResult`.`student_id` = `Student`.`id` WHERE `finalized_time` IS NOT NULL GROUP BY `student_id`) `Selection` ORDER BY `points` DESC LIMIT 10");
        //////////////////// CUSTOM QUERY END ///////////////////////
        $this->set('scoreboard',$scoreboard);   
    }
}