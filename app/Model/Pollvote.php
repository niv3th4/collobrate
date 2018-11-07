<?php

App::uses('AppModel', 'Model');

/**
 * Pollvote Model
 * @property User $User
 * @property Pollchoice $Pollchoice
 */
class Pollvote extends AppModel {

    /**
     * belongsTo associations
     * @var array
     */
    public $belongsTo = array(
        'AppUser' => array(
            'className' => 'AppUser',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Pollchoice' => array(
            'className' => 'Pollchoice',
            'foreignKey' => 'pollchoice_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );


    /**
     * Check if a user has voted on a Discussion type Poll
     * @param $discussionId
     * @param $userId
     * @return bool
     */
    public function hasVotedOnPoll($discussionId, $userId) {
        //get the list of PollChoiceIds for given Discussion of type Poll
        $pollChoiceIdList = $this->Pollchoice->getPollChoiceList($discussionId);

        //check if user has voted on any of the poll choices
        $options['conditions'] = array(
            'Pollchoice.id IN' => $pollChoiceIdList,
            'AppUser.id' => $userId
        );

        $options['contain'] = array(
            'AppUser' => array(
                'fields' => array(
                    'id'
                )
            ),
            'Pollchoice' => array(
                'fields' => array(
                    'id'
                )
            )
        );

        $data = $this->find('first', $options);
        return !empty($data);
    }

    public function hasVotedOnChoice($pollChoiceId, $userId) {
        $conditions = array(
            'user_id' => $userId,
            'pollchoice_id' => $pollChoiceId
        );
        return $this->hasAny($conditions);
    }

    /**
     * User votes on a pollChoice for a poll type Discussion
     * @param  $userId Voter's user ID
     * @param  $pollChoiceId pollchoice_id of the choice on poll voted for
     * @return bool
     */
    public function setPollVote($userId, $pollChoiceId) {

        $discussionId = $this->Pollchoice->getDiscussionId($pollChoiceId);

        //check if its a valid PollChoice to be voted on
        if (!$this->Pollchoice->findById($pollChoiceId)) {
            $this->log("Invalid pollchoice id");
            return false;
        }

        //check if already voted
        if ($this->hasVotedOnPoll($discussionId, $userId)) {
            $this->log("already voted on this poll");
            return false;
        }

        $this->Pollchoice->id = $pollChoiceId;
        $newVotes = $this->Pollchoice->field('votes') + 1;
        $this->log($newVotes);
        //            $this->Pollchoice->id = $pollChoiceId;
        //            $this->Pollchoice->saveField('votes' , $newVotes);

        //great the sweet model notation refuses to work
        //just upgrade to the new ORM, this battle is OVER!
//        $data = array(
//            'AppUser' => array(
//                'id' => $userId
//            ),
//            'Pollchoice' => array(
//                'id' => $pollChoiceId,
//                'votes' => $newVotes
//            )
//        );

        $data = array(
            'user_id' => $userId,
            'pollchoice_id' => $pollChoiceId
        );
        $result = $this->save($data);
        //TODO : use a transaction instead!
        if (!empty($result)) {
            $this->Pollchoice->saveField('votes', $newVotes);
        }
//        $this->log($result);
//        $this->log($this->getDataSource()->getLog(false, false));
        return !empty($result);
    }
}
