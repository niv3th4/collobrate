<?php

App::uses('AppModel', 'Model');

/**
 * Discussion Model
 *
 * @property User $User
 * @property Foldeddiscussion $Foldeddiscussion
 * @property Pollchoice $Pollchoice
 * @property Reply $Reply
 * @property UsersPollchoice $UsersPollchoice
 */
class Discussion extends AppModel {

    /**
     * pagination limit for discussions and replies
     */
    const PAGINATION_LIMIT = 15;

    /**
     * max no. of replies to retrieve per discussion
     */
    const MAX_REPLIES = 5;

    /**
     * TODO : room wise, and filters
     * Common Authorization Framework:
     * Check if user is participant of room (classRoom | institutionRoom | staffRoom | groupRoom)
     * check if user is follower of myRoom's user
     * ENUM('cu','in','co','en','ed')
     */

    /**
     * db notes:
     * ON DELETE CASCADE set for all related Discussion models except Classroom
     */

    public $actsAs = array(
        'Utility.Enumerable',
        'Containable'
    );

    /**
     * belongsTo associations
     * @var array
     */
    public $belongsTo = array(
        'Classroom' => array(
            'className' => 'Classroom',
            'foreignKey' => 'classroom_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'AppUser' => array(
            'className' => 'AppUser',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     * @var array
     */
    public $hasMany = array(
        'Foldeddiscussion' => array(
            'className' => 'Foldeddiscussion',
            'foreignKey' => 'discussion_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Gamificationvote' => array(
            'className' => 'Gamificationvote',
            'foreignKey' => 'discussion_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Pollchoice' => array(
            'className' => 'Pollchoice',
            'foreignKey' => 'discussion_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Reply' => array(
            'className' => 'Reply',
            'foreignKey' => 'discussion_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    /**
     * Get single discussion by id
     * @param int $discussion_id
     * @return array
     */
    public function getDiscussionById($discussion_id) {

        $contain = array(
            'Reply' => array(
                'Gamificationvote' => array(
                    'AppUser' => array(
                        'fields' => array(
                            'fname',
                            'lname'
                        )
                    )
                ),
                'AppUser' => array(
                    'fields' => array(
                        'fname',
                        'lname'
                    )
                ),
                'limit' => self::MAX_REPLIES,
                'order' => array(
                    'created' => 'desc'
                )
            ),
            'Pollchoice' => array(
                'Pollvote'
            ),
            'Gamificationvote' => array(
                'AppUser' => array(
                    'fields' => array(
                        'fname',
                        'lname'
                    )
                )
            ),
            'AppUser' => array(
                'fields' => array('fname', 'lname')
            ),
            'Foldeddiscussion'
        );

        $discussion = $this->find('all', array(
            'conditions' => array('Discussion.id' => $discussion_id),
            'contain' => $contain
        ));
        return $discussion;
    }

    /**
     * show gamification vote info only to owners or people who have voted.
     * show poll vote info only to owners or people who have voted.
     * mark folded Discussions of $userId
     * Keep FoldedDiscussion key when not null
     * @param $data (all discussions)
     * @param $userId (loggedIn user's id)
     * @return mixed
     */
    public function processData($data, $userId) {
        for ($i = 0; $i < count($data); $i++) {
            // Remove gamification information if required
            $data[$i]['Discussion'] = $this->setShowGamification('Discussion', $data[$i]['Discussion'], $userId);
            // Converting Gamification information to friendly form
            $data[$i]['Gamificationvote'] = $this->convertGamificationVoteArray($data[$i]['Gamificationvote']);

            // Decide to show votes of a poll
            if ($data[$i]['Discussion']['type'] == 'poll') {
                $data[$i]['Discussion'] = $this->_setShowPollVote($data[$i]['Discussion'], $userId);
            }

            // Remove Key if not folded by current user
            $data[$i] = $this->_setIsFolded($data[$i]);

            // Removing Gamification information for Reply
            for ($j = 0; $j < count($data[$i]['Reply']); $j++) {
                $data[$i]['Reply'][$j] = $this->setShowGamification('Reply', $data[$i]['Reply'][$j], $userId);
                //Converting Gamification information to friendly form
                $data[$i]['Reply'][$j]['Gamificationvote'] = $this->convertGamificationVoteArray($data[$i]['Reply'][$j]['Gamificationvote']);
            }
//            $data[$i]['moreReplies'] = $this->Reply->_setMoreRepliesFlag(1, $data[$i]['Discussion']['id']);
        }
        return $data;
    }

    /**
     * Takes a discussion or reply, removing the gamification votes if required
     * and setting required flag (showGamification)
     * @param $type String 'Discussion' or 'Reply'
     * @param $data mixed Discussion or Reply array
     * @param $userId int
     * @return mixed
     */
    public function setShowGamification($type, $data, $userId) {
        unset($data['real_praise']);
        $hasVoted = $this->Gamificationvote->hasVoted($type, $data['id'], $userId);
        $isOwner = ($data['user_id'] == $userId);
        if ($hasVoted || $isOwner) {
            $data['showGamification'] = true;
        } else {
            $data['showGamification'] = false;
            unset($data['cu']);
            unset($data['in']);
            unset($data['co']);
            unset($data['en']);
            unset($data['ed']);
        }
        return $data;
    }


    /**
     * takes a Discussion of type 'Poll', determines to show/remove info
     * of votes of the Poll.
     * sets flag 'showPollVote'
     * @param $discussion
     * @param $userId
     * @return mixed
     */
    private function _setShowPollVote($discussion, $userId) {
        $isOwner = ($discussion['user_id'] == $userId);
        $hasVotedOnPoll = $this->Pollchoice->Pollvote->hasVotedOnPoll($discussion['id'], $userId);
        if ($isOwner || $hasVotedOnPoll) {
            $discussion['showPollVote'] = true;
        } else {
            $discussion['showPollVote'] = false;
        }
        return $discussion;
    }

    /**
     * @param $discussion
     * @return mixed
     */
    private function _setIsFolded($discussion) {
        if ($discussion['Foldeddiscussion'] == NULL) {
            $discussion['Discussion']['isFolded'] = false;
        } else {
            $discussion['Discussion']['isFolded'] = true;
        }
        unset($discussion['Foldeddiscussion']);
        return $discussion;
    }

    /**
     * Given the $data['GamificationVote'] array, converts it to a grouped form
     * for the front end
     * @param array $gamificationVote $data['GamificationVote']
     * @return array assign to $data['GamificationVote']
     */
    public function convertGamificationVoteArray($gamificationVote = array()) {

        $data['en'] = array();
        $data['in'] = array();
        $data['cu'] = array();
        $data['co'] = array();
        $data['ed'] = array();

        for ($k = 0; $k < count($gamificationVote); $k++) {
            $vote = $gamificationVote[$k]['vote'];
            $name = $gamificationVote[$k]['AppUser']['fname'] . ' ' . $gamificationVote[$k]['AppUser']['lname'];

            switch ($vote) {
                case 'en':
                    array_push($data['en'], $name);
                    break;
                case 'in':
                    array_push($data['in'], $name);
                    break;
                case 'cu':
                    array_push($data['cu'], $name);
                    break;
                case 'co':
                    array_push($data['co'], $name);
                    break;
                case 'ed':
                    array_push($data['ed'], $name);
                    break;
            }
        }
        return $data;
    }

    /**
     * Return Discussions of a room, paginated
     * @param int $roomId - room id(pk)
     * @param int $userId - user id for context information (discussion folded or not)
     * @param int $page - page number to retrieve
     * @param bool $onlylatest - if true, then returns only latest discussion
     * @return array
     */
    public function getPaginatedDiscussions($roomId, $userId, $page, $onlylatest = false) {
        $offset = self::PAGINATION_LIMIT * ($page - 1);

        $contain = array(
            'Reply' => array(
                'Gamificationvote' => array(
                    'AppUser' => array(
                        'fields' => array(
                            'fname',
                            'lname'
                        )
                    )
                ),
                'AppUser' => array(
                    'fields' => array(
                        'fname',
                        'lname'
                    )
                ),
                'limit' => self::MAX_REPLIES,
                'order' => array(
                    'created' => 'desc'
                )
            ),
            'Pollchoice' => array(
                'Pollvote'
            ),
            'Gamificationvote' => array(
                'AppUser' => array(
                    'fields' => array(
                        'fname',
                        'lname'
                    )
                )
            ),
            'AppUser' => array(
                'fields' => array('fname', 'lname')
            ),
            'Foldeddiscussion' => array(
                'conditions' => array(
                    'user_id' => $userId
                )
            )
        );

        $options = array(
            'contain' => $contain,
            'conditions' => array(
                'classroom_id' => $roomId
            ),
            'order' => array(
                'created' => 'desc'
            ),
            'limit' => self::PAGINATION_LIMIT,
            'offset' => $offset
        );

        if ($onlylatest) {
            $options['limit'] = 1;
            unset($options['offset']);
        }

        $data = $this->find('all', $options);
        return $data;
    }

    /**
     * Delete discussion by id by owner
     * @param int $discussionId
     * @param int $userId
     * @return bool
     */
    public function deleteDiscussion($discussionId, $userId) {
        //Ensure ON DELETE CASCADE in Discussion table
        $discussion = $this->findById($discussionId);
        /**
         * TODO: move this logic to authorization layer
         */
        if (($discussion != null) && $discussion['Discussion']['user_id'] == $userId) {
            return $this->delete($discussionId);
        } else {
            return false;
        }
    }

    /**
     * Toggle fold on discussion
     * @param $discussionId
     * @param $userId
     * @return bool
     */
    public function toggleFold($discussionId, $userId) {

        if (!$this->findById($discussionId)) {
            return false;
        }

        $conditions = array(
            'user_id' => $userId,
            'discussion_id' => $discussionId
        );

        //cool model style notation such as AppUser.id not working
        $data = array(
            'user_id' => $userId,
            'discussion_id' => $discussionId
        );

        if ($this->Foldeddiscussion->hasAny($conditions)) {
            $foldeddiscussion = $this->Foldeddiscussion->find('first', array(
                'conditions' => $conditions,
                'recursive' => -1
            ));

            $id = $foldeddiscussion['Foldeddiscussion']['id'];
            return $this->Foldeddiscussion->delete($id);
        } else {
            $this->Foldeddiscussion->create();
            return $this->Foldeddiscussion->save($data);
        }
    }

    /**
     * permission for allowing "Create" privilege for discussions
     * @param $classroomId
     * @param $userId
     * @return bool
     */
    public function allowCreate($classroomId, $userId) {
        return true;
    }
}
