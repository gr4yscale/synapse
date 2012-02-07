<?php
class ProductGroup extends AppModel {

	var $name = 'ProductGroup';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Product' => array('className' => 'Product',
						'joinTable' => 'products_product_groups',
						'foreignKey' => 'product_group_id',
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
			)
	);

}
?>