<?php
/**
 * Format Class For Creating Helpers Method
 */
class Format
{

	public function formatDate($date){
        return date('F j, Y, g:i a', strtotime($date));
    }

    public function redirect($location){
        header("Location: {$location}");
        exit;
    }

    public function setMsg($name,$value,$class='success'){
    	if (is_array($value)) {
    		$_SESSION[$name] = $value;
    	}else{
    		$_SESSION[$name] = "<div class='alert alert-$class text-center'>$value</div>";
    	}
    }

    public function getMsg($name)
    {
    	if (isset($_SESSION[$name])) {
    		$session = $_SESSION[$name];
    		unset($_SESSION[$name]);
    		return $session;
    	}
    }

    public function textShorten($text, $limit = 400){
        $text = $text. " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text.".....";
        return $text;
    }

    public function validation($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function title(){
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');
        //$title = str_replace('_', ' ', $title);
        if ($title == 'login') {
           $title = 'Login';
        }elseif ($title == 'index') {
           $title = 'Home';
        }elseif ($title == 'add_service') {
           $title = 'Add Service';
        }elseif ($title == 'add_category') {
           $title = 'Add Category';
        }
        elseif ($title == 'user_add_category') {
           $title = 'Add User Category';
        }elseif ($title == 'user_category') {
           $title = 'User Category';
        }elseif ($title == 'user_edit_category') {
           $title = 'Edit User Category';
        }elseif ($title == 'forget_password') {
           $title = 'Forget Password';
        }elseif ($title == 'reset_password') {
           $title = 'Reset Password';
        }
        return $title = ucfirst($title);
    }


}
?>

