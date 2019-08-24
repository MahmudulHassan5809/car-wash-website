<?php

	require 'vendor/autoload.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;



	require 'inc/inc.php';
?>


<?php

	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];
	$subject = $_POST['subject'];
	header('Content-Type: application/json');
	if ($name === ''){
		print json_encode(array('message' => 'Name cannot be empty', 'code' => 0));
		exit();
	}
	if ($email === ''){
		print json_encode(array('message' => 'Email cannot be empty', 'code' => 0));
		exit();
	} else {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			print json_encode(array('message' => 'Email format invalid.', 'code' => 0));
			exit();
		}
	}
	if ($phone === ''){
		print json_encode(array('message' => 'Phone cannot be empty', 'code' => 0));
		exit();
	}
	if ($subject === ''){
		print json_encode(array('message' => 'Subject cannot be empty', 'code' => 0));
		exit();
	}
	if ($message === ''){
		print json_encode(array('message' => 'Message cannot be empty', 'code' => 0));
		exit();
	}


    try{
        $mail = new PHPMailer(true);
        //$mail->SMTPDebug = 2;
        $mail->SMTPSecure = false;
        $mail->SMTPAutoTLS = false;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = USERNAME;
        $mail->Password = PASSWORD;
        $mail->From = $email;
        $mail->FromName = $name;
        $mail->SMTPSecure = 'tls';;
        $mail->Port = 587;
        $mail->SMTPOptions = array(
        'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );



        $mail->addAddress(USERNAME, '');

        $content  =" <b> NAME :</b>  $name "."<br>";
        $content .=" <b> NAME :</b>  $subject "."<br>";
	    $content .=" <b> EMAIL :</b> $email "."<br>";
	    $content .=" <b> MOBILE :</b> $phone "."<br>";
	    $content .=" <b> MESSAGE :</b> $message "."<br>";
		$result = $cm->sendMessage($_POST);
		if($result){
			$mail->MsgHTML($content);

	        $mail->Send();

	        print json_encode(array('message' => 'Email successfully sent!', 'code' => 1));
	        exit();
		}else{
			print json_encode(array('message' => 'Sorry Something Went Wrong', 'code' => 1));
	        exit();
		}
    } catch(Exception $e){
        // Something went bad
        die("Error!");
    }




?>
