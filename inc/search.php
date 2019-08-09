<style type="text/css">
	.searchbar{
    margin-bottom: auto;
    margin-top: auto;
    height: 60px;
    background-color: #353b48;
    border-radius: 30px;
    padding: 10px;
    }

    .search_input{
    color: white;
    border: 0;
    outline: 0;
    background: none;
    width: 0;
    caret-color:transparent;
    line-height: 40px;
    transition: width 0.4s linear;
    }

    .searchbar:hover > .search_input{
    padding: 0 10px;
    width: 450px;
    caret-color:red;
    transition: width 0.4s linear;
    }

    .searchbar:hover > .search_icon{
    background: white;
    color: #e74c3c;
    }

    .search_icon{
    height: 40px;
    width: 40px;
    float: right;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color:white;
    }

    button, input[type="submit"]{
	background: none;
	color: inherit;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;
}
</style>




<div class="container h-100 mt-5">
      <div class="d-flex justify-content-center h-100">
        <form action="search.php" method="POST">
        	<div class="searchbar">
				<input class="search_input" type="text" name="q" placeholder="Search...">

				<button type="submit" name="search" class="search_icon"><i class="fas fa-search"></i></button>

	        </div>
        </form>
      </div>
</div>
