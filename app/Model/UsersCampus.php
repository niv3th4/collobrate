<?php

App::uses('AppModel', 'Model');

/**
 * UsersCampus Model
 * @property User $User
 * @property Campus $Campus
 * @property Department $Department
 * @property Degree $Degree
 */
class UsersCampus extends AppModel {

    /**
     * db Notes:
     * campus -> department -> degree
     * ideally only 1 of these keys should be populated,
     * although more than 1 can be populated to take advantage of all keys
     * being present.
     *
     * User (student) can belong to a degree
     * User (educator) can belong to a department and not specific degree
     * User may belong to a campus, no association with department/degree
     */

    /**
     * belongsTo associations
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Campus' => array(
            'className' => 'Campus',
            'foreignKey' => 'campus_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Department' => array(
            'className' => 'Department',
            'foreignKey' => 'department_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Degree' => array(
            'className' => 'Degree',
            'foreignKey' => 'degree_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * check if give $userId is an educator in atleast 1 campus association
     * @param $userId
     * @return boolean
     */
    public function isEducator($userId) {
        //sanity check
        if (!$userId) {
            return false;
        }

        $conditions = array(
            'user_id' => $userId,
            'role' => 'educator'
        );

        /**
         * should use hasAny?
         * whats the point, internally it does a find count!
         */
        if ($this->find('count', array('conditions' => $conditions, 'recursive' => -1)) > 0) {
            return true;
        } else {
            return false;
        }
    }

}
