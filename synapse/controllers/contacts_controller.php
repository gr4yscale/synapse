<?php
class ContactsController extends AppController {
	var $name = 'Contacts';
	var $uses = array('Contacts', 'Attachment');
	var $helpers = array('Html', 'Form', 'Javascript');

	function index() {
		$this->Spec->recursive = 0;
		$this->set('specs', $this->paginate());
	}
	
	function getContactsForVendor() {
	    Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$vendor_id = $this->params['form']['vendor_id'];		
		$contactArray = array();
	
	   	$contactA = $this->Contacts->find('all', array(
	   			'fields' => array('Contacts.*'),
	   			'conditions'=>array('Contacts.vendor_id' => $vendor_id),
				'order'=>array('Contacts.last_name')
		));
		
		debug($contactA);
		
		$contactA = Set::extract($contactA, '{n}.Contacts');

		//Another shitty routine to join the first and last names since set::combine wouldn't work
		$i = 0;
		while($i < count($contactA)){
			$contactA[$i]['first_name'] = $contactA[$i]['first_name'] . " " . $contactA[$i]['last_name'];
			//echo $contactA[$i]['first_name'];
			$i++;
		}
	
		$this->set('contacts',$contactA); 		
	}
	
	
	function getContact($contact_id) {
	    Configure::write('debug', '0');
		$this->layout = "ajax";
			
		$contactArray = array();
	
		$this->Contacts->unbindModel(array('hasAndBelongsToMany'=>array('Attachment')));  
		
		$this->Contacts->bindModel(array(
			'hasOne' => array(
				'Attachment' => array(
					'className' => 'Attachment',
					'foreignKey' => false,
					'joinTable' => 'attachments_contacts',
					'conditions' => array('Contacts.thumb_attach_id = Attachment.id')
		))));		
	
	   	$contactArray = $this->Contacts->find('all', array(
	   			'fields' => array('Contacts.*', 'Attachment.location AS contact_thumblocation', 'Attachment.attachment_name AS contact_thumbsrc'),
	   			'conditions'=>array('Contacts.id' => $contact_id, 'Contacts.thumb_attach_id' == 'Attachment.id')
		));
		
		$contactA = Set::extract($contactArray, '{n}.Contacts');
		$attachA = Set::extract($contactArray, '{n}.Attachment');
		$joinedArray = Set::merge($contactA, $attachA);
				
		$this->set('contacts',$joinedArray);
	}	
	
	
	
	//Success on db update
	function update($id = null) {
		$this->layout = "ajax";
 		Configure::write('debug', '0');

		if (!empty($this->data)) {
			$this->Contacts->create();
			$this->Contacts->save($this->data);
			$contact_id = $this->Contacts->id;
			$this->set('success', '{success:true,contact_id:'.$contact_id.'}');
		}
		else {
			$this->set('success', '{success:false}');
		}		
	}
	
	
	
}
?>