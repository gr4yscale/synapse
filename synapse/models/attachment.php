<?php
class Attachment extends AppModel {
	var $name = 'Attachment';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'AttachmentFileType' => array('className' => 'AttachmentFileType',
								'foreignKey' => 'attachment_file_type_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasAndBelongsToMany = array(
			'Product' => array('className' => 'Product',
						'joinTable' => 'attachments_products',
						'foreignKey' => 'attachment_id',
						'associationForeignKey' => 'product_id',
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
			'Quote' => array('className' => 'Quote',
						'joinTable' => 'attachments_quotes',
						'foreignKey' => 'attachment_id',
						'associationForeignKey' => 'quote_id',
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