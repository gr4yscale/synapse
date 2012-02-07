<?php
class ProductCategory extends AppModel {
	var $name = 'ProductCategory';
	var $actsAs = array('Tree');
	var $order = 'ProductCategory.lft ASC';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Product' => array('className' => 'Product',
						'joinTable' => 'products_product_categories',
						'foreignKey' => 'product_category_id',
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
	
	function populate(){
	    $this->create(array('name' => 'Categories'));
	    $this->save();

	        $parent_id = $this->id;
	        
			$this->create(array('parent_id' => $parent_id, 'category_name' => 'Categories'));
	        $this->save();

	        	$this->create(array('parent_id' => $this->id, 'category_name' => 'Tool Chests'));
	        	$this->save();

	            $this->create(array('parent_id' => $this->id, 'category_name' => 'Steel'));
	            $this->save();
	
	            $this->create(array('parent_id' => $this->id, 'category_name' => 'Aluminum'));
	            $this->save();

	        $this->create(array('parent_id' => $this->id, 'category_name' => 'Jacks'));
	        $this->save();

	        $this->create(array('parent_id' => $this->id, 'category_name' => 'Etc'));
	        $this->save();
	}
}

?>