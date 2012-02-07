<?php
class AttachmentsController extends AppController {
	var $name = 'Attachments';
	var $uses = array('Attachment', 'Product', 'AttachmentsProduct', 'AttachmentFileType');
	var $helpers = array('Html', 'Form','Javascript');
	
	var $params = array();
    var $errorCode = null;
    var $errorMessage = null;

    var $filename;


	function index() {
		Configure::write('debug', '2');
	}
	
	function getFileExtension($str) {  
		$i = strrpos($str,".");  
		if (!$i) { return ""; }  
		$l = strlen($str) - $i;  
		$ext = substr($str,$i+1,$l);  
		return $ext;
	}
	
    function upload() {
		Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$product_id = $this->params['form']['product_id'];
		
        $ok = false;
        if ($this->validate()) {
	
			$target_path = "attachments/products/" . $product_id . "/";
			$target_path_thumbs = "attachments/products/" . $product_id . "/thumbs/";
			
			if(!is_dir($target_path)) mkdir($target_path,0775,true);
			if(!is_dir($target_path_thumbs)) mkdir($target_path_thumbs,0775,true);
			
			$target_path = $target_path . basename($_FILES['Filedata']['name']);
			$target_path_thumbs = $target_path_thumbs . "s_" . basename($_FILES['Filedata']['name']); 

			if(move_uploaded_file($_FILES['Filedata']['tmp_name'], $target_path)) {
				
				$filetype = $this->getFileExtension($target_path);
				$filetype = strtolower($filetype);
				$isanimage = true;
				
				switch($filetype){  
					case "jpeg":  
					case "jpg":  
						$img_src = imagecreatefromjpeg($target_path); 
						break;  
					case "gif":  
						$img_src = imagecreatefromgif($target_path);  
						break;  
					case "png":  
						$img_src = imagecreatefrompng($target_path);  
						break;
					default:
						$isanimage = false;
						break;
				}
				
				if($isanimage){				
					list($oldwidth, $oldheight) = getimagesize($target_path);
					$newwidth = 64;
					$newheight = 64;
					$img_des = imagecreatetruecolor($newwidth, $newheight);
					imagecopyresampled($img_des, $img_src, 0, 0, 0, 0, $newwidth, $newheight, $oldwidth, $oldheight);
					
					switch($filetype){  
						case "jpeg":  
						case "jpg":  
							$img_src = imagejpeg($img_des, $target_path_thumbs, 100); 
							break;  
						case "gif":  
							$img_src = imagegif($img_des, $target_path_thumbs);
							break;  
						case "png":  
							$img_src = imagepng($img_des, $target_path_thumbs, 7);
							break;
					}
				}
				$ok = true;
			    echo "success";
			} else{
			    echo "There was an error uploading the file, please try again!";
			}
		}
		
		
	    if (!$ok) {
            header("HTTP/1.0 500 Internal Server Error");    //this should tell SWFUpload what's up
            $this->setError();    //this should tell standard form what's up
        }	

    }


	function assignToProduct() {
		$this->layout = "ajax";
 		Configure::write('debug', '0');

		$product_id = $this->params['form']['product_id'];
 
		if (!empty($this->data)) {
			$this->Attachment->create();
			
			$this->data['Attachment']['location'] = 'attachments/products/' . $product_id . '/' . $this->data['Attachment']['attachment_name'];
			$ext = substr($this->data['Attachment']['attachment_name'], -3, 3);

			if($this->AttachmentFileType->find('count', array('conditions'=>array('AttachmentFileType.extension' => $ext))) > 0){
				$extArray = array();
				$extArray = $this->AttachmentFileType->findByExtension($ext);
				$this->data['Attachment']['attachment_file_type_id'] = $extArray['AttachmentFileType']['id'];	
			}
			else{
				$this->data['Attachment']['attachment_file_type_id'] = 1;	
			}
			
			
			if ($this->Attachment->save($this->data)) {
				$this->data['AttachmentsProduct']['product_id'] = $product_id;
				$this->data['AttachmentsProduct']['attachment_id'] = $this->Attachment->id;

				if ($this->AttachmentsProduct->save($this->data)){
					$this->set('success', '{success:true}');	
				}	
			}
			else {$this->set('success', '{success:false}');
			}
		}
	}
	
	
	function getProductAttachments() {
	    Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$attachprodArray = array();
		$attachArray = array();
		$attachFileTypeArray = array();
		$joinedArray = array();
		
		$product_id = $this->params['form']['product_id'];
		$this->Attachment->bindModel(array('hasOne' => array('AttachmentsProduct')));

	   	$attachprodA = $this->Attachment->find('all', array(
	   			'fields' => array('AttachmentsProduct.id', 'AttachmentsProduct.product_id', 'AttachmentsProduct.attachment_id', 'Attachment.attachment_name', 'Attachment.attachment_category_id', 'Attachment.attachment_file_type_id', 'AttachmentFileType.extension'),
				'conditions'=>array('AttachmentsProduct.product_id' => $product_id),
				'order'=>array('Attachment.attachment_name')
		));
		
		$attachprodArray = Set::extract($attachprodA, '{n}.AttachmentsProduct');
		$attachFileTypeArray = Set::extract($attachprodA, '{n}.AttachmentFileType');
		$attachArray = Set::extract($attachprodA, '{n}.Attachment');
		
		$joinedArray = Set::merge($attachprodArray, $attachArray);
		$joinedArray = Set::merge($joinedArray, $attachFileTypeArray);
		
		$this->set('attachments', $joinedArray);
	}
	
	
	function deleteProductAttachment($attachment_id = null) {	
		Configure::write('debug', '0');
		$this->layout = "ajax";
		
		if($this->Attachment->delete($attachment_id)){	
				$this->set('success', '{success:true}');
			}
	}
	
	
	function assignAttachmentCategory($id = null, $cat_id = null) {
		Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$this->Attachment->id = $id;
		if($this->Attachment->saveField('attachment_category_id', $cat_id)){
			$this->set('success', '{success:true}');
		}
	}	
	
	
	function assignPrimaryThumbnail($product_id = null, $attachment_id = null) {
		Configure::write('debug', '0');
		$this->layout = "ajax";
		
		$this->Product->id = $product_id;
		if($this->Product->saveField('prodimg_attach_id', $attachment_id)){
			$this->set('success', '{success:true}');
		}
	}


    /**
     * validates the post data and checks receipt of the upload
     * @return boolean true if post data is valid and file has been properly uploaded, false if not
     */
    function validate() {
        $post_ok = isset($this->params['form']['Filedata']);
        $upload_error = $this->params['form']['Filedata']['error'];
        $got_data = (is_uploaded_file($this->params['form']['Filedata']['tmp_name']));

        if (!$post_ok){
            $this->setError(2000, 'Validation failed.', 'Expected file upload field to be named "Filedata."');
        }
        if ($upload_error){
            $this->setError(2500, 'Validation failed.', $this->getUploadErrorMessage($upload_error));
        }
        return !$upload_error && $post_ok && $got_data;
    }

    /**
     * parses file upload error code into human-readable phrase.
     * @param int $err PHP file upload error constant.
     * @return string human-readable phrase to explain issue.
     */
    function getUploadErrorMessage($err) {
        $msg = null;
        switch ($err) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_INI_SIZE:
                $msg = ('The uploaded file exceeds the upload_max_filesize directive ('.ini_get('upload_max_filesize').') in php.ini.');
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $msg = ('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.');
                break;
            case UPLOAD_ERR_PARTIAL:
                $msg = ('The uploaded file was only partially uploaded.');
                break;
            case UPLOAD_ERR_NO_FILE:
                $msg = ('No file was uploaded.');
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $msg = ('The remote server has no temporary folder for file uploads.');
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $msg = ('Failed to write file to disk.');
                break;
            default:
                $msg = ('Unknown File Error. Check php.ini settings.');
        }

        return $msg;
    }

    /**
     * sets an error code which can be referenced if failure is detected by controller.
     * note: the amount of info stored in message depends on debug level.
     * @param int $code a unique error number for the message and debug info
     * @param string $message a simple message that you would show the user
     * @param string $debug any specific debug info to include when debug mode > 1
     * @return bool true unless an error occurs
     */
    function setError($code = 1, $message = 'An unknown error occured.', $debug = '') {
        $this->errorCode = $code;
        $this->errorMessage = $message;
        if (DEBUG) {
            $this->errorMessage .= $debug;
        }
		echo $debug;
        return true;
    }

}
?>