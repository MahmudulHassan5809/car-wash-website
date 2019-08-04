<?php
	$filepath=realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php') ;
	include_once ($filepath.'/../vendor/autoload.php') ;

	include_once 'Category.php';
?>

<?php

/**
 * Paginate
 */
class Paginate
{
	private $db;
    private $fm;

	public $current_page;
    public $items_per_page;
    public $items_total_count;

	function __construct($page=1,$items_total_count=0){
		$this->db=new Database();
	  	$this->fm=new Format();

		$this->current_page = (int)$page;
        $this->items_per_page = 2;

        $this->items_total_count = $items_total_count;

	}



	public function next(){
     	return $this->current_page + 1 ;
     }

     public function prev(){
     	return $this->current_page - 1 ;
     }

    public function page_total(){
		return ceil($this->items_total_count/$this->items_per_page) ;
	}

    public function has_prev(){
     	return $this->prev() >= 1 ? true : false ;
    }

    public function has_next(){
     	return $this->next() <= $this->page_total() ? true : false ;
    }

    public function offset(){
     	return ($this->current_page - 1)*$this->items_per_page ;
    }

    public function getAllServicesForIndex(){
    	$query  = "SELECT * FROM services ";
    	$query .= "ORDER BY date desc ";
    	$query .= "LIMIT {$this->items_per_page} ";
       	$query .= "OFFSET {$this->offset()} ";

       	$result = $this->db->select($query);
       	return $result;
    }


}


?>
