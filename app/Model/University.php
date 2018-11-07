<?php

App::uses('AppModel', 'Model');

/**
 * University Model
 * @property Campus $Campus
 */
class University extends AppModel {

    /**
     * hasMany associations
     * @var array
     */
    public $hasMany = array(
        'Campus' => array(
            'className' => 'Campus',
            'foreignKey' => 'university_id',
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

}
