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

        $title = str_replace('_', ' ', $title);

        $title_array = explode(" ", $title);

        if(count($title_array) < 2){
            if($title == 'index') {
               $title = 'Home';
            }else{
                $title = ucfirst($title);
            }
         }else{
             $title = ucfirst($title_array[0]) . ' ' .ucfirst($title_array[1]);
        }

        return $title;
    }


}
?>

