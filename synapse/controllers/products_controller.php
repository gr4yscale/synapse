<?php
class ProductsController extends AppController {
	var $name = 'Products';
    var $components = array('RequestHandler');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Product', 'AttachmentsProduct', 'Attachment', 'ProductsProductCategory', 'ProductCategory');
	
	
	function index() {
		Configure::write('debug', '2');
	}
	
	function getProductSearch() {
	    Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$prodArray = array();
		$attachArray = array();
		$joinedArray = array();
		
		$searchterms = $this->params['form']['searchterms'];
	
		$this->Product->unbindModel(array('hasAndBelongsToMany'=>array('Attachment')));  
		
		$this->Product->bindModel(array(
			'hasOne' => array(
				'Attachment' => array(
					'className' => 'Attachment',
					'foreignKey' => false,
					'joinTable' => 'attachments_products',
					'conditions' => array('Product.prodimg_attach_id = Attachment.id')
		))));

	   	$prodA = $this->Product->find('all', array(
   			'fields' => array('Product.id', 'Product.item_no', 'Product.vendor_item_no', 'Product.product_name', 'Product.cost', 
							  'Product.parent_id', 'Product.leaf', 'Product.prodimg_attach_id', 'Attachment.location AS prod_thumblocation', 'Attachment.attachment_name AS prod_thumbsrc'),	
   			'conditions'=>array('Product.product_name LIKE' => '%'.$searchterms.'%', 'Product.prodimg_attach_id' == 'Attachment.id'),
			'order'=>array('Product.id DESC')		
		));
		$count = $this->Product->find('count', array('conditions'=>array('Product.product_name LIKE' => '%'.$searchterms.'%')));

		$this->set('total', $count);
		$this->set('success', 'true');

		$prodArray = Set::extract($prodA, '{n}.Product');
		$attachArray = Set::extract($prodA, '{n}.Attachment');
		$joinedArray = Set::merge($prodArray, $attachArray);
		
		$this->set('products',$joinedArray);
	}
	
	
	
	
	function getProductsByCategory() {
	    Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$prodArray = array();
		$attachArray = array();
		$joinedArray = array();
		
		$cat_id = $this->params['form']['searchcat_id'];
	
		$this->Product->unbindModel(array('hasAndBelongsToMany'=>array('Attachment')));  
		
		$this->Product->bindModel(array(
			'hasOne' => array(
				'Attachment' => array(
					'className' => 'Attachment',
					'foreignKey' => false,
					'joinTable' => 'attachments_products',
					'conditions' => array('Product.prodimg_attach_id = Attachment.id')
		))));
	
		$this->Product->bindModel(array('hasOne' => array('ProductsProductCategory')));
		
		$prodA = $this->Product->find('all', array(
   			'fields' => array('Product.id', 'Product.item_no', 'Product.vendor_item_no', 'Product.product_name', 'Product.cost', 
							  'Product.parent_id', 'Product.leaf', 'Product.prodimg_attach_id','ProductsProductCategory.id',
							  'Attachment.location AS prod_thumblocation', 'Attachment.attachment_name AS prod_thumbsrc'),
			'conditions'=>array('ProductsProductCategory.product_category_id' => $cat_id),
			'order'=>array('Product.id DESC')		
		));
		
		$this->Product->bindModel(array('hasOne' => array('ProductsProductCategory')));
		$count = $this->Product->find('count', array('conditions'=>array('ProductsProductCategory.product_category_id' => $cat_id)));

		$this->set('total', $count);
		$this->set('success', 'true');

		$prodArray = Set::extract($prodA, '{n}.Product');
		$attachArray = Set::extract($prodA, '{n}.Attachment');
		$joinedArray = Set::merge($prodArray, $attachArray);
		
		$this->set('products',$joinedArray);
	}	
	
	
	function createGroup(){
		Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$group_name = $this->params['form']['group_name'];
		$selectedProds = $this->params['form']['selectedProds'];
		
	//	echo $group_name;
	//	debug($selectedProds);
	//	echo $_POST['selectedProds'][0]['product_name'];
	//	debug($selectedProds[0]['product_name']);
	
	
		$this->Product->create();
		$this->data['Product']['product_name'] = $group_name;
		$this->data['Product']['leaf'] = 0;
		$this->Product->save($this->data);
		$parent_id = $this->Product->id;
		
		foreach($selectedProds as $key => $prod_id ) {
			$this->Product->id = $prod_id;
			$this->Product->saveField('parent_id', $parent_id);
		}
		
		
		$this->set('success', 'true');
	}
	
	
	
	function getProductNodes(){
		Configure::write('debug', '0');
		$this->layout = "ajax";
		$node_id = null;
		$success = 0;
		
	  //  $limit = intval($this->params['form']['limit']);
	 //   $start = intval($this->params['form']['start']);

	    if(isset($_REQUEST['anode'])) {
			$node_id = intval($this->params['form']['anode']);
		    $nodes = $this->Product->children($node_id, true);
		
			$success = 1;
		}
		else {
			$nodes = $this->Product->children(0, true);
			$nodes = $this->Product->find('all', $findParams);
			
			$success = 1;
		}
		$this->set('total', 20); //check here
		
		if($success==1)
			$this->set('success', 'true');
		else
			$this->set('success', 'false');
		
		$this->set(compact('nodes'));

	}
		
	
	function getPrimaryThumbnail() {
		Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$prodArray = array();
		$product_id = $this->params['form']['product_id'];	
		$prodArray = $this->Product->find('first', array('fields'=>array('Product.prodimg_attach_id'), 'conditions'=>array('Product.id' => $product_id)));
		echo $prodArray['Product']['prodimg_attach_id'];
	}
	
	function addNewProduct() {
	    Configure::write('debug', '0');
		$this->layout = "ajax";

		if (!empty($this->data)) {
			$this->Product->create();
			if ($this->Product->save($this->data)) {
				$product_id = $this->Product->id;
				$this->Session->write('Product.id', '$product_id');
				$this->set('success', '{success:true,product_id:'.$product_id.'}'); 
			} else {
				$this->set('success', '{success:false}');
			}
		}
		
		
	   
	}
}
?>
