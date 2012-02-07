<?php
class QuotesController extends AppController {
	var $name = 'Quotes';
    var $components = array('RequestHandler');
	var $helpers = array('Html', 'Form', 'Javascript');
	var $uses = array('Quote', 'Vendors', 'Product', 'Contacts', 'Attachment');
	
	
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
	
	
	
	
		function getQuotesByVendor() {
		    Configure::write('debug', '0');
			$this->layout = "ajax";

			$quoteArray = array();

			$vendor_id = $this->params['form']['vendor_id'];
			$productname = $this->params['form']['product_name_search'];
			$contactid = $this->params['form']['contact_id'];
			$date_start = $this->params['form']['date_start'];
			$date_end = $this->params['form']['date_end'];
	//		$vendor_id = 1;
	//		$date_start = "2008-04-15";
		
			$conditions = array('Quote.vendor_id' => $vendor_id);
			$fields = array('Quote.id', 'Quote.quote_sent_date', 'Quote.quote_name');
			$order = 'Quote.id DESC';
			
			if ($productname){
				if ($this->Product->find('count', array('conditions'=>array('Product.product_name LIKE' => '%'.$productname.'%'))) > 0) {
					
					//INSERT ITEM-NO, etc CODE HERE:
		
					$prodIDs = $this->Product->find('list', array(
			   			'fields' => array('Product.id'), 'conditions'=>array('Product.product_name LIKE' => '%'.$productname.'%')
					));
			
					$comma_prodIDs = implode(",", $prodIDs);
			
					$quoteIDs = $this->Quote->query("SELECT quote_id FROM quotes_details WHERE product_id IN (".$comma_prodIDs.");");
					$quoteIDs = Set::extract($quoteIDs, '{n}.quotes_details');
					$quoteIDs = Set::extract($quoteIDs, '{n}.quote_id');
				
					$this->Quote->bindModel(array('belongsTo' => array('Vendor')));
					
					array_push($conditions, array('Quote.id' => $quoteIDs));
				}
			}
			
			if ($contactid){	
				$quoteIDs = $this->Quote->ContactQuotes->find('list', array(
		   			'fields' => array('ContactQuotes.quote_id'), 'conditions'=>array('ContactQuotes.contact_id' => $contactid)
				));
				
				array_push($conditions, array('Quote.id' => $quoteIDs));
				
			}
			
			if ($date_start){
				array_push($conditions, array('Quote.quote_sent_date >' => $date_start));
			}
			
			if ($date_end){
				array_push($conditions, array('Quote.quote_sent_date <' => $date_end));
			}
								
			$quoteA = $this->Quote->find('all', compact('conditions', 'fields', 'order'));
			$count = $this->Quote->find('count', compact('conditions'));

			$quoteArray = Set::extract($quoteA, '{n}.Quote');
			$attachArray = Set::extract($quoteA, '{n}.Attachment.{n}.location');
			
			//Shitty routine I had to do to get the location field named right	
			$i=0;
			$temparray=array();
			foreach($attachArray as $akey){
				foreach($attachArray[$i] as $key=>$value){
					if($key=="0"){
						$key="attach_location";
					}
					$temparray[$key]=$value;
				}
				$attachArray[$i]=$temparray;
				$i++;
			}
			
			$joinedArray = Set::merge($quoteArray, $attachArray);

			$this->set('total', $count);
			$this->set('success', 'true');
			$this->set('quotes',$joinedArray);
		}
				
}
?>
