<?php
/**
 * Created by PhpStorm.
 * User: nakul
 * Date: 7/4/14
 * Time: 12:36 PM
 */

App::uses('AppController', 'Controller');

class SubmissionsController extends AppController{

    public function index($classroomId){
        $this->set('classroomId', $classroomId);
    }
} 