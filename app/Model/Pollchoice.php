<?php

App::uses('AppModel', 'Model');

/**
 * Pollchoice Model
 *
 * @property Discussion $Discussion
 * @property Pollvote $Pollvote
 */
class Pollchoice extends AppModel {

    /**
     * belongsTo associations
     * @var array
     */
    public $belongsTo = array(
        'Discussion' => array(
            'className' => 'Discussion',
            'foreignKey' => 'discussion_id',
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
        'Pollvote' => array(
            'className' => 'Pollvote',
            'foreignKey' => 'pollchoice_id',
//            'dependent' => false,
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

    public function getDiscussionId($pollChoiceId) {
        $choice = $this->findById($pollChoiceId);
        return $choice['Pollchoice']['discussion_id'];
    }

    /**
     * given a discussion of type poll return
     * @param $discussionId
     * @return array
     */
    public function getPollChoiceList($discussionId) {
        $list = array();

        $list = $this->find('list', array(
            'contain' => array(
                'Discussion'
            ),
            'conditions' => array(
                'Discussion.id' => $discussionId
            )
        ));

        return $list;
    }

}
