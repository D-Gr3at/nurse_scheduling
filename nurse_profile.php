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
                                    <li class="nav-item"><a class="nav-link active" href="#jobInfo" data-toggle="tab">Job Information</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active " id="jobInfo">
                                        <form class="form-horizontal" id="jobInfoForm" onsubmit="return false">
                                            <input class="form-control" type="hidden" name="op" value="SaveNurse.jobInfo">
                                            <input class="form-control" type="hidden" name="id" value="<?php echo $employee['id']; ?>">
                                            <div class="form-group row">
                                                <label for="inputName" class="col-sm-2 col-form-label">Position</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" id="inputName" name="position"  <?php echo $employee['position'] === 'Nurse Leader' ? 'disabled' : ''; ?> style="width: 100%;">
                                                        <?php
                                                        foreach ($positions as $position){
                                                            if ($position === $employee['position'])
                                                                echo '<option value="'.$position.'" selected>'.$position.'</option>';
                                                            echo '<option value="'.$position.'"     >'.$position.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-2 col-form-label">Gross Income</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="salary" id="inputEmail" placeholder="Gross Income" value="<?php echo number_format(floatval($employee['income']), '2', '.', ','); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Ward</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control select2" name="ward" style="width: 100%;" data-placeholder="Ward">
                                                        <?php
                                                        foreach ($wards as $ward){
                                                            if ($ward === $employee['ward'])
                                                                echo '<option value="'.$ward.'" selected>'.$ward.'</option>';
                                                            echo '<option value="'.$ward.'">'.$ward.'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="passport" class="col-sm-2 col-form-label">Passport</label>
                                                <div class=" col-sm-10 custom-file">
                                                    <input type="file" class="custom-file-input" name="passport" id="passport">
                                                    <label class="custom-file-label" for="customFile1">Upload Passport</label>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="filtr-item col-6 d-none d-lg-block" data-category="2, 4" data-sort="black sample">
                                                    <embed type="image/jpg" src="<?php echo 'assets/images/profile_image/'.$employee['image']; ?>" width="400" height="400">
                                                </div>
                                                <div class="col-6 my-lg-5">
                                                    <button type="submit" id="submit3" class="btn btn-info btn-sm float-right">
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

