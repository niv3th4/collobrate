<?php

/**
 */
App::uses('UsersController', 'Users.Controller');

class AppUsersController extends UsersController {

    public $name = 'AppUsers';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->authorize = array('Controller');
        $this->Security->unlockedActions = array('login', 'logout');
        $this->User = ClassRegistry::init('AppUser');
        $this->set('model', 'AppUser');
        $this->Auth->allow('login', 'add', 'reset_password');


        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
        $this->response->header('Access-Control-Allow-Headers', 'X-AuthTokenHeader,X-Auth-Token,Authorization,Content-Type,Accept,Origin,User-Agent,DNT,Cache-Control,X-Mx-ReqToken,Keep-Alive,X-Requested-With,If-Modified-Since');

    }

    protected function _setupAuth() {
        //parent::_setupAuth();
        /*        $this->Auth->loginAction = array(
                    'plugin' => null,
                    'admin' => false,
                    'controller' => 'app_users',
                    'action' => 'login'
                );*/
        /*        $this->Auth->loginRedirect = array(
                    'plugin' => null,
                    'admin' => false,
                    'controller' => 'classrooms',
                    'action' => 'index'
                );*/
        $this->Auth->logoutRedirect = array(
            'plugin' => null,
            'admin' => false,
            'controller' => 'pages',
            'action' => array('display', 'feedback')
        );

        $this->Auth->authorize = array(
            'Actions' => array('actionPath' => 'controllers')
        );
    }

    public function login() {

        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('json');

        $data = array();
        $status = false;

        if ($this->request->is('post')) {
            $user = $this->AppUser->authenticate($this->request->data);
            if ($user) {
                $token = $this->AppUser->generateAuthToken();
                $this->AppUser->id = $user['AppUser']['id'];
                $saveData['AppUser']['auth_token'] = $token;
                $saveData['AppUser']['auth_token_expires'] = $this->AppUser->authTokenExpirationTime();

                if ($this->AppUser->save($saveData, false)) {
                    $this->AppUser->updateLastActivity($user['AppUser']['id']);
                    $status = true;
                    $data['auth_token'] = $token;
                    $message = "Login successful";
                }
            } else {
                $message = "Login unsuccessful";
            }
        }

        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

    public function logout() {
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('json');

        $data = array();
        $status = false;

        if ($this->request->is('post')) {
            $status = $this->AppUser->deleteAuthToken(AuthComponent::User());
            $this->Session->destroy();

            if ($status) {
                $message = "Logout successful.";
            } else {
                $message = "Logout unsuccessful.";
            }
        }

        $this->set(compact('status', 'message'));
        $this->set('data', $data);
        $this->set('_serialize', array('data', 'status', 'message'));
    }

    public function isAuthorized($user = null) {
        if ($user) {
            return true;
        } else {
            return false;
        }
    }
}
