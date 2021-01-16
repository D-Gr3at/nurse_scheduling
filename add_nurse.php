<?php
include_once('assets/include/session_header.php');
include_once('assets/include/utils.php');
$utils = new Utils();
$banks = $utils->getBanks();
$wards = $utils->getWards();
$degrees = $utils->degree();
$positions = $utils->positions();
$licenseLetters = $utils->licenseLetter();
$title = 'Register Nurse';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <base href="/nurse/">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>AcumenHOSPITALS | <?php echo $title; ?></title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!--    Form Wizard -->
  <link rel="stylesheet" href="assets/dist/css/smart_wizard_all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Navbar -->
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
          <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                  <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                      <?php echo $loggedInNurse['first_name'] . ' ' . $loggedInNurse['last_name']; ?></a>
                  <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow text-center">
                      <li><a href="profile/<?php echo $loggedInNurse['nurse_id']; ?>" class="dropdown-item">Profile </a></li>
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
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include_once('assets/include/side_bar.php') ?>
    

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <!-- /.content-header -->
        <?php include_once('assets/include/content_header.php'); ?>

      <!-- Main content -->
      <section class="content height-80">
        <div class="container-fluid">
            <div class="card card-widget card-widget-user" >
                <div class="row">
                    <div class="col-12">

                    </div>
                </div>
                <form id="addNurse" enctype="multipart/form-data">
                    <input type="hidden" name="op" value="Nurse.saveNurseRecord">
                    <div class="container my-4" id="smartwizard">
                        <ul class="nav d-none d-lg-flex">
                            <li>
                                <a class="nav-link" href="#step-1">
                                    <i class="ion ion-ios-person"></i>
                                    <strong>Step 1</strong><br>
                                    Personal Information
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="#step-2">
                                    <i class="ion ion-document-text"></i>
                                    <strong>Step 2</strong><br>
                                    Qualifications
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="#step-3">
                                    <i class="ion ion-laptop"></i>
                                    <strong>Step 3</strong><br>
                                    Job Information
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="#step-4">
                                    <i class="ion ion-android-done-all"></i>
                                    <strong>Step 4</strong><br>
                                    Account and Other Details
                                    Step 4
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="step-1" class="tab-pane" role="tabpanel">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <h3 class="text-decoration-underline">Personal Information</h3>
                                        </div>
                                        <div class="col-12 col-md-4 my-2">
                                            <input class="form-control" type="text" name="firstName" placeholder="First Name">
                                        </div>
                                        <div class="col-12 col-md-4 my-2">
                                            <input class="form-control" type="text" name="lastName" placeholder="Last Name">
                                        </div>
                                        <div class="col-12 col-md-4 my-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email" class="form-control" name="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="phoneNumber" placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                      </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="dob" id="reservation">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <select class="form-control" name="gender">
                                                    <option value="">::SELECT GENDER::</option>
                                                    <option value="MALE">MALE</option>
                                                    <option VALUE="FEMALE">FEMALE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 my-2">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="3" cols="3" name="address" placeholder="Enter Address..."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-2" class="tab-pane" role="tabpanel">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <h3 class="text-decoration-underline">Academic Qualification</h3>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input type="text" class="form-control" name="higherInstitution" placeholder="Higher Institution Attended">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                  <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                  </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="rangeOfStudy" id="startDate">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <div class="">
                                                    <input type="text" class="form-control" name="fieldOfStudy" placeholder="Field of Study/Major">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <select class="form-control select2" name="degree" style="width: 100%;">
                                                    <?php
                                                        foreach ($degrees as $degree){
                                                            echo '<option value="'.$degree.'">'.$degree.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <select class="form-control select2" name="license" style="width: 100%;">
                                                    <?php
                                                    foreach ($licenseLetters as $letter){
                                                        echo '<option value="'.$letter.'">'.$letter.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="certificate" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Upload Certificate</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-3" class="tab-pane" role="tabpanel">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <h3 class="text-decoration-underline">Job Information</h3>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <select class="form-control select2" name="position" style="width: 100%;">
                                                    <?php
                                                    foreach ($positions as $position){
                                                        echo '<option value="'.$position.'">'.$position.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        &#8358
                                                      </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="salary" placeholder="Gross Income">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <select class="form-control select2" name="ward" style="width: 100%;" data-placeholder="Ward">
                                                    <?php
                                                    foreach ($wards as $ward){
                                                        echo '<option value="'.$ward.'">'.$ward.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="passport" id="customFile1">
                                                    <label class="custom-file-label" for="customFile1">Upload Passport</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="step-4" class="tab-pane" role="tabpanel">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <h3 class="text-decoration-underline">Bank Details</h3>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select class="form-control select2" name="bank" style="width: 100%;" data-placeholder="Ward">
                                                        <?php
                                                        foreach ($banks as $bank){
                                                            echo '<option value="'.$bank.'">'.$bank.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <div class="">
                                                    <input type="text" class="form-control" name="accountNumber" placeholder="Account Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="sortCode" placeholder="Sort Code">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php include_once('assets/include/footer.php'); ?>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!--  Form Wizard -->
  <script src="assets/dist/js/jquery.smartWizard.min.js"></script>
  <script>
      // SmartWizard initialize
      $('#smartwizard').smartWizard({
          selected: 0, // Initial selected step, 0 = first step
          theme: 'dots', // theme for the wizard, related css need to include for other than default theme
          justified: true, // Nav menu justification. true/false
          darkMode:false, // Enable/disable Dark Mode if the theme supports. true/false
          autoAdjustHeight: true, // Automatically adjust content height
          cycleSteps: false, // Allows to cycle the navigation of steps
          backButtonSupport: true, // Enable the back button support
          enableURLhash: false, // Enable selection of the step based on url hash
          transition: {
              animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
              speed: '400', // Transion animation speed
              easing:'' // Transition animation easing. Not supported without a jQuery easing plugin
          },
          toolbarSettings: {
              toolbarPosition: 'bottom', // none, top, bottom, both
              toolbarButtonPosition: 'right', // left, right, center
              showNextButton: true, // show/hide a Next button
              showPreviousButton: true, // show/hide a Previous button
              toolbarExtraButtons: [
                  $('<button></button>').text('Finish')
                      .attr('type', 'submit')
                      .attr('id', 'addNurseButton')
                      .addClass('btn btn-success sw-btn-finish')
                      .css({'background-color':'#28a745 !important'})
                      .on('click', function(){

                      }),
                  $('<button></button>').text('Cancel')
                      .addClass('btn btn-danger sw-btn-cancel')
                      .css({'background-color': '#dc3545 !important'})
                      .on('click', function(){
                          location.reload();
                      })] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
          },
          anchorSettings: {
              anchorClickable: true, // Enable/Disable anchor navigation
              enableAllAnchors: false, // Activates all anchors clickable all times
              markDoneStep: true, // Add done state on navigation
              markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
              removeDoneStepOnNavigateBack: false, // While navigate back done step after active step will be cleared
              enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
          },
          keyboardSettings: {
              keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
              keyLeft: [37], // Left key code
              keyRight: [39] // Right key code
          },
          lang: { // Language variables for button
              next: 'Next',
              previous: 'Previous'
          },
          disabledSteps: [], // Array Steps disabled
          errorSteps: [], // Highlight step with errors
          hiddenSteps: [] // Hidden steps
      });

      $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
          if(stepPosition === 'last'){
              $(".sw-btn-next").hide();
              $(".sw-btn-finish").show();
              $(".sw-btn-cancel").show();
          }else{
              $(".sw-btn-finish").hide();
              $(".sw-btn-cancel").hide();
              $(".sw-btn-next").show();
          }
      });
  </script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--  select2 -->
  <script src="assets/plugins/select2/js/select2.full.min.js"></script>
  <script>
      $('.select2').select2();
  </script>
  <!-- bs-custom-file-input -->
  <script src="assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <script>
      $(function () {
          bsCustomFileInput.init();
      });
  </script>
  <!-- ChartJS -->
  <script src="assets/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="assets/plugins/sparklines/sparkline.js"></script>
  <!-- date-range-picker -->
  <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- JQVMap -->
<!--  <script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>-->
<!--  <script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>-->
  <!-- jQuery Knob Chart -->
  <script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="assets/plugins/moment/moment.min.js"></script>
  <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
  <script>
      //Date range picker
      $('#reservation').daterangepicker({
          'alwaysShowCalendars': true,
          'showDropdowns': true,
          'singleDatePicker': true
      });

      $('#startDate').daterangepicker({
          'showDropdowns': true,
          "linkedCalendars": false,
          "opens": "center"
      });
  </script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="assets/dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="assets/dist/js/demo.js"></script>
  <script src="assets/dist/js/main.js"></script>
</body>

<!-- Mirrored from adminlte.io/themes/dev/AdminLTE/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Jan 2021 19:48:00 GMT -->

</html>