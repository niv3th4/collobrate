<?php

App::uses('CakeEmail', 'Network/Email');
/*
 */

class AnnouncementsController extends AppController {

    public $helpers = array('Time');

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

    public function getAnnouncements($classroomId) {
        $this->response->type('json');
        $page = 1;
        $userId = AuthComponent::user('id');

        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];
        }
        $status = true;
        $message = "";

        $data = $this->Announcement->getPaginatedAnnouncements($classroomId, $page);
        $permissions = array(
            'allowCreate' => $this->Announcement->allowCreate($classroomId, $userId)
        );
        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message', 'permissions'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message', 'permissions'));
    }

    public function add($classroomId) {
        $this->request->onlyAllow('post');
        $this->response->type('json');

        $status = false;
        $message = "";
        $userId = AuthComponent::user('id');

        $data = $this->request->data;

        if ($this->Announcement->createAnnouncement($classroomId, $data, $userId)) {
            $data = $this->Announcement->getAnnouncementById($this->Announcement->getLastInsertID());
            $message = "Announcement created";
            $status = true;
            $this->Announcement->sendEmails($classroomId, $data);
        } else {
            $message = "Could not create announcement";
            $status = false;
        }
        $this->set('data', $data);
        $this->set(compact('status', 'message'));
        $this->set('_serialize', array('status', 'message', 'data'));
    }
}
