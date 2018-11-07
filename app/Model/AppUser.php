<?php

/**
 */
App::uses('User', 'Users.Model');

class AppUser extends User {

    public $useTable = 'users';

    protected $authTokenExpirationTime = 14400;

    /**
     * belongsTo associations
     * @var array
     */
    public $belongsTo = array(
        'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'group_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Announcement' => array(
            'className' => 'Announcement',
            'foreignKey' => 'user_id',
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
        'Discussion' => array(
            'className' => 'Discussion',
            'foreignKey' => 'user_id',
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
        'Foldeddiscussion' => array(
            'className' => 'Foldeddiscussion',
            'foreignKey' => 'user_id',
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
        'Follow' => array(
            'className' => 'Follow',
            'foreignKey' => 'user_id',
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
            'foreignKey' => 'user_id',
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
        'Pollvote' => array(
            'className' => 'Pollvote',
            'foreignKey' => 'user_id',
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
            'foreignKey' => 'user_id',
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
        /**
         * HABTMs that are rightly hasMany:
         */
        'UsersCampus' => array(
            'className' => 'UsersCampus',
            'foreignKey' => 'user_id',
        ),
        'UsersClassroom' => array(
            'className' => 'UsersClassroom',
            'foreignKey' => 'user_id',
        ),
        'UsersAnnouncement' => array(
            'className' => 'UsersAnnouncement',
            'foreignKey' => 'user_id',
        ),
        'UsersSubmission' => array(
            'className' => 'UsersSubmission',
            'foreignKey' => 'user_id',
        ),
        /**
         * Already handled by plugin, perhaps:
         * 'UserDetail' => array(
         * 'className' => 'UserDetail',
         * 'foreignKey' => 'user_id',
         * 'dependent' => false,
         * 'conditions' => '',
         * 'fields' => '',
         * 'order' => '',
         * 'limit' => '',
         * 'offset' => '',
         * 'exclusive' => '',
         * 'finderQuery' => '',
         * 'counterQuery' => ''
         * )
         *
         */
        'Follower' => array(
            'classname' => 'Follow',
            'foreignKey' => 'user_id'
        ),
        'Followee' => array(
            'classname' => 'Follow',
            'foreignKey' => 'follows_id'
        )
    );

    public function getFullName($userId) {
        $options['contain'] = array();
        $options['fields'] = array('fname', 'lname');
        $options['conditions'] = array(
            'AppUser.id' => $userId
        );

//        $this->find('first' , $options);
        $data = $this->find('first', $options);
        $fullName = $data['AppUser']['fname'] . " " . $data['AppUser']['lname'];
        return $fullName;
    }

    public function authenticate($data) {
        $user = $this->find('first', array(
            'conditions' => array(
                'AppUser.email' => $data['AppUser']['email'],
                'AppUser.password' => $this->hash($data['AppUser']['password'], 'sha1', true)
            ),
        ));

        if (!empty($user)) {
            return $user;
        } else {
            return false;
        }
    }

    public function generateAuthToken() {
        return String::uuid();
    }

    public function deleteAuthToken($user) {
        $this->id = $user['id'];
        $data['AppUser']['auth_token'] = null;
        $data['AppUser']['auth_token_expires'] = null;
        if ($this->save($data, false)) {
            return true;
        } else {
            return false;
        }
    }

    public function authTokenExpirationTime() {
        return date('Y-m-d H:i:s', time() + $this->authTokenExpirationTime);
    }

    public function checkIdleTimeOut($user) {
        App::uses('CakeTime', 'Utility');
        if (CakeTime::wasWithinLast("4 hours", $user['last_action'])) {
            $this->updateLastActivity($user['id']);
            return false;
        } else {
            $this->deleteAuthToken($user);
            return true;
        }
    }

    /**
     * $userId1 follows/unfollows a $userId2
     */
    public function toggleFollow() {
        $this->loadModel("Follow");
        $this->Follow->toggleFollow();
//        $this->log("what");
    }
}
