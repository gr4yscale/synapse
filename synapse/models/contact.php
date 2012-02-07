<?php
class Contact extends AppModel {

	var $name = 'Contact';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Vendor' => array('className' => 'Vendor',
								'foreignKey' => 'vendor_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasAndBelongsToMany = array(
			'Attachment' => array('className' => 'Attachment',
						'joinTable' => 'attachments_contacts',
						'foreignKey' => 'contact_id',
						'associationForeignKey' => 'contact_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			),
			'User' => array('className' => 'User',
						'joinTable' => 'contacts_users',
						'foreignKey' => 'contact_id',
						'associationForeignKey' => 'user_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			)
	);
	
}
?>