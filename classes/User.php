<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'../../lib/Database.php') ;
	include_once ($filepath.'../../helpers/Format.php') ;

	//Load Composer's autoloader
	require 'vendor/autoload.php';
?>

<?php

/**
 * User Class
 */
class User
{
	private $db;
    private $fm;
	function __construct(){
		$this->db=new Database();
	  	$this->fm=new Format();
	}

	public function register($data){
		$errors = array();

   		$full_name=$this->fm->validation($data['full_name']);
   		$full_name=mysqli_real_escape_string($this->db->link,$full_name);

   		$email=$this->fm->validation($data['email']);
   		$email=mysqli_real_escape_string($this->db->link,$email);

   		$phone=$this->fm->validation($data['phone']);
   		$phone=mysqli_real_escape_string($this->db->link,$phone);

   		$user_type=$this->fm->validation($data['user_type']);
   		$user_type=mysqli_real_escape_string($this->db->link,$user_type);

   		$password=$this->fm->validation($data['password']);
   		$password=mysqli_real_escape_string($this->db->link,$password);

   		$confirm_password=$this->fm->validation($data['confirm_password']);
   		$confirm_password=mysqli_real_escape_string($this->db->link,$confirm_password);

   		//Full Name Error
		if (empty($full_name)) {
		  	$errors['full_name_error'] = "Please Provide A Full Name";
		}

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
		  	$errors['phone_error'] = "Please Provide A Valid Phone Number";
		}

		//User Type Error
		if (empty($user_type)) {
		  	$errors['phone_error'] = "Please Provide A Valid Phone Number";
		}

		//Password Error
	  	if (strlen($password)>20 || strlen($password)<5) {
	  		$errors['password_error'] = "Password Min Limit is 5 & Max Limit is 20 Characters";
	  	}

	  	//Cofirm Password
	  	if ($password != $confirm_password || empty($confirm_password)) {
	  		$errors['confirm_password_error'] = "Password DoesNot Match Or Empty";
	  	}

	  	if(count($errors) == 0){
	  		//Password Hashing
			$password = password_hash($password,PASSWORD_DEFAULT);

			//Generate Unique Random Reset Code
			$code = md5(crypt(rand(),'aa'));

			//Store To the Database
			$query = "INSERT INTO users(
                full_name,email,phone,user_type,password,reset_code)
	            VALUES('$full_name','$email','$phone','$user_type','$password','$code')";
	    	$result   = $this->db->insert($query);
	    	if($result){
	    		$this->fm->setMsg('msg','Your Account Has Been Created SuccessFully.Please,Check Your Email To Verify','warning');
	    		$message = "Hi! You requested an account on our website, in order to use this account. You need to click here to <a href='".URLROOT."/classes/AccountVerify.php?function=AccountVerify&code=$code'>Verify</a> it.";
	    		$this->send_mail([

	                'to' => $email,
	                'message' => $message,
	                'subject' => 'Account Verficiation',
	                'from' => 'Car Washing System',

            	]);
	    	}
	  	}else{
	  		$data = [
				'full_name' => $full_name,
				'phone' => $phone,
				'email' => $email,
				'password' => $password,
				'confirm_password' => $confirm_password,
	    	];


			$this->fm->setMsg('form_data',$data);
	    	$this->fm->setMsg('errors',$errors);
	  	}

	}

	public function login($data){
	   $errors = array();

	   $email=$this->fm->validation($data['email']);
       $email=mysqli_real_escape_string($this->db->link,$email);

       $password=$this->fm->validation($data['password']);
       $password=mysqli_real_escape_string($this->db->link,$password);


       $remember = isset($_POST['remember_me']) ? 'Yes' : '';

       if (!$this->checkUserByEmail($email)) {
       		$errors['email_error'] = 'Email Not Exits';
       }elseif (!$this->checkUserActivation($email)) {
       		$errors['email_error'] = "Your Account Is Not Verified";
       }

       if(count($errors) == 0){
			$query="SELECT * FROM users Where email='$email'";
	    	$result=$this->db->select($query);
	    	if ($result) {
	    		$value=$result->fetch_assoc();
				if (password_verify($password,$value['password'])) {
	    			if ($remember === 'Yes') {
	    				setcookie('user',serialize($value),time() + (86400 * 30),'/');
	    			}else{
	    				Session::set("userLogin",true);
		                Session::set("userId",$value['id']);
		                Session::set("userType",$value['user_type']);
		                Session::set("userName",$value['full_name']);
	    			}
	    			$this->fm->redirect('index.php');
	    		}else{
	    			$data = [
						'email' => $email,
						'password' => $password
		       		];
		       		$this->fm->setMsg('form_data',$data);
	    			$this->fm->setMsg('msg_notify','Incorrect credentials','warning');
	    		}
	    	}else{
	    		$data = [
					'email' => $email,
					'password' => $password
	       		];
		       	$this->fm->setMsg('form_data',$data);
	    		$this->fm->setMsg('msg_notify','User Not Found','warning');
	    	}
       }else{
       		$data = [
				'email' => $email,
				'password' => $password
       		];

       		$this->fm->setMsg('form_data',$data);
       		$this->fm->setMsg('errors',$errors);
       }
	}

	public function checkUserByEmail($email,$currentUserID=null){
		if($currentUserID == null){
				$mailcheck="SELECT users.email FROM users Where email='$email'";
			    $mailres=$this->db->select($mailcheck);
			    if ($mailres) {
			       return true;
			    }
			}else{
				$mailcheck="SELECT users.email FROM users Where email='$email' AND id!='$currentUserID'";
			    $mailres=$this->db->select($mailcheck);
			    if ($mailres) {
			       return true;
			    }
			}
	}

	public function checkUserActivation($email){
		$mailcheck="SELECT users.email FROM users Where email='$email' AND is_active=1";
	    $mailres=$this->db->select($mailcheck);
	    if ($mailres) {
	       return true;
	    }
	}

	public function forgetPassword($data){
		$errors = array();
		$email=$this->fm->validation($data['email']);
	    $email=mysqli_real_escape_string($this->db->link,$data['email']);

		if (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
		  		$errors['email_error'] = "Invalid Email";
		}elseif ($this->checkUserByEmail($email) !== true) {
		  		$errors['email_error'] = "Email Not Exists";
		}

		if(count($errors) == 0){
			$code = md5(crypt(rand(), 'aa'));
			$query = "UPDATE users
				SET reset_code = '$code',
				is_active=0
				WHERE email='$email'
				";
			$result = $this->db->update($query);
			if($result){
				$this->fm->setMsg('msg', 'You made a password request, please check email to reset your password.', 'warning');
				$message = "Hi! You requested password reset, . You need to click here to <a href='".URLROOT."/classes/ResetCodeVerify.php?reset_code=$code'>Reset your password.</a>";
				$this->send_mail([

	                'to' => $email,
	                'message' => $message,
	                'subject' => 'Reset Password Requested',
	                'from' => 'Car Washing System',

	            ]);
			}
		}else{
			$data = [
				'email' => $email,
			];
			$this->fm->setMsg('form_data',$data);
	    	$this->fm->setMsg('errors',$errors);
		}
	}


	public function resetForgetPassword($data){

		$errors = array();

		$password=$this->fm->validation($data['password']);
      	$password=mysqli_real_escape_string($this->db->link,$password);

      	$confirm_password=$this->fm->validation($data['confirm_password']);
      	$confirm_password=mysqli_real_escape_string($this->db->link,$confirm_password);

      	//password
	    if(strlen($password)>20 || strlen($password)<5){
	         $errors['password_error'] = 'Password min limit is 5 & max is 20 characters';
	    }

	    //confirm password
	    if($password!=$confirm_password || empty($confirm_password)){
	         $errors['confirm_password_error'] = 'Password does not match or empty';
	    }

	    if(count($errors) == 0){
			$code = $_SESSION['reset_code'];
	     	$password = password_hash($password,PASSWORD_DEFAULT);
	     	$query = "UPDATE users SET
	     			is_active=1,
	     			reset_code='',
	     			password='$password'
	     			WHERE reset_code='$code'";
	     	$result = $this->db->update($query);
	     	if ($result) {
	     		unset($_SESSION['reset_code']);
				$this->fm->setMsg('msg_notify', 'Your account password has been reset, you can login now.');
	            $this->fm->redirect('login.php');
	     	}
	    }else{
	    	$data = [
	            'password' => $password,
	            'confirm_password' => $confirm_password,
	        ];

	        $this->fm->setMsg('form_data', $data);
	        $this->fm->setMsg('errors', $errors);
	        $this->fm->redirect('reset_password.php');
	    }

	}

	public function getUserData(){
		if (isset($_COOKIE['user'])) {
			$data = unserialize($_COOKIE['user']);
			$id = $data['id'];
		}
		$currentUserID = (Session::get('userId') !== false) ? Session::get('userId') : $id;
		$query = "SELECT * FROM users WHERE id='$currentUserID'";
		$result = $this->db->select($query);
		if ($result) {
			return $result;
		}
	}

	public function getUserIdAndUserType(){
		if (isset($_COOKIE['user'])) {
			$data = unserialize($_COOKIE['user']);
			$userId = $data['id'];
			$userType = $data['user_type'];
			return array($userId,$userType);
		}
		return array(Session::get('userId'),Session::get('userType'));
	}

	public function getUserCategoryName($userId,$userType){
		$query = "SELECT name FROM user_categories LEFT JOIN users ON users.id='$userId' WHERE user_categories.id='$userType'";
		$result = $this->db->select($query);
		if($result){
			while ($value = $result->fetch_assoc()) {
				return $value['name'];

			}
		}
	}

	public function checkServieProvider(){
		list($x,$y) = $this->getUserIdAndUserType();
		if ($this->getUserCategoryName($x,$y) !== 'Service Provider') {
			$this->fm->setMsg('msg_notify','You Are Not Registered As Service Provider','danger');
			$this->fm->redirect('index.php');
		}
	}

	public function checkNormalUser(){
		list($x,$y) = $this->getUserIdAndUserType();
		if ($this->getUserCategoryName($x,$y) === 'User') {
			return true;
		}
		return false;
	}
    
    public function getCurrentUserData(){
        if (isset($_COOKIE['user'])) {
                $data = unserialize($_COOKIE['user']);
                $id = $data['id'];
            }
        $currentUserID = (Session::get('userId') !== false) ? Session::get('userId') : $id;
        
        $query = "SELECT full_name,email,phone FROM users WHERE id='$currentUserID'";
        $result = $this->db->select($query);
        return $result;
    }
    
    
    public function editUser($data){
            if (isset($_COOKIE['user'])) {
                $data = unserialize($_COOKIE['user']);
                $id = $data['id'];
            }
            $currentUserID = (Session::get('userId') !== false) ? Session::get('userId') : $id;
			
            $errors = array();

			$full_name=$this->fm->validation($data['full_name']);
       		$full_name=mysqli_real_escape_string($this->db->link,$full_name);

       		$email=$this->fm->validation($data['email']);
       		$email=mysqli_real_escape_string($this->db->link,$email);

       		$phone=$this->fm->validation($data['phone']);
       		$phone=mysqli_real_escape_string($this->db->link,$phone);

       		//Email Errors
       		if (empty($email)) {
		  		$errors['email_error'] = "Email Field Must Be Filled";
		  	}else if (filter_var($email, FILTER_VALIDATE_EMAIL)==false) {
		  		$errors['email_error'] = "Invalid Email";
		  	}else if ($this->checkUserByEmail($email,$currentUserID)) {
	       		$errors['email_error'] = 'Email Already Exits';
	       	}

	       	//Phone Error
			if (empty($phone)) {
			  	$errors['phone_error'] = "Phone Field Must Be Filled";
			}

			//Phone Error
			if (empty($full_name)) {
			  	$errors['name_error'] = "Name Field Must Be Filled";
			}

			if(count($errors) == 0){
				$query = "UPDATE users
					SET
					full_name = '$full_name',
					email = '$email',
					phone = '$phone'
					WHERE id = '$currentUserID'
					";
				$result = $this->db->update($query);
				if($result){
					$this->fm->setMsg('msg','Profile Updated SuccessFully');
					$this->fm->redirect('profile.php');
				}else{
					$this->fm->setMsg('msg_notify','Something Went Wrong..');
					$data = [
						'full_name' => $full_name,
						'email' => $email,
						'phone' => $phone,
					];

					$this->fm->setMsg('form_data',$data);
				}

			}else{
				$data = [
					'full_name' => $full_name,
					'email' => $email,
					'phone' => $phone,
				];

				$this->fm->setMsg('form_data',$data);
       			$this->fm->setMsg('errors',$errors);
			}

		}

	public function logout(){
		if(isset($_COOKIE['user'])){
          setcookie('user', '', time() - (86400 * 30), '/');
     	}
		Session::destroy();
	}


	public function send_mail($detail=array())
	{
		if (!empty($detail['to']) && !empty($detail['message']) && !empty($detail['from'])) {
			$mail = new PHPMailer(true);
			//$mail->SMTPDebug = 2;
			$mail->SMTPSecure = false;
			$mail->SMTPAutoTLS = false;
			$mail->isSMTP();
		    $mail->Host = 'smtp.gmail.com';
		    $mail->SMTPAuth = true;
		    $mail->Username = USERNAME;
		    $mail->Password = PASSWORD;
		    $mail->SMTPSecure = 'tls';;
		    $mail->Port = 587;
		    $mail->SMTPOptions = array(
			'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);

		    $mail->setFrom('no-reply@proteinwriter.com', $detail['from']);
    		$mail->addAddress($detail['to'], '');

    		$mail->isHTML(true);
		    $mail->Subject = $detail['subject'];
		    $mail->Body    = $detail['message'];

		    if (!$mail->send()) {
		    	return false;
		    }else{
		    	return true;
		    }
		}
	}




} // End Class


?>
