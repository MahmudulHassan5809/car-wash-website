<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php') ;
?>


<?php

/**
 *
 */
class ContactMessage
{

	private $db;
    private $fm;

	function __construct(){
		$this->db=new Database();
	  	$this->fm=new Format();
	}

	public function sendMessage($data){
		$errors = array();

   		$name=$this->fm->validation($data['name']);
   		$name=mysqli_real_escape_string($this->db->link,$name);

   		$email=$this->fm->validation($data['email']);
   		$email=mysqli_real_escape_string($this->db->link,$email);

   		$phone=$this->fm->validation($data['phone']);
   		$phone=mysqli_real_escape_string($this->db->link,$phone);

   		$subject=$this->fm->validation($data['subject']);
   		$subject=mysqli_real_escape_string($this->db->link,$subject);

   		$message=$this->fm->validation($data['message']);
   		$message=mysqli_real_escape_string($this->db->link,$message);

   		//Name Errors
   		if (empty($name)) {
	  		$errors['name_error'] = "Name Field Must Be Filled";
	  	}

	  	//Email Errors
   		if (empty($email)) {
	  		$errors['email_error'] = "Email Field Must Be Filled";
	  	}else if (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
	  		$errors['email_error'] = "Invalid Email";
	  	}

	  	//Phone Errors
   		if (empty($phone)) {
	  		$errors['phone_error'] = "Phone Field Must Be Filled";
	  	}

	  	//Subject Errors
   		if (empty($subject)) {
	  		$errors['subject_error'] = "Subject Field Must Be Filled";
	  	}

	  	//Message Errors
   		if (empty($message)) {
	  		$errors['message_error'] = "Message Field Must Be Filled";
	  	}

	  	if(count($errors) == 0){
			$query = "INSERT INTO messages(
                name,email,phone,subject,message)
	            VALUES('$name','$email','$phone','$subject','$message')";
	        $result = $this->db->insert($query);
	        if($result){
	        	return true;
	        }else{
	        	return false;
	        }
	  	}else{
	  		$data = [
				'name' => $name,
				'phone' => $phone,
				'email' => $email,
				'subject' => $subject,
				'message' => $message,
	    	];


			$this->fm->setMsg('form_data',$data);
	    	$this->fm->setMsg('errors',$errors);
	  	}

	}


	public function allMessages(){
		$query = "SELECT * FROM messages ORDER BY created_at DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function deleteMessage($id){
		$id=$this->fm->validation($id);
       	$id=mysqli_real_escape_string($this->db->link,$id);

       	$delquery="DELETE FROM messages where id='$id'";
  		$deldata=$this->db->delete($delquery);

  		if($deldata){
   			$this->fm->setMsg('msg','Message Deleted SuccessFully!!');
   			$this->fm->redirect('messages.php');
  		}else{
			$this->fm->setMsg('msg_notify','Something Went Wrong');
   			$this->fm->redirect('messages.php');
		}
	}

	public function messageById($id){
		$id=$this->fm->validation($id);
       	$id=mysqli_real_escape_string($this->db->link,$id);

       	$query = "SELECT * FROM messages WHERE id='$id'";
       	$result = $this->db->select($query);
       	return $result;
	}



}

?>
