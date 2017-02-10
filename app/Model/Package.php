<?php
class Package extends AppModel
{
  public $useTable='groups';
  //public $hasAndBelongsToMany=array('Exam'=>array('className'=>'Exam',
  //                                                   'joinTable' => 'packages_exams',
  //                                                   'foreignKey' => 'package_id',
  //                                                   'associationForeignKey' => 'exam_id'));
}
?>