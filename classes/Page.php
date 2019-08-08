<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php') ;
?>

<?php

/**
 * Page Class
 */
class Page
{
	private $db;
    private $fm;

	function __construct(){
		$this->db=new Database();
	  	$this->fm=new Format();
	}

	public function addPage($data){
		$errors = array();

   		$title=$this->fm->validation($data['title']);
   		$title=mysqli_real_escape_string($this->db->link,$title);

   		$description=$this->fm->validation($data['description']);
       	$description=mysqli_real_escape_string($this->db->link,$description);

       	//Title Errors
   		if (empty($title)) {
	  		$errors['title_error'] = "Title Field Must Be Filled";
	  	}

	  	//Description Errors
   		if (empty($description)) {
	  		$errors['description_error'] = "Please Add A Description";
	  	}

	  	if(count($errors) == 0){
			$query = "INSERT INTO pages(title,description) VALUES('$title','$description')";
	  		$result=$this->db->insert($query);
			if($result){
				$this->fm->setMsg('msg','Page Added SuucessFully!');
				$this->fm->redirect('page.php');
			}else{
				$data = [
					'title' => $title,
					'description' => $description
				];
				$this->fm->setMsg('msg_notify','Something Went Wrong!!');
				$this->fm->setMsg('form_data',$data);
			}
	  	}else{
	  		$data = [
				'title' => $title,
				'description' => $description,
			];

			$this->fm->setMsg('form_data',$data);
   			$this->fm->setMsg('errors',$errors);
	  	}
	}

	public function getAllPage(){
		$query = "SELECT * FROM pages ORDER BY id DESC";
		$result = $this->db->select($query);
		return $result;
	}

	public function pageById($id){
		$id = $this->fm->validation($id);
       	$id = mysqli_real_escape_string($this->db->link,$id);

       	$query = "SELECT * FROM pages WHERE id='$id' ";
		$result = $this->db->select($query);
		return $result;
	}

	public function pageTitle($id){
		$id = $this->fm->validation($id);
       	$id = mysqli_real_escape_string($this->db->link,$id);

       	$query = "SELECT title FROM pages WHERE id='$id' ";
		$result = $this->db->select($query);
		if($result){
			while ($value = $result->fetch_assoc()) {
				return $value['title'];

			}
		}
	}


	public function editPage($data,$id){
		$errors = array();

		$id = $this->fm->validation($id);
       	$id = mysqli_real_escape_string($this->db->link,$id);

       	$title=$this->fm->validation($data['title']);
   		$title=mysqli_real_escape_string($this->db->link,$title);

   		$description=$this->fm->validation($data['description']);
       	$description=mysqli_real_escape_string($this->db->link,$description);

       	//Title Errors
   		if (empty($title)) {
	  		$errors['title_error'] = "Title Field Must Be Filled";
	  	}

	  	//Description Errors
   		if (empty($description)) {
	  		$errors['description_error'] = "Please Add A Description";
	  	}

	  	if(count($errors) == 0){
			$query = "UPDATE pages
					SET
					title = '$title',
					description = '$description'
					WHERE id='$id'";
	  		$result=$this->db->insert($query);
			if($result){
				$this->fm->setMsg('msg','Page Updated SuucessFully!');
				$this->fm->redirect('page.php');
			}else{
				$data = [
					'title' => $title,
					'description' => $description
				];
				$this->fm->setMsg('msg_notify','Something Went Wrong!!');
				$this->fm->setMsg('form_data',$data);
			}
	  	}else{
	  		$data = [
				'title' => $title,
				'description' => $description,
			];

			$this->fm->setMsg('form_data',$data);
   			$this->fm->setMsg('errors',$errors);
	  	}
	}

	public function deletePage($id){
		$id=$this->fm->validation($id);
       	$id=mysqli_real_escape_string($this->db->link,$id);

       	$delquery="DELETE FROM pages where id='$id'";
  		$deldata=$this->db->delete($delquery);
  		if($deldata){
   			$this->fm->setMsg('msg','Page Deleted SuccessFully!!');
   			$this->fm->redirect('page.php');
  		}else{
			$this->fm->setMsg('msg_notify','Something Went Wrong');
   			$this->fm->redirect('page.php');
		}
	}


}

?>
