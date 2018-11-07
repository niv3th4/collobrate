<?php
/**
 * Created by PhpStorm.
 * User: nakul
 * Date: 6/24/14
 * Time: 12:21 AM
 */

App::uses('AppModel', 'Model');

class Message extends AppModel {

    public $belongsTo = array(
        'Sender' => array(
            'className' => 'AppUser',
            'foreignKey' => 'sender_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Recipient' => array(
            'className' => 'AppUser',
            'foreignKey' => 'recipient_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}