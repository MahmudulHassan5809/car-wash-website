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
				$password=md5($password);
				$query="SELECT * FROM admin Where email='$email' and password='$password'";
				$result=$this->db->select($query);
				if($result!=false){
	                $value=$result->fetch_assoc();
	                Session::set("adminLogin",true);
	                Session::set("adminId",$value['id']);
	                Session::set("adminName",$value['name']);
	                $this->fm->redirect('index.php');
				}else{
					$data = [
						'email' => $email,
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

		public function checkUserByEmail($email){
			$mailcheck="SELECT admin.email FROM admin Where email='$email'";
		    $mailres=$this->db->select($mailcheck);
		    if ($mailres) {
		       return true;
		    }
		}


		public function logOut(){
			Session::destroy();
		}



	}//class end
?>
