<?php
class Product extends AppModel {
	var $name = 'Product';
	var $actsAs = array('Tree');
	var $order = 'Product.product_name ASC';
		
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Attachment' => array('className' => 'Attachment',
						'joinTable' => 'attachments_products',
						'foreignKey' => 'product_id',
						'associationForeignKey' => 'attachment_id',
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
			'ProductCategory' => array('className' => 'ProductCategory',
						'joinTable' => 'products_product_categories',
						'foreignKey' => 'product_id',
						'associationForeignKey' => 'product_category_id',
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
			'ProductGroup' => array('className' => 'ProductGroup',
						'joinTable' => 'products_product_groups',
						'foreignKey' => 'product_id',
						'associationForeignKey' => 'product_group_id',
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
			'ProductTag' => array('className' => 'ProductTag',
						'joinTable' => 'products_product_tags',
						'foreignKey' => 'product_id',
						'associationForeignKey' => 'product_tag_id',
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
			'Spec' => array('className' => 'Spec',
						'joinTable' => 'products_specs',
						'foreignKey' => 'product_id',
						'associationForeignKey' => 'spec_id',
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
			'Vendor' => array('className' => 'Vendor',
						'joinTable' => 'products_vendors',
						'foreignKey' => 'product_id',
						'associationForeignKey' => 'vendor_id',
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