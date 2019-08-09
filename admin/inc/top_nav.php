<!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg bg-dark navbar-dark white scrolling-navbar">
      <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand waves-effect" href="<?php echo URLROOT ?>/admin">
          <strong class="blue-text"><?php echo APPNAME ; ?></strong>
        </a>


        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
	            <a class="nav-link waves-effect" href="index.php">Home
	            </a>
            </li>

            <li class="nav-item">
              <a class="nav-link waves-effect" target="_blank" href="<?php echo(URLROOT);?>/index.php">View Site
              </a>
            </li>
        </ul>

        <ul class="navbar-nav nav-flex-icons mr-5">
            <li class="nav-item">

                <a href="" class="nav-link waves-effect"><i class="fas fa-user"></i><?php echo Session::get('adminName'); ?></a>

            </li>
            <li class="nav-item">
              <a href="<?php echo(URLROOT);?>/admin/logout.php?action=logout" class="nav-link waves-effect" >
                <i class="fas fa-user"></i> Logout
              </a>
            </li>
        </ul>

        </div>

      </div>
    </nav>
    <!-- Navbar -->
