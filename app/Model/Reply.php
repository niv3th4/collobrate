<?php

App::uses('AppModel', 'Model');

/**
 * Reply Model
 *
 * @property User $User
 * @property Discussion $Discussion
 * @property Gamificationvote $Gamificationvote
 */
class Reply extends AppModel {

    const MAX_REPLIES = 5;

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
            'order' => '',
            'counterCache' => true
        )
    );

    /**
     * hasMany associations
     * @var array
     */
    public $hasMany = array(
        'Gamificationvote' => array(
            'className' => 'Gamificationvote',
            'foreignKey' => 'reply_id',
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
     * Post a reply for a given discussion
     * @param $discussionId
     * @param $comment
     * @param $userId
     * @return mixed
     */
    public function postReply($discussionId, $comment, $userId) {
//        not working:
//        $data = array(
//            'AppUser' => array(
//                'id' => $userId
//            ),
//            'Discussion' => array(
//                'id' => $discussionId
//            ),
//            'Reply' => array(
//                'comment' => $comment
//            )
//        );
        $data = array(
            'user_id' => $userId,
            'discussion_id' => $discussionId,
            'comment' => $comment
        );

//        return $this->saveAssociated($data);
        return $this->save($data);

    }

    /**
     * Delete a given reply by Id
     * @param $replyId
     * @param $userId
     * @return bool
     */
    public function deleteReply($replyId, $userId) {
        $reply = $this->findById($replyId);

        if ($reply) {
            if ($reply['Reply']['user_id'] == $userId) {
                return $this->delete($replyId);
            }
        } else {
            return false;
        }
    }

    /**
     * Post-processing of reply data for use in the front end
     * @param $data
     * @param $userId
     * @return mixed
     */
    public function processReplies($data, $userId) {
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['Reply'] = $this->Discussion->setShowGamification('Reply', $data[$i]['Reply'], $userId);
            $data[$i]['Gamificationvote'] = $this->Discussion->convertGamificationVoteArray($data[$i]['Gamificationvote']);
        }
        return $data;
    }

    /**
     * Indicator if more replies are present
     * to be used for lazy loaded pagination of replies for a given discussion
     * @param $page
     * @param $discussionId
     * @return bool
     */
    public function setMoreRepliesFlag($page, $discussionId) {
        $params = array(
            'conditions' => array(
                'discussion_id' => $discussionId
            )
        );

        $count = count($this->find('all', $params));
        $left = $count - ($page * 5);

        if ($left > 0) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Return Replies of a discussion, paginated
     * @param $discussionId
     * @param $page
     * @param bool $onlylatest
     * @return array
     */
    public function getPaginatedReplies($discussionId, $page, $onlylatest = false) {

        $offset = self::MAX_REPLIES * ($page - 1);

        $contain = array(
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
        );

        $options = array(
            'contain' => $contain,
            'conditions' => array(
                'discussion_id' => $discussionId
            ),
            'order' => array(
                'created' => 'desc'
            ),
            'offset' => $offset,
            'limit' => self::MAX_REPLIES,
        );

        if ($onlylatest) {
            $options['limit'] = 1;
            unset($options['offset']);
        }

        $data = $this->find('all', $options);
        return $data;
    }
}
