<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('File', 'Utility');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
	if($this->frontLeaderBoard==1)
	{
		
		//////////////////// CUSTOM QUERY START ///////////////////////
		$this->loadModel('Leaderboard');
		$scoreboard=$this->Leaderboard->query("SELECT `points`,`student_id`,`exam_given`,`name` FROM (SELECT ROUND(SUM(`percent`)/((SELECT COUNT( `id` ) FROM `exam_results` WHERE `student_id` = `ExamResult`.`student_id`)),2) AS `points` ,`student_id`,(SELECT COUNT( `id` ) FROM `exam_results` WHERE `student_id` = `ExamResult`.`student_id`) AS `exam_given`, `Student`.`name` FROM `exam_results` AS `ExamResult`INNER JOIN `students` AS `Student` ON `ExamResult`.`student_id` = `Student`.`id` WHERE `finalized_time` IS NOT NULL GROUP BY `student_id`) `Selection` ORDER BY `points` DESC LIMIT 10");
		//////////////////// CUSTOM QUERY END ///////////////////////
		$this->set('scoreboard',$scoreboard);		
	}
	$this->loadModel('Advertisement');
	$this->loadModel('Testimonial');
	$this->loadModel('Student');
        $this->loadModel('Exam');
        $this->set('students',$this->Student->find('count'));
        $this->set('exams',$this->Exam->find('count'));
        $this->set('testimonials',$this->Testimonial->findAllByStatus('Active'));
	$this->set('advertisements',$this->Advertisement->findAllByStatus('Active'));
        
	$file = new File(TMP.'visitors.txt',false);
        $visitors=$file->read(true);
	$file->close();
	$file = new File(TMP.'visitors.txt',false);
	$visitors++;
	$file->write($visitors);
        $file->close();
	$this->set('visitors',$visitors);
        
		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
		
	}
	
        
        

}
