<?php
App::uses('AppModel', 'Model');
/**
 * Gamificationvote Model
 *
 * @property AppUser $User
 * @property Discussion $Discussion
 * @property Reply $Reply
 */
class Gamificationvote extends AppModel {

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
        'Discussion' => array(
            'className' => 'Discussion',
            'foreignKey' => 'discussion_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Reply' => array(
            'className' => 'Reply',
            'foreignKey' => 'reply_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    protected $votes = array(
        'cu', 'in', 'co', 'en', 'ed'
    );

    /**
     * Checks if a user has voted on a reply or discussion
     * @param $type (Discussion,Reply)
     * @param $id
     * @param $userId
     * @return boolean
     */
    public function hasVoted($type, $id, $userId) {
        $conditions = array(
            'user_id' => $userId
        );

        if ($type == 'Discussion') {
            $conditions['discussion_id'] = $id;
        } elseif ($type == 'Reply') {
            $conditions['reply_id'] = $id;
        }

        if ($this->hasAny($conditions)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Vote on a particular Discussion or Reply
     * @param $type (Discussion/Reply)
     * @param int $id
     * @param enum $vote
     * @param int $userId
     * @return bool
     */
    public function setGamificationVote($type, $id, $vote, $userId) {

        $validVote = in_array($vote, $this->votes);

        // Check if the discussion/reply exists
        if ($type == 'Discussion') {
            $this->Discussion->id = $id;
            $data = $this->Discussion->find('first', array(
                'conditions' => array(
                    'id' => $id
                ),
                'recursive' => -1
            ));
        } elseif ($type == 'Reply') {
            $this->Reply->id = $id;
            $data = $this->Reply->find('first', array(
                'conditions' => array(
                    'id' => $id
                ),
                'recursive' => -1
            ));
        }
        if (!$data) {
            return false;
        }

        // Ensuring no self vote
        if ($data[$type]['user_id'] != $userId) {
            // Ensuring no duplicate vote, and vote is a valid type
            if (!$this->hasVoted($type, $id, $userId) && $validVote) {

                $displayPraise = $data[$type]['display_praise'] + 1;

                if ($vote == 'ed') {
                    $realPraise = $data[$type]['real_praise'] + 10;
                } else {
                    $realPraise = $data[$type]['real_praise'] + 1;
                }

                $voteValue = $data[$type][$vote] + 1;

                $record = array(
                    $type => array(
                        'id' => $id,
                        'display_praise' => $displayPraise,
                        'real_praise' => $realPraise,
                        $vote => $voteValue
                    ),
                    'Gamificationvote' => array(
                        'vote' => $vote,
                        'user_id' => $userId
                    )
                );

                return $this->saveAssociated($record);
            } else {
                // duplicate vote error message
                return false;
            }
        } else {
            //voting on own discussion/reply
            return false;
        }
    }

    /**
     * Retrieve Gamification information and engagers for a Discussion or Reply
     * @param $type (Discussion/Reply)
     * @param int $id
     * @param int $page
     * @return array
     */
    public function getGamificationInfo($type, $id, $page = 1) {
        $offset = $this->PAGINATION_LIMIT * ($page - 1);

        $params = array(
            'contain' => array(
                'Gamificationvote' => array(
                    'AppUser' => array(
                        'fields' => array(
                            'fname',
                            'lname'
                        )
                    )
                )
            ),
            'fields' => array(
                'id',
                'display_praise',
                'cu',
                'in',
                'co',
                'en',
                'ed'
            ),
            'conditions' => array(
                'id' => $id
            ),
            'offset' => $offset,
            'limit' => $this->PAGINATION_LIMIT
        );

        if ($type == 'Discussion') {
            $data = $this->Discussion->find('first', $params);
        } elseif ($type == 'Reply') {
            $data = $this->Reply->find('first', $params);
        }
        $data['Gamificationvote'] = $this->Discussion->convertGamificationVoteArray($data['Gamificationvote']);

        return $data;
    }
}
