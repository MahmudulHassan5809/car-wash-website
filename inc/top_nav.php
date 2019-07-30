<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark  scrolling-navbar">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="index.php">
        <strong>Service & Wash Your Car</strong>
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
                  <a class="nav-link" href="index.php">Home
                  </a>
                </li>
                <?php if (Session::get('userLogin') == true || isset($_COOKIE['user'])): ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo URLROOT ?>/add_service.php">Add Service</a>
                    </li>

                <?php endif ?>

            </ul>

            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">

                <?php if (Session::get('userLogin') == true || isset($_COOKIE['user'])): ?>

                    <li class="nav-item">
                        <a href="<?php echo(URLROOT);?>/provider_dashboard.php" class="nav-link" title="Dashboard">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo(URLROOT);?>/logout.php?action=logout" class="nav-link" title="logout">
                            <i class="fas fa-sign-out-alt fa-lg"></i>
                        </a>
                    </li>
                <?php endif ?>


            </ul>

        </div>

    </div>
</nav>
<!-- Navbar -->