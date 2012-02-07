<?php
class AttachmentFileType extends AppModel {

	var $name = 'AttachmentType';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasOne = array(
			'Attachment' => array('className' => 'Attachment',
								'foreignKey' => 'attachment_file_type_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Attachment' => array('className' => 'Attachment',
								'foreignKey' => 'attachment_file_type_id',
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
?>