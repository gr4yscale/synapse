<?php
class ProductTagsController extends AppController {
	var $name = 'ProductTags';
	var $components = array('RequestHandler');
	var $uses = array('Product', 'ProductTag', 'ProductsProductTag');
	var $helpers = array('Html', 'Form','Javascript');


	function index() {
		$this->ProductTag->recursive = 0;
		$this->set('productTags', $this->paginate());
	}

	function getProductTags() {
	    Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$prodprodtagsArray = array();
		$prodtagArray = array();
		$joinedArray = array();
		
		$product_id = $this->params['form']['product_id'];
		
		$this->ProductTag->bindModel(array('hasOne' => array('ProductsProductTag')));

	   	$prodprodtagsA = $this->ProductTag->find('all', array(
	   			'fields' => array('ProductsProductTag.id', 'ProductsProductTag.product_id', 'ProductsProductTag.product_tag_id', 'ProductTag.tag_name'),
				'conditions'=>array('ProductsProductTag.product_id' => $product_id),
				'order'=>array('ProductTag.tag_name')
		));
		
		
		$prodprodtagsArray = Set::extract($prodprodtagsA, '{n}.ProductsProductTag');
		$prodtagArray = Set::extract($prodprodtagsA, '{n}.ProductTag');
		$joinedArray = Set::merge($prodprodtagsArray, $prodtagArray);
		
		$this->set('prodtags', $joinedArray);
	}
	
	
	function getTagsSearch() {
	    Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$search = $this->params['form']['query'];
	
		$prodtagArray = array();
	
	   	$prodtagA = $this->ProductTag->find('all', array(
	   			'fields' => array('ProductTag.*'),
	   			'conditions'=>array('ProductTag.tag_name LIKE' => '%'.$search.'%'),
				'order'=>array('ProductTag.tag_name')
		));
		
		$prodtagArray = Set::extract($prodtagA, '{n}.ProductTag');
		$this->set('tags',$prodtagArray); 
	}
	


	function assignProductTag() {
		$this->layout = "ajax";
 		Configure::write('debug', '0');

		$product_id = $this->params['form']['product_id'];
 
		if (!empty($this->data)) {
			$this->ProductTag->create();
			if ($this->ProductTag->save($this->data)) {
				$this->data['ProductsProductTag']['product_id'] = $product_id;
				$this->data['ProductsProductTag']['product_tag_id'] = $this->ProductTag->id;

				if ($this->ProductsProductTag->save($this->data)){
					$this->set('success', '{success:true}');	
				}	
			}
			else {$this->set('success', '{success:false}');
			}
		}
	}

	
	
	function unassignProductTag() {
		$this->layout = "ajax";
 		Configure::write('debug', '0');

		$product_id = $this->params['form']['product_id'];
		
		if($this->ProductsProductTag->deleteAll(
			array('ProductsProductTag.product_id' => $product_id,
			'ProductsProductTag.product_tag_id' => $this->data['ProductsProductTag']['product_tag_id']
			))){
				$this->set('success', '{success:true}');
			}
	}


}
?>