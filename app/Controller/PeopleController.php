<?php
/**
 * Created by PhpStorm.
 * User: nakul
 * Date: 6/11/14
 * Time: 5:15 PM
 */

class PeopleController extends AppController {

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
     * get all the participants
     * @param $classroomId
     */
    public function getPeople($classroomId) {
        $this->response->type('json');

        $this->loadModel("UsersClassroom");
        $this->loadModel("Classroom");

        $page = 1;
        $userId = AuthComponent::user('id');

        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];
        }

        $data = $this->UsersClassroom->getPaginatedPeople($classroomId, $page);
        $status = !empty($data);
        $message = "";

        //CRUD - Create Read Update Delete permissions for
        //specified actions
        $isOwner = $this->Classroom->isOwner($userId, $classroomId);
//        $isModerator = $this->Classroom->isModerator($userId, $classroomId);
        $permissions = array(
            'CUDmoderator' => $isOwner,
            'CUDrestricted' => $isOwner
        );
        /**
         * Setting data for json view.
         * this code repeats
         * two steps, set and then _serialize
         */
        $this->set(compact('data', 'status', 'message', 'permissions'));
        $this->set('_serialize', array('data', 'status', 'message', 'permissions'));
    }

    public function setModerator($classroomId) {
        $this->loadModel("UsersClassroom");
        $data = array();
        $message = "";

        $this->request->onlyAllow('post');
        $userIdsList = explode(",", $this->request->data['ids']);
        $status = $this->UsersClassroom->setModerator($classroomId, $userIdsList);

        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

    public function removeModerator($classroomId) {
        $this->loadModel("UsersClassroom");
        $data = array();
        $message = "";

        $this->request->onlyAllow('post');
        $userIdsList = explode(",", $this->request->data['ids']);
        $status = $this->UsersClassroom->removeModerator($classroomId, $userIdsList);

        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

    public function setRestricted($classroomId) {
        $this->loadModel("UsersClassroom");
        $data = array();
        $message = "";

        $this->request->onlyAllow('post');
        $userIdsList = explode(",", $this->request->data['ids']);
        $status = $this->UsersClassroom->setRestricted($classroomId, $userIdsList);

        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

    public function removeRestricted($classroomId) {
        $this->loadModel("UsersClassroom");
        $data = array();
        $message = "";

        $this->request->onlyAllow('post');
        $userIdsList = explode(",", $this->request->data['ids']);
        $status = $this->UsersClassroom->removeRestricted($classroomId, $userIdsList);

        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }


    /**
     * API: follow/unfollow a user POST form
     * Expecting:
     * data[Follower][id]*
     * data[Followee][id]*
     */
    public function toggleFollow() {
        $this->request->onlyAllow('post'); // No direct access via browser URL - Note for Cake2.5: allowMethod()
        $this->response->type('json');

        $status = false;
        $message = "";
        $data = array();

        $request = $this->request->data;
        if (isset($request['Follower']['id']) && isset($request['Followee']['id'])) {
            $this->loadModel("Follow");
            $response = $this->Follow->toggleFollow($request['Follower']['id'], $request['Followee']['id']);
            $status = $response['status'];
            $message = $response['message'];
        } else {
            $message = "Missing parameters";
        }

        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }
}