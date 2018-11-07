<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Parse Extensions
 */
Router::parseExtensions('json');

/**
 */
Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
Router::connect('/feedback', array('controller' => 'pages', 'action' => 'display', 'feedback'));
Router::connect('/test', array('controller' => 'classrooms', 'action' => 'test'));
//-------------------------Inside classroom---------------------------------------------------------------------
Router::connect(
        '/Classrooms/:id/:action', array('controller' => 'classrooms'), array(
    'pass' => array('id'),
    'id' => '[0-9]+'
        )
);
Router::connect(
        '/Classrooms/:id/:controller/:action', array('action' => 'index'), array(
    'pass' => array('id'),
    'id' => '[0-9]+'
        )
);

//--------------------------------------------------------------------------------------------------------------
Router::connect('/Announcements/add', array('controller' => 'announcements', 'action' => 'add'));
Router::connect('/Classrooms/test', array('controller' => 'classrooms', 'action' => 'testmenow'));
Router::connect('/Classrooms/add', array('controller' => 'classrooms', 'action' => 'add'));
Router::connect('/Classrooms', array('controller' => 'classrooms', 'action' => 'index'));
Router::connect('/register', array('controller' => 'AppUsers', 'action' => 'add'));
//--------------------------------------------------------------------------------------------------------------
Router::connect(
        '/Classrooms/:action', array('controller' => 'classrooms'));
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
//Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
//CakePlugin::routes();

/**
 * @overriding CakeDc Routes
 */
Router::connect('/login/*', array('controller' => 'app_users', 'action' => 'login'));
Router::connect('/logout/*', array('controller' => 'app_users', 'action' => 'logout'));
Router::connect('/users', array('controller' => 'app_users'));
Router::connect('/users/index/*', array('controller' => 'app_users'));
Router::connect('/users/users/:action/*', array('controller' => 'app_users'));
Router::connect('/users/:action/*', array('controller' => 'app_users'));
Router::connect('/register/*', array('controller' => 'app_users', 'action' => 'add'));

/**
 * CakeDc Routes - Manually
 */
//Router::connect('/users', array('plugin' => 'users', 'controller' => 'users'));
//Router::connect('/users/index/*', array('plugin' => 'users', 'controller' => 'users'));
//Router::connect('/users/:action/*', array('plugin' => 'users', 'controller' => 'users'));
//Router::connect('/users/users/:action/*', array('plugin' => 'users', 'controller' => 'users'));
//Router::connect('/login/*', array('plugin' => 'users', 'controller' => 'users', 'action' => 'login'));
//Router::connect('/logout/*', array('plugin' => 'users', 'controller' => 'users', 'action' => 'logout'));
//Router::connect('/register/*', array('plugin' => 'users', 'controller' => 'users', 'action' => 'add'));

/**
 * Classrooms
 */
//Router::connect('/Classrooms/*', array('controller' => 'classrooms'));
/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */

Router::connect(
    '/Classrooms/:controller/:action', array(), array()
);

require CAKE . 'Config' . DS . 'routes.php';

