<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php') ;
	require ($filepath.'/../vendor/autoload.php') ;

	//Load Composer's autoloader
	//require 'vendor/autoload.php';
?>


<?php

/**
 * Request Class
 */
class Request
{

	private $db;
    private $fm;
	function __construct(){
		$this->db=new Database();
	  	$this->fm=new Format();
	}

	public function ConfirmRequest($serviceId){
		$provider_email = $_SESSION['provider_email'];
		$provider_id = $_SESSION['provider_id'];

		$serviceId=$this->fm->validation($serviceId);
       	$serviceId=mysqli_real_escape_string($this->db->link,$serviceId);

       	if (isset($_COOKIE['user'])) {
			$data = unserialize($_COOKIE['user']);
			$id = $data['id'];
		}
		$currentUserID = (Session::get('userId') !== false) ? Session::get('userId') : $id;

       	$query = "INSERT INTO requests(provider_id,service_id,user_id)
	            VALUES('$provider_id','$serviceId','$currentUserID')";
	    $result   = $this->db->insert($query);
	    if($result){
	    	$this->fm->setMsg('msg_notify','Your Request Has Been Sent');
	    	$message = "Hi You Have New Request Please Check Your Dashboard";
	    	$this->send_mail([
				'to' => $provider_email,
                'message' => $message,
                'subject' => 'New Request',
                'from' => 'Car Washing System',

        	]);
        	unset($_SESSION['provider_email']);
        	unset($_SESSION['provider_id']);
        	$this->fm->redirect('index.php');
	    }
	}

	public function getAllRequestForProvider(){

		if (isset($_COOKIE['user'])) {
				$data = unserialize($_COOKIE['user']);
				$id = $data['id'];
			}
		$user_id = (Session::get('userId') !== false) ? Session::get('userId') : $id;

		$query="SELECT requests.id as request_id,
				users.full_name as user_name,
				users.email as email,
				users.phone as phone,
				users.id as user_id,
				services.name as service_name,
				services.id as service_id
				FROM requests
				INNER JOIN services
				on requests.service_id = services.id
				INNER JOIN users
				on requests.user_id = users.id
				WHERE requests.provider_id = '$user_id'
				order by requests.id desc";
   		$result=$this->db->select($query);
   		return $result;
	}


	public function getAllRequestForUser($id = null){
		if($id == null){
			if (isset($_COOKIE['user'])) {
				$data = unserialize($_COOKIE['user']);
				$id = $data['id'];
			}
			$user_id = (Session::get('userId') !== false) ? Session::get('userId') : $id;
		}else{
			$user_id=$this->fm->validation($id);
       		$user_id=mysqli_real_escape_string($this->db->link,$user_id);
		}

		$query="SELECT requests.id as request_id,
				requests.date as request_date,
				users.full_name as user_name,
				users.email as email,
				users.phone as phone,
				users.id as user_id,
				services.name as service_name,
				services.phone as service_phone,
				services.id as service_id
				FROM requests
				INNER JOIN services
				on requests.service_id = services.id
				INNER JOIN users
				on requests.user_id = users.id
				WHERE requests.user_id = '$user_id'
				order by requests.id desc";
   		$result=$this->db->select($query);
   		return $result;
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


	public function totalRequests(){
			$query = "SELECT count(1) FROM requests";
			$result = $this->db->select($query);
			$result = mysqli_fetch_array($result);
			return $result[0];
	}

	public function cancelRequest($reqId,$userId){
		$reqId=$this->fm->validation($reqId);
       	$reqId=mysqli_real_escape_string($this->db->link,$reqId);

       	$userId=$this->fm->validation($userId);
       	$userId=mysqli_real_escape_string($this->db->link,$userId);

       	if (isset($_COOKIE['user'])) {
			$data = unserialize($_COOKIE['user']);
			$id = $data['id'];
		}
		$currentUserID = (Session::get('userId') !== false) ? Session::get('userId') : $id;

		if($currentUserID === $userId){
			$query = "DELETE FROM requests WHERE id='$reqId'";
			$result = $this->db->delete($query);
			if($result){
				$this->fm->setMsg('msg_notify','Your Request Has Been Canceled','success');
				$this->fm->redirect('user_dashboard.php');
			}else{
				$this->fm->setMsg('msg_notify','Sorry Something Went Wrong','warning');
				$this->fm->redirect('user_dashboard.php');
			}
		}else{
			$this->fm->setMsg('msg_notify','Sorry This Request Does Not Belong To You....','warning');
			$this->fm->redirect('user_dashboard.php');
		}

	}
}

?>
