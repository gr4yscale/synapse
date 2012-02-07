<?php
class VendorsController extends AppController {
	var $name = 'Vendors';
	var $uses = array('Vendors');
	var $helpers = array('Html', 'Form','Javascript');

	function index() {
		Configure::write('debug', '2');
	}
	
	function getVendors() {
	    Configure::write('debug', '0');
		$this->layout = "ajax";
		$vendorArray = array();
		
	   //	$vendorA = $this->Vendor->find('all', array('order'=>array('Vendor.id DESC', 'Vendor.vendor_name')));
	
	   	$vendorA = $this->Vendors->find('all', array(
	   			'fields' => array('Vendors.*'),
				'order'=>array('Vendors.vendor_name')
		));
	
		$vendorArray = Set::extract($vendorA, '{n}.Vendors');
		
		$this->set('vendors',$vendorArray);
	}	

}
?>