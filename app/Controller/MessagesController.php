<?php
/**
 * Created by PhpStorm.
 * User: nakul
 * Date: 6/24/14
 * Time: 12:23 AM
 */

class MessagesController extends AppController{

    public function index(){

        $params = array(
            'conditions' => array(
                'OR' => array(
                    'sender_id' => 1,
                    'recipient_id' => 1
                )
            )
        );

        $data = $this->Message->find('all',$params);
        debug($data);
        die();
    }
} 