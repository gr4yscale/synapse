<strong></strong><?php
class AttachmentTag extends AppModel {

	var $name = 'AttachmentTag';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasOne = array(
			'AttachmentTag' => array('className' => 'AttachmentTag',
								'foreignKey' => 'attachment_tag_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'AttachmentTag' => array('className' => 'AttachmentTag',
								'foreignKey' => 'attachment_tag_id',
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