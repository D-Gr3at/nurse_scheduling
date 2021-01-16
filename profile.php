<?php
include_once('assets/include/session_header.php');
include_once('assets/include/utils.php');
$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$explodedPaths = explode('/', $path);
$id = intval(mysqli_real_escape_string($conn, $explodedPaths[count($explodedPaths) - 1]));
if (is_numeric($id)){
    $sql = "SELECT * FROM nurse_account na INNER JOIN nurse_details nd ON na.id = nd.nurse_id INNER JOIN nurse_tracker nt ON na.id = nt.nurse_id WHERE na.id = $id";
//    echo $sql.'\n';
    $result = $conn->query($sql);
    $r = $result->fetch_assoc();
    if ($r !== NULL){
        $employee = $r;
        $utils = new Utils();
        $banks = $utils->getBanks();
        $wards = $utils->getWards();
        $degrees = $utils->degree();
        $positions = $utils->positions();
        $licenseLetters = $utils->licenseLetter();
    }else{
        header('Location: ../logout.php');
    }
}else{
    header('Location: ../logout.php');
}
$title = 'Profile | '.$employee['first_name'].' '.$employee['last_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/nurse/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AcumenHOSPITALS  | <?php echo $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">s
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
<!--                    <li><a href="#" class="dropdown-item">Settings</a></li>-->

                    <li class="dropdown-divider"></li>

                    <li>
                        <a href="logout.php" class="btn btn-danger btn-block">
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
    <?php include_once('assets/include/side_bar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?php include_once('assets/include/content_header.php'); ?>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="<?php echo 'assets/images/profile_image/'.$employee['image']; ?>"
                                         alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center"><?php echo $employee['first_name'].' '.$employee['last_name']; ?></h3>

                                <p class="text-muted text-center"><?php echo $employee['position']; ?></p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <b>Ward</b> <a class="float-right"><?php echo $employee['ward']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Phone Number</b> <a class="float-right"><?php echo $employee['phone_number']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Date Of Birth</b> <a class="float-right"><?php echo date_format(date_create($employee['dob']), "d/m/Y"); ?></a>
                                    </li>
                                </ul>

                                <a href="tel:<?php echo $employee['phone_number']; ?>" class="btn btn-primary btn-block"><b>Call</b></a>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">About Me</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                                <p class="text-muted">
                                    <?php echo $employee['degree_obtained'].' in '.$employee['major_field'].' from '.$employee['higher_institution']; ?>
                                </p>

                                <hr>

                                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                                <p class="text-muted"><?php echo $employee['address']; ?></p>

                                <hr>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div id="responseMessage">

                            </div>
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Personal Information</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Education</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Account Details</a></li>

                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="activity">
                                        <form id="personalInfo" method="post" onsubmit="return false">
                                            <input class="form-control" type="hidden" name="op" value="SaveNurse.personalInfo">
                                            <input class="form-control" type="hidden" name="id" value="<?php echo $employee['id']; ?>">
                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    <h3 class="text-decoration-underline">Personal Information</h3>
                                                </div>
                                                <div class="col-12 col-md-4 mb-4">
                                                    <input class="form-control" type="text" name="firstName" placeholder="First Name" value="<?php echo $employee['first_name']; ?>">
                                                </div>
                                                <div class="col-12 col-md-4 mb-4">
                                                    <input class="form-control" type="text" name="lastName" placeholder="Last Name" value="<?php echo $employee['last_name']; ?>">
                                                </div>
                                                <div class="col-12 col-md-4 mb-4">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                        </div>
                                                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $employee['email']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4 mb-4">
                                                    <div class="form-group">
                                                        <input class="form-control" type="text" name="phoneNumber" placeholder="Phone Number" value="<?php echo $employee['phone_number']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4 mb-4">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                      <span class="input-group-text">
                                                        <i class="far fa-calendar-alt"></i>
                                                      </span>
                                                            </div>
                                                            <input type="text" class="form-control float-right" name="dob" id="reservation" value="<?php echo date_format(date_create($employee['dob']), 'm/d/Y'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4 mb-4">
                                                    <div class="form-group">
                                                        <select class="form-control" name="gender">
                                                            <option value="">::SELECT GENDER::</option>
                                                            <option value="MALE" <?php echo $selected = $employee['gender'] === 'MALE' ? 'selected': ''; ?>>MALE</option>
                                                            <option VALUE="FEMALE" <?php echo $selected = $employee['gender'] === 'FEMALE' ? 'selected': ''; ?>>FEMALE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4 mb-4">
                                                    <div class="form-group">
                                                        <textarea class="form-control" rows="3" cols="3" name="address" placeholder="Enter Address..."><?php echo $employee['address'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12 ">
                                                    <button type="submit" class="btn btn-info btn-sm float-right" id="submit1">
                                                        <i class="fa fa-save"></i>
                                                        <span>SUBMIT</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="timeline">
                                        <!-- The timeline -->
                                        <form id="academicQualificationForm" onsubmit="return false">
                                            <input class="form-control" type="hidden" name="op" value="SaveNurse.academicQualification">
                                            <input class="form-control" type="hidden" name="id" value="<?php echo $employee['id']; ?>">
                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    <h3 class="text-decoration-underline">Academic Qualification</h3>
                                                </div>
                                                <div class="col-12 col-md-4 mb-4">
                                                    <div class="form-group">
                                                        <div class="custom-file">
                                                            <input type="text" class="form-control" name="higherInstitution" placeholder="Higher Institution Attended" value="<?php echo $employee['higher_institution']; ?>">
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
                                                            <input type="text" class="form-control float-right" name="rangeOfStudy" id="startDate" value="<?php echo date_format(date_create($employee['start_date']), 'm/d/Y').' - '.date_format(date_create($employee['end_date']), 'm/d/Y'); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="form-group">
                                                        <div class="">
                                                            <input type="text" class="form-control" name="fieldOfStudy" placeholder="Field of Study/Major" value="<?php echo $employee['major_field']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="form-group">
                                                        <select class="form-control select2" name="degree" style="width: 100%;">
                                                            <?php
                                                            foreach ($degrees as $degree){
                                                                if ($employee['degree_obtained'] === $degree)
                                                                    echo '<option value="'.$degree.'" selected>'.$degree.'</option>';
                                                                else
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
                                                                if ($letter === $employee['license_letter'])
                                                                    echo '<option value="'.$letter.'" selected>'.$letter.'</option>';
                                                                else
                                                                    echo '<option value="'.$letter.'" selected>'.$letter.'</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="form-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="certificate" id="customFile" value="<?php echo $employee['certificate']; ?>">
                                                            <label class="custom-file-label" for="customFile">Upload Certificate</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <button type="submit" id="submit2" class="btn btn-info btn-sm float-right">
                                                        <i class="fa fa-save"></i>
                                                        <span>SUBMIT</span>
                                                    </button>
                                                </div>
                                                <div class="filtr-item d-none d-lg-block" data-category="2, 4" data-sort="black sample">
                                                    <embed type="application/pdf" src="<?php echo 'assets/images/certificate/'.$employee['certificate']; ?>" width="500" height="600px">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="settings">
                                        <form action="" id="bankDetails" onsubmit="return false">
                                            <input class="form-control" type="hidden" name="op" value="SaveNurse.saveBankDetails">
                                            <input class="form-control" type="hidden" name="id" value="<?php echo $loggedInNurse['nurse_id']; ?>">
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
                                                                    $selected = $bank === $employee['bank'] ? 'selected': '';
                                                                    echo '<option value="'.$bank.'" '.$selected.'>'.$bank.'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="form-group">
                                                        <div class="">
                                                            <input type="text" class="form-control" name="accountNumber" placeholder="Account Number" value="<?php echo $employee['account_number']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="sortCode" placeholder="Sort Code" value="<?php echo $employee['sort_code']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12 my-lg-5">
                                                    <button type="submit" id="submit4" class="btn btn-info btn-sm float-right">
                                                        <i class="fa fa-save"></i>
                                                        <span>SUBMIT</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include_once('assets/include/footer.php'); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
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
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- daterangepicker -->
<script src="assets/plugins/moment/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="assets/dist/js/main.js"></script>
<script>
    $(document).ready(function (){
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

    });
</script>
</body>
</html>

