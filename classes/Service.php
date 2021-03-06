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

       		$area=$this->fm->validation($data['area']);
       		$area=mysqli_real_escape_string($this->db->link,$area);

       		$area = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($area))));

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

		  	//Area Errors
       		if (empty($area)) {
		  		$errors['area_error'] = "Area Field Must Be Filled";
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
				$query = "INSERT INTO services(name,location,phone,category_id,user_id,description,price,image,area)
						VALUES('$name','$location','$phone','$category_id','$user_id','$description','$price','$unique_image','$area')";
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


		public function getAllServiceForIndex(){
			$query="SELECT * FROM services
					ORDER BY date DESC
					";

			$result = $this->db->select($query);

			return $result;
		}

		public function items_total_count(){
			$query = "SELECT COUNT(*) FROM services";
			$result = $this->db->select($query);
			$row = mysqli_fetch_array($result);
			return array_shift($row);

		}

		public function getAllServiceForAdmin(){
			$query="SELECT services.*,
					services.id as service_id,
					services.phone as service_phone,
					categories.name as cat_name,
					categories.id as cat_id,
					users.full_name as provider_name,
					users.id as provider_id
					FROM services
					INNER JOIN categories
					on services.category_id = categories.id
					INNER JOIN users
					on services.user_id = users.id
					order by services.id desc";
	   		$result=$this->db->select($query);
	   		return $result;
		}

		public function getServiceById($id){
			$id=$this->fm->validation($id);
       		$id=mysqli_real_escape_string($this->db->link,$id);
       		$query="SELECT services.*,
       				services.user_id as provider_id,
					categories.name as cat_name,
					categories.id as cat_id,
					users.full_name as user_name,
					users.email as email,
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

		public function getAllServiceByProvider($id = null){
			if ($id == null) {
				if (isset($_COOKIE['user'])) {
					$data = unserialize($_COOKIE['user']);
					$id = $data['id'];
				}
				$user_id = (Session::get('userId') !== false) ? Session::get('userId') : $id;
			}else{
				$user_id=$this->fm->validation($id);
       			$user_id=mysqli_real_escape_string($this->db->link,$user_id);
			}

			$query="SELECT services.*,
					services.id as service_id,
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


		public function allUsers(){
			$query="SELECT users.*,
					users.id as user_id,
					user_categories.name as user_type
					FROM users
					INNER JOIN user_categories
					on users.user_type = user_categories.id
					order by users.id desc";
	   		$result=$this->db->select($query);
	   		return $result;
		}


		public function deleteService($id , $action){
			$id=$this->fm->validation($id);
	       	$id=mysqli_real_escape_string($this->db->link,$id);

	       	$action=$this->fm->validation($action);
	       	$action=mysqli_real_escape_string($this->db->link,$action);

			$query="SELECT * FROM services where id='$id'";
			$getdata=$this->db->select($query);
	  		if($getdata){
	  			while ($value=$getdata->fetch_assoc()) {
			    	$dellink=$value['image'];
			    	if($action == 'admin'){
			    		unlink('upload/' . $dellink);
			    	}else{
			    		unlink('admin/upload/' . $dellink);
			    	}
	      		}
	    	}

	  		$delquery="DELETE FROM services where id='$id'";
	  		$deldata=$this->db->delete($delquery);
	  		if($deldata){
	   			$this->fm->setMsg('msg','Service Deleted SuccessFully!!');
	   			if($action == 'admin'){
		    		$this->fm->redirect('service.php');
		    	}else{
		    		$this->fm->redirect('provider_password.php');
		    	}

	  		}else{
				$this->fm->setMsg('msg_notify','Something Went Wrong');
	   			if($action == 'admin'){
		    		$this->fm->redirect('service.php');
		    	}else{
		    		$this->fm->redirect('provider_password.php');
		    	}
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

	   		$area=$this->fm->validation($data['area']);
	   		$area=mysqli_real_escape_string($this->db->link,$area);

	   		$area = str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($area))));

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

		  	//Area Errors
	   		if (empty($area)) {
		  		$errors['larea_error'] = "Please Add A Service Area";
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
					    	unlink('admin/upload/' . $dellink);
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
	                    image='$unique_image',
	                    area='$area'
	                    WHERE id='$id' AND user_id='$user_id'";
	                $result=$this->db->update($query);
	                if($result){
	                	$this->fm->setMsg('msg','Service Updated SuccessFully!!');
	                	$this->fm->redirect('edit_service.php?id='. $id );
	                }else{
	                	$this->fm->setMsg('msg_notiffy','Something WentWrong!!');
	                	$this->fm->redirect('edit_service.php?id='. $id );
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
	                    price='$price',
	                    area='$area'
	                    WHERE id='$id' AND user_id='$user_id'";
	                $result=$this->db->update($query);
	                if($result){
	                	$this->fm->setMsg('msg','Service Updated SuccessFully!!');
	                	$this->fm->redirect('edit_service.php?id='. $id );
	                }else{
	                	$this->fm->setMsg('msg_notify','Something WentWrong!!');
	                	$this->fm->redirect('edit_service.php?id='. $id );
	                }
				}
		    }else{
		    	$this->fm->setMsg('errors',$errors);
		    	$this->fm->redirect('edit_service.php?id='. $id );
		    }


		}


		public function editServiceType($id){
			$id=$this->fm->validation($id);
		    $id=mysqli_real_escape_string($this->db->link,$id);

		    $query = "UPDATE services SET
		    		is_active = 1 - is_active
		    		WHERE id='$id'";
		   	$result = $this->db->update($query);
		   	if($result){
				$this->fm->setMsg('msg_notify','Service Updated!!');
	            $this->fm->redirect('service.php');
		   	}else{
				$this->fm->setMsg('msg_notify','Something WentWrong!!');
	            $this->fm->redirect('service.php');
		   	}
		}


		public function serviceByCategory($categoryId){
			$categoryId=$this->fm->validation($categoryId);
		    $categoryId=mysqli_real_escape_string($this->db->link,$categoryId);

			$query="SELECT
	       				services.id as service_id,
						services.image as image
						FROM services
						WHERE services.category_id = '$categoryId'
						ORDER BY RAND() LIMIT 4";
			$result=$this->db->select($query);
			return $result;
		}


		public function getAllArea(){
			$query = "SELECT DISTINCT area FROM services";
			$result = $this->db->select($query);
			return $result;
		}


		public function searchService($data){
			$q=$this->fm->validation($data['q']);
       		$q=mysqli_real_escape_string($this->db->link,$q);

       		$area=$this->fm->validation($data['area']);
       		$area=mysqli_real_escape_string($this->db->link,$area);

       		$query = "";

       		if(!empty($q)){//if keyword set goes here
				$query = "SELECT * FROM services WHERE name LIKE '%$q%' OR description LIKE '%$q%' OR price LIKE '%$q%' ";
				if(isset($area)){
				 $query .= "AND area='$area'";
				}

			}else if (!empty($area)){
				$query = "SELECT * FROM services WHERE area='$area'";

			}

       		$result = $this->db->select($query);
       		return $result;
		}


		public function totalServiceProvider(){
			$query = "SELECT count(1) FROM users WHERE user_type=1";
			$result = $this->db->select($query);
			$result = mysqli_fetch_array($result);
			return $result[0];
		}

		public function totalServices(){
			$query = "SELECT count(1) FROM services";
			$result = $this->db->select($query);
			$result = mysqli_fetch_array($result);
			return $result[0];
		}


		public function totalUsers(){
			$query = "SELECT count(1) FROM users";
			$result = $this->db->select($query);
			$result = mysqli_fetch_array($result);
			return $result[0];
		}


	}// class End


?>
