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
				$this->fm->setMsg('msg_notify','There Is No Category Avialable');
				$this->fm->redirect($data['redirect']);
			}

			$errors = array();

	   		$name=$this->fm->validation($data['name']);
       		$name=mysqli_real_escape_string($this->db->link,$name);

       		$category_id=$this->fm->validation($data['category_id']);
       		$category_id=mysqli_real_escape_string($this->db->link,$category_id);

       		$location=$this->fm->validation($data['location']);
       		$location=mysqli_real_escape_string($this->db->link,$location);

       		$price=$this->fm->validation($data['price']);
       		$price=mysqli_real_escape_string($this->db->link,$price);

       		$description=$this->fm->validation($data['description']);
       		$description=mysqli_real_escape_string($this->db->link,$description);

       		$phone=$this->fm->validation($data['phone']);
       		$phone=mysqli_real_escape_string($this->db->link,$phone);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
		    $file_name = $file['image']['name'];
		    $file_size = $file['image']['size'];
		    $file_temp = $file['image']['tmp_name'];

		    $div = explode('.', $file_name);
		    $file_ext = strtolower(end($div));
		    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "admin/upload/".$unique_image;


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

		  	//Name Errors
       		if (empty($phone)) {
		  		$errors['phone_error'] = "Please Provide A Phone Number";
		  	}

		  	//Location Errors
       		if (empty($location)) {
		  		$errors['location_error'] = "Location Field Must Be Filled";
		  	}

		  	//Category Errors
       		if (empty($category_id)) {
		  		$errors['category_error'] = "Please Select A Category";
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


		  	if (isset($_COOKIE['user'])) {
				$data = unserialize($_COOKIE['user']);
				$id = $data['id'];
			}
			$user_id = (Session::get('userId') !== false) ? Session::get('userId') : $id;


			if(count($errors) == 0){
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO services(name,location,phone,category_id,user_id,description,price,image)
						VALUES('$name','$location','$phone','$category_id','$user_id','$description','$price','$unique_image')";
				$result=$this->db->insert($query);
				if($result){
					$this->fm->setMsg('msg','Service Added SuucessFully!');
					$this->fm->redirect('index.php');
				}else{
					$data = [
						'name' => $name,
						'price' => $price,
						'description' => $description,
						'location' => $location,
						'phone' => $phone
					];
					$this->fm->setMsg('msg_notify','Something Went Wrong!!');
					$this->fm->setMsg('form_data',$data);
				}
		    }else{
		    	$data = [
					'name' => $name,
					'price' => $price,
					'description' => $description,
					'location' => $location,
					'phone' => $phone
				];

				$this->fm->setMsg('form_data',$data);
       			$this->fm->setMsg('errors',$errors);
		    }
		}


		public function getAllService(){
			$query="SELECT services.*,
					categories.name as cat_name,
					categories.id as cat_id
					FROM services
					INNER JOIN categories
					on services.category_id = categories.id
					order by services.id desc";
	   		$result=$this->db->select($query);
	   		return $result;
		}

		public function getServiceById($id){
			$id=$this->fm->validation($id);
       		$id=mysqli_real_escape_string($this->db->link,$id);
       		$query="SELECT services.*,
					categories.name as cat_name,
					categories.id as cat_id,
					users.full_name as user_name,
					users.id as user_id
					FROM services
					INNER JOIN categories
					on services.category_id = categories.id
					INNER JOIN users
					on services.user_id = users.id
					WHERE services.id = '$id'
					order by services.id desc";
	   		$result=$this->db->select($query);
	   		return $result;
		}

		public function getAllServiceByProvider(){
			if (isset($_COOKIE['user'])) {
				$data = unserialize($_COOKIE['user']);
				$id = $data['id'];
			}
			$user_id = (Session::get('userId') !== false) ? Session::get('userId') : $id;

			$query="SELECT services.*,
					categories.name as cat_name,
					categories.id as cat_id
					FROM services
					INNER JOIN categories
					on services.category_id = categories.id
					WHERE services.user_id = '$user_id'
					order by services.id desc";
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
			    	unlink('admin/upload/' . $dellink);
	      		}
	    	}

	  		$delquery="DELETE FROM services where id='$id'";
	  		$deldata=$this->db->delete($delquery);
	  		if($deldata){
	   			$this->fm->setMsg('msg','Service Deleted SuccessFully!!');
	   			$this->fm->redirect('index.php');
	  		}else{
				$this->fm->setMsg('msg_notify','Something Went Wrong');
	   			$this->fm->redirect('index.php');
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

   		$location=$this->fm->validation($data['location']);
   		$location=mysqli_real_escape_string($this->db->link,$location);

   		$phone=$this->fm->validation($data['phone']);
   		$phone=mysqli_real_escape_string($this->db->link,$phone);

   		$category_id=$this->fm->validation($data['category_id']);
   		$category_id=mysqli_real_escape_string($this->db->link,$category_id);

   		$price=$this->fm->validation($data['price']);
   		$price=mysqli_real_escape_string($this->db->link,$price);

   		$description=$this->fm->validation($data['description']);
   		$description=mysqli_real_escape_string($this->db->link,$description);

   		$id=$this->fm->validation($id);
   		$id=mysqli_real_escape_string($this->db->link,$id);


   		if (isset($_COOKIE['user'])) {
			$data = unserialize($_COOKIE['user']);
			$userId = $data['id'];
		}
		$user_id = (Session::get('userId') !== false) ? Session::get('userId') : $userId;

   		$permited  = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "admin/upload/".$unique_image;

		//Name Errors
   		if (empty($name)) {
	  		$errors['name_error'] = "Name Field Must Be Filled";
	  	}

	  	//Location Errors
   		if (empty($location)) {
	  		$errors['location_error'] = "Please Add A Service Location";
	  	}

	  	//Phone Errors
   		if (empty($phone)) {
	  		$errors['phone_error'] = "Please Add A Service Phone Number";
	  	}

	  	//Category Errors
   		if (empty($category_id)) {
	  		$errors['category_error'] = "Please Add A Service Category";
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
				    	unlink('admin/upload' . $dellink);
		      		}
		    	}
		    	move_uploaded_file($file_temp, $uploaded_image);
				$query="UPDATE services
                    set
                    name='$name',
                    location='$location',
                    phone='$phone',
                    category_id='$category_id',
                    description='$description',
                    price='$price',
                    image='$unique_image'
                    WHERE id='$id' AND user_id='$user_id'";
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
                    location='$location',
                    phone='$phone',
                    category_id='$category_id',
                    user_id='$user_id',
                    description='$description',
                    price='$price'
                    WHERE id='$id' AND user_id='$user_id'";
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
