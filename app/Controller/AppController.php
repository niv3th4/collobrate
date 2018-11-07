<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package        app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Auth' => array(
            'authorize' => array('Controller'),
            'autoRedirect' => false
            /*'loginAction' => array(
                'controller' => 'app_users',
                'action' => 'login',
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => array('display', 'feedback')
            )*/
        ),
        'Session',
        'RequestHandler',
        'DebugKit.Toolbar'
    );
    public $helpers = array(
        'Js' => array('Jquery')
    );

    public function beforeFilter() {
        parent::beforeFilter();
        AuthComponent::$sessionKey = false;
        $this->Auth->unauthorizedRedirect = false;
        $this->Auth->authenticate = array(
            'Authenticate.Token' => array(
                'parameter' => '_token',
                'header' => 'X-AuthTokenHeader',
                'userModel' => 'AppUser',
                /*'scope' => array('User.active' => 1),*/
                'fields' => array(
                    'email' => 'email',
                    'password' => 'password',
                    'token' => 'auth_token',
                ),
                'continue' => false,
                'unauthorized' => 'ForbiddenException'
            )
        );

        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
        $this->response->header('Access-Control-Allow-Headers', 'X-AuthTokenHeader, X-Auth-Token,Authorization,Content-Type,Accept,Origin,User-Agent,DNT,Cache-Control,X-Mx-ReqToken,Keep-Alive,X-Requested-With,If-Modified-Since');
        //$this->response->header('Access-Control-Allow-Headers', 'Content-Type,x-xsrf-token');
    }

    public function isAuthorized($user) {
        $this->loadModel('AppUser');
        if ($user) {
            // return !$this->AppUser->checkIdleTimeout($user);
            return true;
        } else {
            return false;
        }
    }
}
