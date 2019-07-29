<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php') ;
?>


<?php

/**
 * ServiceCategory
 */
class UserCategory
{
	private $db;
    private $fm;

	function __construct(){
		$this->db=new Database();
	  	$this->fm=new Format();
	}

	public function addCategory($data){
		$errors = array();

   		$name=$this->fm->validation($data['name']);
   		$name=mysqli_real_escape_string($this->db->link,$name);

   		//Name Errors
   		if (empty($name)) {
	  		$errors['name_error'] = "Name Field Must Be Filled";
	  	}

	  	if(count($errors) == 0){
	  		$query = "INSERT INTO user_categories(name) VALUES('$name')";
	  		$result=$this->db->insert($query);
			if($result){
				$this->fm->setMsg('msg','User Category Added SuucessFully!');
				$this->fm->redirect('user_category.php');
			}else{
				$data = [
					'name' => $name,
				];
				$this->fm->setMsg('msg_notify','Something Went Wrong!!');
				$this->fm->setMsg('form_data',$data);
			}
	  	}else{
	  		$data = [
				'name' => $name,
			];
			$this->fm->setMsg('form_data',$data);
   			$this->fm->setMsg('errors',$errors);
	  	}
	}

	public function getAllCategory(){
		$query="SELECT * FROM user_categories ORDER BY id DESC";
   		$result=$this->db->select($query);
   		return $result;
	}

	public function deleteCategory($id){
		$id=$this->fm->validation($id);
       	$id=mysqli_real_escape_string($this->db->link,$id);

       	$delquery="DELETE FROM user_categories where id='$id'";
  		$deldata=$this->db->delete($delquery);
  		if($deldata){
   			$this->fm->setMsg('msg','User Category Deleted SuccessFully!!');
   			$this->fm->redirect('user_category.php');
  		}else{
			$this->fm->setMsg('msg_notify','Something Went Wrong');
   			$this->fm->redirect('user_category.php');
		}
	}

	public function categoryById($id){
		$id=$this->fm->validation($id);
       	$id=mysqli_real_escape_string($this->db->link,$id);

		$query="SELECT * FROM user_categories where id='$id'";
		$result=$this->db->select($query);

		return $result;
	}

	public function editCategory($data,$id){
		$errors = array();

   		$name=$this->fm->validation($data['name']);
   		$name=mysqli_real_escape_string($this->db->link,$name);
   		$id=$this->fm->validation($id);
   		$id=mysqli_real_escape_string($this->db->link,$id);

   		//Name Errors
   		if (empty($name)) {
	  		$errors['name_error'] = "Name Field Must Be Filled";
	  	}

	  	if(count($errors) == 0){
			$query="UPDATE user_categories
                set
                name='$name'
                WHERE id='$id'";
                $result=$this->db->update($query);
                if($result){
                	$this->fm->setMsg('msg','User Category Updated SuccessFully!!');
                	$this->fm->redirect('user_category.php');
                }else{
                	$this->fm->setMsg('msg_notiffy','Something WentWrong!!');
                	$this->fm->redirect('user_category.php');
                }
	  	}else{
	  		$this->fm->setMsg('errors',$errors);
	    	$this->fm->redirect('user_edit_category.php?id='. $id );
	  	}
	}
}

?>
