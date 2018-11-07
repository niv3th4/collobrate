<?php
App::uses('AppModel', 'Model');
/**
 * Matchthecolumn Model
 *
 * @property Quizquestion $Quizquestion
 * @property Column $Column
 */
class Matchthecolumn extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'quizquestion_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Quizquestion' => array(
			'className' => 'Quizquestion',
			'foreignKey' => 'quizquestion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Column' => array(
			'className' => 'Column',
			'foreignKey' => 'matchthecolumn_id',
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
