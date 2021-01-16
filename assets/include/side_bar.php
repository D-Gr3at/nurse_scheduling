<aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="home/" class="brand-link">
        <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AcumenHOSPITALS</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo 'assets/images/profile_image/'.$loggedInNurse['image']; ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="home/" class="d-block"><?php echo $loggedInNurse['first_name'] . ' ' . $loggedInNurse['last_name']; ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2" id="nav">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="home/" class="nav-link dashboard active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
              <?php
              if ($loggedInNurse['position'] === 'Nurse Leader'){
                  echo '<li class="nav-item">
                          <a href="register-nurse/" class="nav-link register-nurse">
                          <!-- <ion-icon name="add-outline"></ion-icon> -->
                            <i class="nav-icon fas fa-plus-circle"></i>
                            <p>
                              Register Nurse
                              <span class="right badge badge-danger">New</span>
                            </p>
                          </a>
                        </li>';
              }
              if ($loggedInNurse['position'] === 'Nurse Leader'){
              ?>
                  <li class="nav-item has-treeview">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Manage Nurses
                              <i class="fas fa-angle-left right"></i>
                              <span class="badge badge-info right">3</span>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="nurses_on_leave/" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Nurses On Leave</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="nurses_off_duty/" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Nurses Off-Day</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="active_nurses/" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Nurse On Duty</p>
                              </a>
                          </li>
                      </ul>
                  </li>
            <?php  } ?>
              <li class="nav-item">
                  <a href="view_roaster/" class="nav-link">
                      <!-- <ion-icon name="add-outline"></ion-icon> -->
                      <i class="nav-icon far fa-calendar-alt"></i>
                      <p>
                          Calendar
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="profile/<?php echo $loggedInNurse['nurse_id'] ?>" class="nav-link">
                      <!-- <ion-icon name="add-outline"></ion-icon> -->
                      <i class="nav-icon fas fa-user-circle"></i>
                      <p>
                          Profile
                      </p>
                  </a>
              </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

<script>
    (function() {
        const nav = document.getElementById('nav');
        const anchor = nav.getElementsByTagName('a');
        const current = window.location.pathname.split('/')[2];
        for (let i = 0; i < anchor.length; i++) {
            if(anchor[i].href.includes(current)) {
                anchor[i].classList.add('active');
            }else {
                anchor[i].classList.remove('active');
            }
        }
    })();

</script>