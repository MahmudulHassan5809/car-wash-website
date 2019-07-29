<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php') ;

	include_once 'Category.php';
?>


<?php
	/**
	 * Service Class For MaintainServie
	 */
	class Service
	{
		private $db;
    	private $fm;
    	private $ct;

		function __construct(){
			$this->db=new Database();
	  		$this->fm=new Format();
		}

		public function addService($data,$file){
			$ct = new Category();
			if($ct->getAllCategory() === false){
				$this->fm->setMsg('msg_notify','There Is No Category Please Add Some Category');
				$this->fm->redirect($data['redirect']);
			}

			$errors = array();

	   		$name=$this->fm->validation($data['name']);
       		$name=mysqli_real_escape_string($this->db->link,$name);

       		$price=$this->fm->validation($data['price']);
       		$price=mysqli_real_escape_string($this->db->link,$price);

       		$description=$this->fm->validation($data['description']);
       		$description=mysqli_real_escape_string($this->db->link,$description);

       		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "upload/".$unique_image;

		    //File Errors
       		if (empty($file_name)) {
		  		$errors['file_error'] = "Please Upload An Image";
		  	}else if ($file_size >1048567) {
	       		$errors['file_error'] = 'Image Size should be less then 1MB!';
	       	}else if(in_array($file_ext, $permited) === false){
	       		$errors['file_error'] = 'You can upload only'.implode(', ', $permited);
	       	}

	       	//Name Errors
       		if (empty($name)) {
		  		$errors['name_error'] = "Name Field Must Be Filled";
		  	}

		  	//Price Errors
       		if (empty($price)) {
		  		$errors['price_error'] = "Price Field Must Be Filled";
		  	}else if(!filter_var($price, FILTER_VALIDATE_INT)){
		    	$errors['price_error'] = "Price Field Must Be Integer";
		    }

		    //Description Errors
       		if (empty($description)) {
		  		$errors['description_error'] = "Please Add A Description";
		  	}

			if(count($errors) == 0){
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO services(name,description,price,image)
						VALUES('$name','$description','$price','$uploaded_image')";
				$result=$this->db->insert($query);
				if($result){
					$this->fm->setMsg('msg','Service Added SuucessFully!');
					$this->fm->redirect('service.php');
				}else{
					$data = [
						'name' => $name,
						'price' => $price,
						'description' => $description,
					];
					$this->fm->setMsg('msg_notify','Something Went Wrong!!');
					$this->fm->setMsg('form_data',$data);
				}
		    }else{
		    	$data = [
					'name' => $name,
					'price' => $price,
					'description' => $description,
				];

				$this->fm->setMsg('form_data',$data);
       			$this->fm->setMsg('errors',$errors);
		    }
		}


	public function getAllService(){
		$query="SELECT * FROM services ORDER BY date DESC";
   		$result=$this->db->select($query);
   		return $result;
	}


	public function deleteService($id){
		$id=$this->fm->validation($id);
       	$id=mysqli_real_escape_string($this->db->link,$id);

		$query="SELECT * FROM services where id='$id'";
		$getdata=$this->db->select($query);
  		if($getdata){
  			while ($value=$getdata->fetch_assoc()) {
		    	$dellink=$value['image'];
		    	unlink($dellink);
      		}
    	}

  		$delquery="DELETE FROM services where id='$id'";
  		$deldata=$this->db->delete($delquery);
  		if($deldata){
   			$this->fm->setMsg('msg','Service Deleted SuccessFully!!');
   			$this->fm->redirect('service.php');
  		}else{
			$this->fm->setMsg('msg_notify','Something Went Wrong');
   			$this->fm->redirect('service.php');
		}
	}


	public function serviceById($id){
		$id=$this->fm->validation($id);
       	$id=mysqli_real_escape_string($this->db->link,$id);

		$query="SELECT * FROM services where id='$id'";
		$result=$this->db->select($query);

		return $result;
	}

	public function editService($data,$file,$id){
		$errors = array();

   		$name=$this->fm->validation($data['name']);
   		$name=mysqli_real_escape_string($this->db->link,$name);

   		$price=$this->fm->validation($data['price']);
   		$price=mysqli_real_escape_string($this->db->link,$price);

   		$description=$this->fm->validation($data['description']);
   		$description=mysqli_real_escape_string($this->db->link,$description);

   		$id=$this->fm->validation($id);
   		$id=mysqli_real_escape_string($this->db->link,$id);

   		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "upload/".$unique_image;

		//Name Errors
   		if (empty($name)) {
	  		$errors['name_error'] = "Name Field Must Be Filled";
	  	}

	  	//Price Errors
   		if (empty($price)) {
	  		$errors['price_error'] = "Price Field Must Be Filled";
	  	}else if(!filter_var($price, FILTER_VALIDATE_INT)){
	    	$errors['price_error'] = "Price Field Must Be Integer";
	    }

	    //Description Errors
   		if (empty($description)) {
	  		$errors['description_error'] = "Please Add A Description";
	  	}

	    if(!empty($file_name)){
			//File Errors
	   		if (empty($file_name)) {
		  		$errors['file_error'] = "Please Upload An Image";
		  	}else if ($file_size >1048567) {
	       		$errors['file_error'] = 'Image Size should be less then 1MB!';
	       	}else if(in_array($file_ext, $permited) === false){
	       		$errors['file_error'] = 'You can upload only'.implode(', ', $permited);
	       	}
	    }

	    if(count($errors) == 0){
			if(!empty($file_name)){
				$query="SELECT image FROM services where id='$id'";
				$getdata=$this->db->select($query);
		  		if($getdata){
		  			while ($value=$getdata->fetch_assoc()) {
				    	$dellink=$value['image'];
				    	unlink($dellink);
		      		}
		    	}
		    	move_uploaded_file($file_temp, $uploaded_image);
				$query="UPDATE services
                    set
                    name='$name',
                    description='$description',
                    price='$price',
                    image='$uploaded_image'
                    WHERE id='$id'";
                $result=$this->db->update($query);
                if($result){
                	$this->fm->setMsg('msg','Service Updated SuccessFully!!');
                	$this->fm->redirect('service.php');
                }else{
                	$this->fm->setMsg('msg_notiffy','Something WentWrong!!');
                	$this->fm->redirect('service.php');
                }
			}else{
				$query="UPDATE services
                    set
                    name='$name',
                    description='$description',
                    price='$price'
                    WHERE id='$id'";
                $result=$this->db->update($query);
                if($result){
                	$this->fm->setMsg('msg','Service Updated SuccessFully!!');
                	$this->fm->redirect('service.php');
                }else{
                	$this->fm->setMsg('msg_notiffy','Something WentWrong!!');
                	$this->fm->redirect('service.php');
                }
			}
	    }else{
	    	$this->fm->setMsg('errors',$errors);
	    	$this->fm->redirect('edit_service.php?id='. $id );
	    }


	}


	}// class End


?>
