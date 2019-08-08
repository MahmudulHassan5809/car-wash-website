<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php') ;
?>

<?php
	/**
	 * Admin Class
	 */

	class Admin {

		private $db;
    	private $fm;

		function __construct(){
			$this->db=new Database();
	  		$this->fm=new Format();
		}

		public function login($data){
			$errors = array();

	   		$email=$this->fm->validation($data['email']);
       		$email=mysqli_real_escape_string($this->db->link,$email);

       		$password=$this->fm->validation($data['password']);
       		$password=mysqli_real_escape_string($this->db->link,$password);

       		//Email Errors
       		if (empty($email)) {
		  		$errors['email_error'] = "Email Field Must Be Filled";
		  	}else if (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
		  		$errors['email_error'] = "Invalid Email";
		  	}else if (!$this->checkUserByEmail($email)) {
	       		$errors['email_error'] = 'Email Not Exits';
	       	}


		  	//Password Error
			if (empty($password)) {
			  	$errors['password_error'] = "Password Field Must Be Filled";
			}

			if(count($errors) == 0){
				$old_passwrod = $password;
				$password=md5($password);
				$query="SELECT * FROM admin Where email='$email' and password='$password'";
				$result=$this->db->select($query);
				if($result!=false){
	                $value=$result->fetch_assoc();
	                Session::set("adminLogin",true);
	                Session::set("adminId",$value['id']);
	                Session::set("adminName",$value['name']);
	                 Session::set("adminType",$value['admin_type']);
	                $this->fm->redirect('index.php');
				}else{
					$data = [
						'email' => $email,
						'password' => $old_passwrod,
					];

					$this->fm->setMsg('form_data',$data);
					$this->fm->setMsg('msg_notify','Incorrect credentials','warning');
				}
			}else{
				$data = [
					'email' => $email,
					'password' => $password,
				];

				$this->fm->setMsg('form_data',$data);
       			$this->fm->setMsg('errors',$errors);
			}

		}

		public function checkUserByEmail($email , $adminId = null){
			if($adminId == null){
				$mailcheck="SELECT admin.email FROM admin Where email='$email'";
			    $mailres=$this->db->select($mailcheck);
			    if ($mailres) {
			       return true;
			    }
			}else{
				$mailcheck="SELECT admin.email FROM admin Where email='$email' AND id!='$adminId'";
			    $mailres=$this->db->select($mailcheck);
			    if ($mailres) {
			       return true;
			    }
			}
		}

		public function allAdmin(){
			$query = "SELECT * FROM admin ORDER BY id DESC";
			$result = $this->db->select($query);
			return $result;
		}


		public function addAdmin($data){
			$errors = array();

	   		$name=$this->fm->validation($data['name']);
       		$name=mysqli_real_escape_string($this->db->link,$name);

       		$email=$this->fm->validation($data['email']);
       		$email=mysqli_real_escape_string($this->db->link,$email);

       		$password=$this->fm->validation($data['password']);
       		$password=mysqli_real_escape_string($this->db->link,$password);

       		$phone=$this->fm->validation($data['phone']);
       		$phone=mysqli_real_escape_string($this->db->link,$phone);

       		//Email Errors
       		if (empty($email)) {
		  		$errors['email_error'] = "Email Field Must Be Filled";
		  	}else if (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
		  		$errors['email_error'] = "Invalid Email";
		  	}else if ($this->checkUserByEmail($email)) {
	       		$errors['email_error'] = 'Email Already Exits';
	       	}

	       	//Phone Error
			if (empty($phone)) {
			  	$errors['phone_error'] = "Phone Field Must Be Filled";
			}

			//Phone Error
			if (empty($name)) {
			  	$errors['name_error'] = "Name Field Must Be Filled";
			}


		  	//Password Error
			if (empty($password)) {
			  	$errors['password_error'] = "Password Field Must Be Filled";
			}

			if(count($errors) == 0){
				$newPassword = md5($password);
				$query = "INSERT INTO admin(
                name,email,password,phone)
	            VALUES('$name','$email','$newPassword','$phone')";
	    		$result   = $this->db->insert($query);
	    		if($result){
	    			$this->fm->setMsg('msg_notify','Admin Added SuccessFully!!');
	    			$this->fm->redirect('all_admin.php');
	    		}else{
					$data = [
						'name' => $name,
						'email' => $email,
						'password' => $password,
						'phone' => $phone,
					];
					$this->fm->setMsg('msg','Something Went Wrong!!');
	    		}
			}else{
				$data = [
					'name' => $name,
					'email' => $email,
					'password' => $password,
					'phone' => $phone,
				];

				$this->fm->setMsg('form_data',$data);
       			$this->fm->setMsg('errors',$errors);
			}
		}


		public function adminById($id){
			$id=$this->fm->validation($id);
       		$id=mysqli_real_escape_string($this->db->link,$id);

       		$query = "SELECT * FROM admin Where id='$id'";
       		$result = $this->db->select($query);
       		return $result;
		}

		public function editAdmin($data,$id){
			$adminId = Session::get('adminId');
			if($adminId !== $id){
				$fm->setMsg('msg_notify','This is Not Your Profile','warning');
				$fm->redirect('all_admin.php');
			}

			$errors = array();

			$name=$this->fm->validation($data['name']);
       		$name=mysqli_real_escape_string($this->db->link,$name);

       		$email=$this->fm->validation($data['email']);
       		$email=mysqli_real_escape_string($this->db->link,$email);

       		$phone=$this->fm->validation($data['phone']);
       		$phone=mysqli_real_escape_string($this->db->link,$phone);

       		//Email Errors
       		if (empty($email)) {
		  		$errors['email_error'] = "Email Field Must Be Filled";
		  	}else if (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
		  		$errors['email_error'] = "Invalid Email";
		  	}else if ($this->checkUserByEmail($email,$adminId)) {
	       		$errors['email_error'] = 'Email Already Exits';
	       	}

	       	//Phone Error
			if (empty($phone)) {
			  	$errors['phone_error'] = "Phone Field Must Be Filled";
			}

			//Phone Error
			if (empty($name)) {
			  	$errors['name_error'] = "Name Field Must Be Filled";
			}

			if(count($errors) == 0){
				$query = "UPDATE admin
					SET
					name = '$name',
					email = '$email',
					phone = '$phone'
					WHERE id = '$id'
					";
				$result = $this->db->update($query);
				if($result){
					$this->fm->setMsg('msg','Profile Updated SuccessFully');
					$this->fm->redirect('all_admin.php');
				}else{
					$this->fm->setMsg('msg_notify','Something Went Wrong..');
					$data = [
						'email' => $email,
						'name' => $name,
						'phone' => $phone,
					];

					$this->fm->setMsg('form_data',$data);
				}

			}else{
				$data = [
					'email' => $email,
					'name' => $name,
					'phone' => $phone,
				];

				$this->fm->setMsg('form_data',$data);
       			$this->fm->setMsg('errors',$errors);
			}

		}

		public function changePassword($data){

			$errors = array();
		    $old_password=$this->fm->validation($data['old_password']);
	        $old_password=mysqli_real_escape_string($this->db->link,$old_password);

	        $password=$this->fm->validation($data['password']);
	        $password=mysqli_real_escape_string($this->db->link,$password);

	        $confirm_password=$this->fm->validation($data['confirm_password']);
	        $confirm_password=mysqli_real_escape_string($this->db->link,$confirm_password);

	        //Password Error
			if (empty($old_password)) {
			  		$errors['old_password_error'] = "Empty Current Password";
			}

			if (empty($password)) {
			  		$errors['password_error'] = "Empty New Password";
			}

			//Cofirm Password
			if ($password != $confirm_password || empty($confirm_password)) {
			  	$errors['confirm_password_error'] = "Password DoesNot Match Or Empty";
			}

			if (count($errors) == 0) {
				$adminId = Session::get('adminId');
				$new_password = md5($password);
          		$query="SELECT password FROM admin WHERE id='$adminId'";
	   	  		$result = $this->db->select($query);
	   	  		if($result){
	   	  			$value = $result->fetch_assoc();
	   	  			if(md5($old_password) == $value['password']){
	   	  				$query="UPDATE admin
		          			SET password='$new_password'
		          			WHERE id='$adminId'";
		        		$result=$this->db->update($query);
		        		if($result){
		        			$this->fm->setMsg('msg','Password Updated SuccessFully');
		        			$this->fm->redirect('all_admin.php');
		        		}
	   	  			}else{
	   	  				$this->fm->setMsg('msg_notify','Wrong Current Password','warning');
	   	  			}
	   	  		}else{
	   	  			$this->fm->setMsg('msg_notify','Something Went Wrong!!');
		        	$this->fm->redirect('all_admin.php');
	   	  		}
			}else{
				$data = [
					'old_password' => $old_password,
					'password' => $password,
					'confirm_password' => $confirm_password,
				];
				$this->fm->setMsg('form_data',$data);
		    	$this->fm->setMsg('errors',$errors);
			}

		}


		public function deleteAdmin($id){
			if(Session::get('adminType') == 0){
				$this->fm->setMsg('msg_notify','Only Main Admin Can Delete Others Admin!!','warning');
		        $this->fm->redirect('all_admin.php');
			}
			$id=$this->fm->validation($id);
	        $id=mysqli_real_escape_string($this->db->link,$id);

			$query = "DELETE FROM admin WHERE id='$id'";
			$result = $this->db->delete($query);
			if($result){
				$this->fm->setMsg('msg_notify','Admin Deleted!!');
		        $this->fm->redirect('all_admin.php');
			}else{
				$this->fm->setMsg('msg_notify','SomeThing Went Wrong!!','warning');
		        $this->fm->redirect('all_admin.php');
			}

		}


		public function logOut(){
			Session::destroy();
		}



	}//class end
?>
