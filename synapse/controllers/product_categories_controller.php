<?php
class ProductCategoriesController extends AppController {
    var $name = 'ProductCategories';
    var $components = array('RequestHandler');
	var $uses = array('Product', 'ProductCategory', 'ProductsProductCategory');
    var $helpers = array('Form','Html','Javascript');


	function index() {
		
	}
	
	function getnodes(){
		Configure::write('debug', '0');
		$this->layout = "ajax";
	    $parent = intval($this->params['form']['node']);

	    $nodes = $this->ProductCategory->children($parent, true);
	    $this->set(compact('nodes'));
	}
	
	
	function getProductCats() {
	    Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$prodprodcatsArray = array();
		$prodcatArray = array();
		$joinedArray = array();
		
		$product_id = $this->params['form']['product_id'];
		
		$this->ProductCategory->bindModel(array('hasOne' => array('ProductsProductCategory')));
		
	   	$prodprodcatsA = $this->ProductCategory->find('all', array(
	   			'fields' => array('ProductsProductCategory.id', 'ProductsProductCategory.product_id', 'ProductsProductCategory.product_category_id', 'ProductCategory.category_name'),
				'conditions'=>array('ProductsProductCategory.product_id' => $product_id),
				'order'=>array('ProductCategory.category_name')
		));
		
		
		$prodprodcatsArray = Set::extract($prodprodcatsA, '{n}.ProductsProductCategory');
		$prodcatArray = Set::extract($prodprodcatsA, '{n}.ProductCategory');
		$joinedArray = Set::merge($prodprodcatsArray, $prodcatArray);
		
		$this->set('prodcats', $joinedArray);
	}
	
	
	function assignProductCategory() {
		Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$product_id = $this->params['form']['product_id'];
		$this->data['ProductsProductCategory']['product_id'] = $product_id;
 
		if (!empty($this->data)) {
			$this->ProductsProductCategory->create();
			if ($this->ProductsProductCategory->save($this->data)){
				$this->set('success', '{success:true}');	
			}	
			else {$this->set('success', '{success:false}');}
		}
	}	
	
	
	function unassignProductCategory() {
		$this->layout = "ajax";
 		Configure::write('debug', '0');

		$product_id = $this->params['form']['product_id'];
		
		if($this->ProductsProductCategory->deleteAll(
			array('ProductsProductCategory.product_id' => $product_id,
			'ProductsProductCategory.product_category_id' => $this->data['ProductsProductCategory']['product_category_id']
			))){
				$this->set('success', '{success:true}');
			}
	}
	

	function populate() {
        $this->ProductCategory->populate();

        echo 'Population complete';
        exit;
    }
 
	
}

?>