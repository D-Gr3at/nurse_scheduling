<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="home/" class="nav-link">Home</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto d-none d-lg-block">
    <li class="nav-item dropdown">
      <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
      <?php echo $loggedInNurse['first_name'] . ' ' . $loggedInNurse['last_name']; ?></a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow text-center">
            <li><a href="#" class="dropdown-item">Profile </a></li>
            <li><a href="#" class="dropdown-item">Settings</a></li>

            <li class="dropdown-divider"></li>

            <li>
                <a href="#" class="btn btn-danger btn-block">
                    Logout
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fas fa-th-large"></i></a>
    </li>
  </ul>
</nav>
