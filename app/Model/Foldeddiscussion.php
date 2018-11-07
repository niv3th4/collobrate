<?php

App::uses('AppModel', 'Model');

/**
 * Foldeddiscussion Model
 *
 * @property User $User
 * @property Discussion $Discussion
 */
class Foldeddiscussion extends AppModel {

    /**
     * pagination limit for discussions and replies
     */
    const PAGINATION_LIMIT = 15;

    /**
     * max no. of replies to retrieve per discussion
     */
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
            'order' => ''
        )
    );

    public function getPaginatedFoldedDiscussions($roomId, $userId, $page = 1) {

        /**
         * SELECT *
         * FROM discussions AS d
         * INNER JOIN foldeddiscussions AS f ON d.id = f.discussion_id
         * WHERE f.user_id =1
         * AND d.classroom_id =1
         */
        $offset = self::PAGINATION_LIMIT * ($page - 1);

        $options['joins'] = array(
            array('table' => 'foldeddiscussions',
                'alias' => 'Foldeddiscussion',
                'type' => 'inner',
                'conditions' => array(
                    'Discussion.id = Foldeddiscussion.discussion_id'
                )
            ),
        );

        $options['conditions'] = array(
            'Discussion.classroom_id' => $roomId,
            'Foldeddiscussion.user_id' => $userId
        );

        $options['offset'] = $offset;
        $options['limit'] = self::PAGINATION_LIMIT;

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

        $options['contain'] = $contain;

        $data = $this->Discussion->find('all', $options);
        return $data;
    }
}
