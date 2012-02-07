<?php
class SpecsController extends AppController {

	var $name = 'Specs';
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Spec', 'Product', 'ProductsSpec');
	var $components = array('RequestHandler');

	function index() {
		$this->Spec->recursive = 0;
		$this->set('specs', $this->paginate());
	}
	
	
	function getSpecsForProduct() {
	    Configure::write('debug', '0');
		$this->layout = "ajax";
		$specArray = array();
		$psArray = array();
		$specpsArray = array();
		
		$product_id = $this->params['form']['product_id'];
		
		$this->Spec->bindModel(array('hasOne' => array('ProductsSpec')));
	   	$specA = $this->Spec->find('all', array(
	   			'fields' => array('ProductsSpec.id', 'ProductsSpec.spec_id', 'Spec.spec_name', 'ProductsSpec.spec_value', 'ProductsSpec.product_id'),
				'conditions'=>array('ProductsSpec.product_id'=>$product_id),
				'order'=>array('Spec.modified DESC', 'Spec.spec_name'),
		));
		
		
		
		$specArray = Set::extract($specA, '{n}.Spec');
		$psArray = Set::extract($specA, '{n}.ProductsSpec');
		$specpsArray = Set::merge($specArray, $psArray);
		
		$this->set('specs',$specpsArray);
	}


	function getSpecsSearch() {
	    Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$search = $this->params['form']['query'];
	
		$specArray = array();
	
	   	$specA = $this->Spec->find('all', array(
	   			'fields' => array('Spec.*'),
	   			'conditions'=>array('Spec.spec_name LIKE' => '%'.$search.'%'),
				'order'=>array('Spec.spec_name')
		));
		
		$specArray = Set::extract($specA, '{n}.Spec');
		$this->set('specs',$specArray); 
	}
	
	
	//Success on db update
	function update($id = null) {
		$this->layout = "ajax";
 		Configure::write('debug', '0');

		if (!$id && empty($this->data)) {
			$this->set('success', '{success:false}');
		}
		if (!empty($this->data)) {
			$this->Spec->id = $this->data['ProductsSpec']['spec_id'];
			$this->Spec->saveField('spec_name', $this->data['ProductsSpec']['spec_name']);  
		
			$this->ProductsSpec->id = $this->data['ProductsSpec']['id'];
			$this->ProductsSpec->saveField('spec_value', $this->data['ProductsSpec']['spec_value']);		

			$this->set('success', '{success:true}');
		}
		else {
			$this->set('success', '{success:false}');
		}
		
	}

	
	function add() {
		$this->layout = "ajax";
 		Configure::write('debug', '0');
 
		if (!empty($this->data)) {
			$this->data['Spec']['spec_name'] = $this->data['ProductsSpec']['spec_name'];
			$this->Spec->create();
			if ($this->Spec->save($this->data)) {
				$this->data['ProductsSpec']['spec_id'] = $this->Spec->id;

				if ($this->ProductsSpec->save($this->data)){
					$this->set('success', '{success:true}');	
				}	
			}
			else {$this->set('success', '{success:false}');
			}
		}
	}
	
	
	function delete($id = null) {
		$this->layout = "ajax";
 		Configure::write('debug', '0');

		if($this->RequestHandler->isAjax()) {
			if (!$id) {$this->set('success', '{success:false}');}
			
			$product_id = $this->params['form']['product_id'];
			
			if($this->ProductsSpec->deleteAll(array('ProductsSpec.spec_id' => $id, 'ProductsSpec.product_id' => $product_id))){
				$this->set('success', '{success:true}');
			}
			
		}
	}
}
?>