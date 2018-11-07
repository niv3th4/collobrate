<?php

/*
 * TODO : Add detailed licence headers
 */
App::uses('AppController', 'Controller');

class DiscussionsController extends AppController {

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
     * get 1st paginated discussions to inject into view
     * Display Discussions of a classroom
     * @param type $classroomId
     */
//    public function index($classroomId) {
//        $data = $this->Discussion->getPaginatedDiscussions($classroomId, AuthComponent::user('id'), 1);
//        $data = $this->Discussion->processData($data, AuthComponent::user('id'));
//
//        /**
//         * express gamification keys
//         */
//        $gamificationKeys = array(
//            'en' => 'Engagement',
//            'in' => 'Intelligence',
//            'cu' => 'Curious',
//            'co' => 'Contribution',
//            'ed' => 'Endorsement',
//        );
//        $this->set('Classroom.id', $classroomId);
//        $this->set(compact('classroomId', 'gamificationKeys'));
//        $this->set('data', json_encode($data));
//    }

    /**
     * API: get paginated discussions
     * @param int $classroomId classroom id(pk)
     */
    public function getdiscussions($classroomId) {
        $this->response->type('json');
        $page = 1;
        $userId = AuthComponent::user('id');

        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];
        }
        $status = true;
        $message = "";

        if (isset($this->params['url']['folded']) && $this->params['url']['folded'] == "true") {
            $data = $this->Discussion->Foldeddiscussion->getPaginatedFoldedDiscussions($classroomId, $userId, $page);
        } else {
            $data = $this->Discussion->getPaginatedDiscussions($classroomId, $userId, $page);
        }
        $data = $this->Discussion->processData($data, $userId);

        $permissions = array(
            'allowCreate' => $this->Discussion->allowCreate($classroomId, $userId)
        );

        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message', 'permissions'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message', 'permissions'));
    }

    /**
     * API: get paginated replies
     * Getting replies for a discussion
     */
    public function getreplies() {
        $this->response->type('json');
        $page = 1;

        $data = array();
        $status = true;
        $message = "";

        if (isset($this->params['url']['page'])) {
            $page = $this->params['url']['page'];

            if (isset($this->params['url']['discussion_id'])) {
                $discussionId = $this->params['url']['discussion_id'];

                $data = $this->Discussion->Reply->getPaginatedReplies($discussionId, $page);
                $data = $this->Discussion->Reply->processReplies($data, AuthComponent::user('id'));
//                $data['moreReplies'] = $this->Discussion->Reply->setMoreRepliesFlag($page, $discussionId);
            }
        }
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

    /**
     * API: delete.json
     * Deleting a Discussion/Reply
     */
    public function delete() {
        $this->request->onlyAllow('post');
        $this->response->type('json');

        $status = false;
        $message = "";
        $userId = AuthComponent::user('id');

        if (isset($this->request->data)) {
            $type = $this->request->data['type'];
            $id = $this->request->data['id'];
        }

        if ($type == 'Discussion') {
            $status = $this->Discussion->deleteDiscussion($id, $userId);
        } elseif ($type == 'Reply') {
            $status = $this->Discussion->Reply->deleteReply($id, $userId);
        }

        if ($status) {
            $message = "{$type} deleted successfully";
        } else {
            $message = "Could not delete {$type}, Already deleted or unauthorized";
        }
        $this->set(compact('status', 'message'));
        $this->set('_serialize', array('status', 'message'));
    }

    /**
     * API: fold.json
     * Toggle fold/unfold of a discussion of logged in user
     */
    public function togglefold() {
        $this->request->onlyAllow('post');
        $this->response->type('json');

        $status = false;
        $message = "The discussion may have been deleted, or cannot be folded right now";
        $userId = AuthComponent::user('id');

        if (isset($this->request->data['id'])) {
            $discussionId = $this->request->data['id'];
            $status = !empty($this->Discussion->toggleFold($discussionId, $userId));
            if ($status) {
                $message = "Successfully toggled";
            }
        }
        $this->set(compact('status', 'message'));
        $this->set('_serialize', array('status', 'message'));
    }

    /**
     * API: add.json
     * Posting discussion (question/poll/note)
     */
    public function add($classroomId) {
        $this->request->onlyAllow('post');
        $this->response->type('json');

        $savedData = $this->request->data;
        $userId = AuthComponent::user('id');

        $savedData['Discussion']['user_id'] = $userId;
        $savedData['Discussion']['classroom_id'] = $classroomId;

        if ($this->Discussion->saveAssociated($savedData)) {
            $status = true;
            $message = "";

            $data = $this->Discussion->getPaginatedDiscussions($classroomId, $userId, 1, true);
//            $this->log($data);
            $data = $this->Discussion->processData($data, $userId);
//            $this->log($data);
//            $returnedData = $savedData;
        } else {
            $status = false;
            $message = "The Discussion could not be posted";
            $data = array(); //required for json consistency
        }
        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

    /**
     * API: ajax posting a reply for a given discussion
     */
    public function addReply() {
        $this->request->onlyAllow('post');
        $this->response->type('json');
        $userId = AuthComponent::user('id');

        $data = array();
        $discussionId = $this->request->data['discussion_id'];
        $comment = $this->request->data['comment'];

        if ($this->Discussion->Reply->postReply($discussionId, $comment, $userId)) {
            $status = true;
            $message = "";
            $data = $this->Discussion->Reply->getPaginatedReplies($discussionId, 1, true);
            $data = $this->Discussion->Reply->processReplies($data, $userId);
        } else {
            $status = false;
            $message = "Could not post the reply";
        }

        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

    /**
     * API: set gamification vote on Discussion/Reply
     */
    public function setGamificationVote() {
        $this->request->onlyAllow('post');
        $this->response->type('json');

        $status = false;
        $data = array();
        $message = "";
        $userId = AuthComponent::user('id');

        if (isset($this->request->data)) {
            $id = $this->request->data['id'];
            $type = $this->request->data['type'];
            $vote = $this->request->data['vote'];
            $status = $this->Discussion->Gamificationvote->setGamificationVote($type, $id, $vote, $userId);
            if ($status) {
                $data = $this->Discussion->Gamificationvote->getGamificationInfo($type, $id);
            }
        }
        $this->set(compact('status', 'message', 'data'));
        $this->set('_serialize', array('status', 'message', 'data'));
    }

    /**
     * API : Voting on a choice of a Poll
     */
    public function setPollVote() {
        $this->request->onlyAllow('post');
        $this->response->type('json');

        $data = array();
        $userId = AuthComponent::user('id');
        $message = "something";
        $status = true;

        if (isset($this->request->data['pollchoice_id'])) {
            $pollchoiceId = $this->request->data['pollchoice_id'];
            if ($this->Discussion->Pollchoice->Pollvote->setPollVote($userId, $pollchoiceId)) {
                $status = true;
                $discussionId = $this->Discussion->Pollchoice->getDiscussionId($pollchoiceId);
                $data = $this->Discussion->getDiscussionById($discussionId);
                $data = $this->Discussion->processData($data, AuthComponent::user('id'));
            } else {
                $status = false;
                $message = "Poll doesn't exist or already voted";
            }
        } else {
            $status = false;
            $message = "Missing poll information";
        }

        /**
         * finalize and set the response for the json view
         */
        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

}
