<?php

App::uses('AppModel', 'Model');

/**
 * Link Model
 *
 * @property Topic $Topic
 */
class Link extends AppModel {

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Topic' => array(
            'className' => 'Topic',
            'foreignKey' => 'topic_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
