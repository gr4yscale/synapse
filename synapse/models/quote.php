<?php
class Quote extends AppModel {

	var $name = 'Quote';
	var $belongsTo = 'Vendor';

	var $hasAndBelongsToMany = array(
			'Contact' => array('className' => 'Contact',
						'joinTable' => 'contacts_quotes',
						'foreignKey' => 'quote_id',
						'associationForeignKey' => 'quote_id',
						'with' => 'ContactQuotes',
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
			'Attachment' => array('className' => 'Attachment',
						'joinTable' => 'attachments_quotes',
						'foreignKey' => 'quote_id',
						'associationForeignKey' => 'attachment_id',
						'with' => 'AttachmentQuotes',
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