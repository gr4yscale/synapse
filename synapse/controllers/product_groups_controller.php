<?php
class ProductGroupsController extends AppController {

	var $name = 'ProductGroups';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->ProductGroup->recursive = 0;
		$this->set('productGroups', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ProductGroup.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('productGroup', $this->ProductGroup->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ProductGroup->create();
			if ($this->ProductGroup->save($this->data)) {
				$this->Session->setFlash(__('The ProductGroup has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The ProductGroup could not be saved. Please, try again.', true));
			}
		}
		$products = $this->ProductGroup->Product->find('list');
		$this->set(compact('products'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ProductGroup', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProductGroup->save($this->data)) {
				$this->Session->setFlash(__('The ProductGroup has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The ProductGroup could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProductGroup->read(null, $id);
		}
		$products = $this->ProductGroup->Product->find('list');
		$this->set(compact('products'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ProductGroup', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProductGroup->del($id)) {
			$this->Session->setFlash(__('ProductGroup deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>