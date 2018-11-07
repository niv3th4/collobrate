<?php
/**
 */
App::uses('AppController', 'Controller');
App::uses('DateConvertor', 'Lib/Custom');

/*
 * Description of ClassroomsController
 */
class ClassroomsController extends AppController {

    /**
     * Controller authorize
     * user determined from token
     * @param $user
     * @return bool
     */
    public function isAuthorized($user) {
        if (parent::isAuthorized($user)) {
            //do role processing here
            return true;
        } else {
            return false;
        }
    }

    /**
     * TODO: Make getList APIs ajax dropdowns
     */
    /**
     * get Campus List for Create Classroom Form
     */
    public function getCampusesList() {
        $this->request->onlyAllow('get');
        $data = $this->Classroom->Campus->find('list');
        $status = true;
        $message = "";

        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

    /**
     * get Campus List for Create Classroom Form
     */
    public function getDepartmentsList() {
        $this->request->onlyAllow('get');
        /**
         * TODO: get departments based on campus input
         */
        $data = $this->Classroom->Department->find('list');
        $status = true;
        $message = "";

        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

    /**
     * get Campus List for Create Classroom Form
     */
    public function getDegreesList() {
        $this->request->onlyAllow('get');
        /**
         * TODO: get degrees based on campus input
         */
        $data = $this->Classroom->Degree->find('list');
        $status = true;
        $message = "";

        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

    /**
     * API: Create a new classroom form
     */
    public function add() {
        $this->request->onlyAllow('post');
        $data = array();

        $this->request->data['Classroom']['duration_start_date'] = DateConvertor::convert($this->request->data['Classroom']['duration_start_date']);
        $this->request->data['Classroom']['duration_end_date'] = DateConvertor::convert($this->request->data['Classroom']['duration_end_date']);

        if ($this->Classroom->add(AuthComponent::user('id'), $this->request->data)) {
            $status = true;
            $message = "Successfully created classroom";
            $data = $this->Classroom->getLatestTile(AuthComponent::user('id'));
        } else {
            $status = true;
            $message = "Successfully created classroom";
        }
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

    /**
     * API stud: invite users to classroom
     */
    public function invite() {
    }

    /**
     * Join a classroom provided access code form
     */
    public function join() {
        $this->request->onlyAllow('post'); // No direct access via browser URL - Note for Cake2.5: allowMethod()
        $this->response->type('json');

        $status = false;
        $message = "";
        $data = array();

        $classroomId = $this->Classroom->getClassroomIdWithCode($this->request->data[$this->modelClass]['access_code']);
        if (!isset($classroomId)) {
            $status = false;
            $message = 'Invalid Access Code';
        } else {
            $returned = $this->Classroom->UsersClassroom->joinClassroom(AuthComponent::user('id'), $classroomId, false);
            $status = $returned['status'];
            $message = $returned['message'];

            if ($status === true) {
                $data = $this->Classroom->getLatestTile(AuthComponent::user('id'));
            }
        }

        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

    /**
     * API : get classroom of a user in paginated form
     */
    public function getclassrooms() {
        $this->response->type('json');
        $page = 1;

        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];
        }
        $status = true;
        $message = "";

        $this->set(compact('status', 'message'));

        $data = $this->Classroom->getPaginatedClassrooms(AuthComponent::user('id'), $page);
        $permissions = array(
            'allowCreate' => $this->Classroom->allowCreate(AuthComponent::user('id'))
        );
        /**
         * Setting data for json view.
         * this code repeats
         * two steps, set and then _serialize
         */
        $this->set('data', $data);
        $this->set(compact('status', 'message', 'permissions'));
        $this->set('_serialize', array('data', 'status', 'message', 'permissions'));
    }

    /**
     * API : Reset the access code of a classroom
     * @param $classroomId
     */
    public function resetCode($classroomId) {
        $this->request->onlyAllow('post'); // No direct access via browser URL - Note for Cake2.5: allowMethod()
        $this->response->type('json');

        $response = $this->Classroom->resetCode($classroomId);
        $data = array();

        if ($response) {
            $status = true;
            $message = "Access code successfully reset";
            $data = $response;
        } else {
            $status = false;
            $message = "Access code could not be reset";
        }
        /**
         * Setting data for json view.
         * this code repeats
         * two steps, set and then _serialize
         */
        $this->set(compact('data', 'status', 'message'));
        $this->set('_serialize', array('data', 'status', 'message'));
    }
}
