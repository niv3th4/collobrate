<?php

App::uses('AppModel', 'Model');

/**
 * Class Follow
 */
class Follow extends AppModel {

    public $belongsTo = array(
        'Follower' => array(
            'className' => 'AppUser',
            'foreignKey' => 'user_id'
        ),
        'Followee' => array(
            'className' => 'AppUser',
            'foreignKey' => 'follows_id'
        )
    );

    /**
     * $userId1 follows/unfollows $userId2
     * @param $userId1
     * @param $userId2
     */
    public function toggleFollow($userId1, $userId2) {
        $response = array();
        $conditions = array(
            'user_id' => $userId1,
            'follows_id' => $userId2
        );

        $data = $this->find('first', array(
            'conditions' => $conditions
        ));

        if (empty($data)) {
            $response['status'] = !empty($this->save($conditions));
            if ($response['status']) {
                $response['message'] = "Successfully followed the user";
            } else {
                $response['message'] = "Failed to follow the user";
            }
        } else {
            $this->delete($data['Follow']['id']);
            $response['status'] = true;
            $response['message'] = "Successfully unfollowed the user";
        }
        return $response;
    }

}