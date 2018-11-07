<?php
App::uses('AppModel', 'Model');
/**
 * Columnsanswer Model
 *
 * @property Column1 $Column1
 * @property Column2 $Column2
 */
class Columnsanswer extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'column1_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'column2_id' => array(
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
		'Column1' => array(
			'className' => 'Column1',
			'foreignKey' => 'column1_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Column2' => array(
			'className' => 'Column2',
			'foreignKey' => 'column2_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
