<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php') ;
?>


<?php

/**
 * Settings
 */
class Settings
{
	private $db;
    private $fm;

	function __construct(){
		$this->db=new Database();
	  	$this->fm=new Format();
	}

	public function getAllSettings(){
		$query = "SELECT * FROM settings";
		$result = $this->db->select($query);
		return $result;
	}

	public function addSettings($data){
		$count = (int)mysqli_num_rows($this->getAllSettings());
		if($count > 0){
			$this->fm->setMsg('msg','Please Update Existing Settings...');
	    	$this->fm->redirect('settings.php');
		}
		$errors = array();

   		$name=$this->fm->validation($data['name']);
   		$name=mysqli_real_escape_string($this->db->link,$name);

   		$address=$this->fm->validation($data['address']);
   		$address=mysqli_real_escape_string($this->db->link,$address);

   		$phone=$this->fm->validation($data['phone']);
   		$phone=mysqli_real_escape_string($this->db->link,$phone);

   		$email=$this->fm->validation($data['email']);
   		$email=mysqli_real_escape_string($this->db->link,$email);

   		$facebook=$this->fm->validation($data['facebook']);
   		$facebook=mysqli_real_escape_string($this->db->link,$facebook);

   		$linkedin=$this->fm->validation($data['linkedin']);
   		$linkedin=mysqli_real_escape_string($this->db->link,$linkedin);

   		$instagram=$this->fm->validation($data['instagram']);
   		$instagram=mysqli_real_escape_string($this->db->link,$instagram);

   		//Name Error
		if (empty($name)) {
		  	$errors['name_error'] = "Please Provide A Company Name";
		}

		//Address Error
		if (empty($address)) {
		  	$errors['address_error'] = "Please Provide A Company Address";
		}

		//Phone Error
		if (empty($phone)) {
		  	$errors['phone_error'] = "Please Provide A Company Phone";
		}

		//Email Error
		if (empty($email)) {
		  	$errors['email_error'] = "Please Provide A Company Email";
		}

		if(count($errors) == 0){
			//Store To the Database
			$query = "INSERT INTO settings(
                name,address,phone,email,facebook,linkedin,instagram)
	            VALUES('$name','$address','$phone','$email','$facebook','$linkedin','$instagram')";
	    	$result   = $this->db->insert($query);
	    	if($result){
	    		$this->fm->setMsg('msg','Application Settings Added...');
	    		$this->fm->redirect('settings.php');
	    	}else{
	    		$data = [
					'name' => $name,
					'address' => $address,
					'phone' => $phone,
					'email' => $email,
					'facebook' => $facebook,
					'linkedin' => $linkedin,
					'instagram' => $instagram,
		    	];
		    	$this->fm->setMsg('msg_notify','Something Went Wrong...','warning');
		    	$this->fm->redirect('add_settings.php');
	    	}
		}else{
			$data = [
				'name' => $name,
				'address' => $address,
				'phone' => $phone,
				'email' => $email,
				'facebook' => $facebook,
				'linkedin' => $linkedin,
				'instagram' => $instagram,
	    	];


			$this->fm->setMsg('form_data',$data);
	    	$this->fm->setMsg('errors',$errors);
		}

	}


	public function settingsById($id){
		$id=$this->fm->validation($id);
   		$id=mysqli_real_escape_string($this->db->link,$id);

   		$query = "SELECT * FROM settings WHERE id='$id'";
   		$result = $this->db->select($query);
   		return $result;
	}

	public function editSettings($data,$id){

		$errors = array();

   		$name=$this->fm->validation($data['name']);
   		$name=mysqli_real_escape_string($this->db->link,$name);

   		$address=$this->fm->validation($data['address']);
   		$address=mysqli_real_escape_string($this->db->link,$address);

   		$phone=$this->fm->validation($data['phone']);
   		$phone=mysqli_real_escape_string($this->db->link,$phone);

   		$email=$this->fm->validation($data['email']);
   		$email=mysqli_real_escape_string($this->db->link,$email);

   		$facebook=$this->fm->validation($data['facebook']);
   		$facebook=mysqli_real_escape_string($this->db->link,$facebook);

   		$linkedin=$this->fm->validation($data['linkedin']);
   		$linkedin=mysqli_real_escape_string($this->db->link,$linkedin);

   		$instagram=$this->fm->validation($data['instagram']);
   		$instagram=mysqli_real_escape_string($this->db->link,$instagram);

   		$id=$this->fm->validation($id);
   		$id=mysqli_real_escape_string($this->db->link,$id);

   		//Name Error
		if (empty($name)) {
		  	$errors['name_error'] = "Please Provide A Company Name";
		}

		//Address Error
		if (empty($address)) {
		  	$errors['address_error'] = "Please Provide A Company Address";
		}

		//Phone Error
		if (empty($phone)) {
		  	$errors['phone_error'] = "Please Provide A Company Phone";
		}

		//Email Error
		if (empty($email)) {
		  	$errors['email_error'] = "Please Provide A Company Email";
		}

   		if(count($errors) == 0){
			//Store To the Database
			$query = "UPDATE settings SET
					name='$name',
					address='$address',
					phone='$phone',
					email='$email',
					facebook='$facebook',
					linkedin='$linkedin',
					instagram='$instagram'
					WHERE id='$id'
					";
	    	$result   = $this->db->update($query);
	    	if($result){
	    		$this->fm->setMsg('msg','Application Settings Updated...');
	    		$this->fm->redirect('settings.php');
	    	}else{
	    		$data = [
					'name' => $name,
					'address' => $address,
					'phone' => $phone,
					'email' => $email,
					'facebook' => $facebook,
					'linkedin' => $linkedin,
					'instagram' => $instagram,
		    	];
		    	$this->fm->setMsg('msg_notify','Something Went Wrong...','warning');
		    	$this->fm->redirect('edit_settings.php?id=' . $id);
	    	}
		}else{
			$data = [
				'name' => $name,
				'address' => $address,
				'phone' => $phone,
				'email' => $email,
				'facebook' => $facebook,
				'linkedin' => $linkedin,
				'instagram' => $instagram,
	    	];


			$this->fm->setMsg('form_data',$data);
	    	$this->fm->setMsg('errors',$errors);
		}
	}



}


?>
