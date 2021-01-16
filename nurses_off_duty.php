<?php
include_once('assets/include/session_header.php');
include_once('assets/include/utils.php');
$title = 'Nurses Off Duty';
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
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
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
    <?php include_once('assets/include/side_bar.php') ?>
    

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <!-- /.content-header -->
        <?php include_once('assets/include/content_header.php'); ?>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Nurses Off Their Duty</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Position</th>
                                        <th>Ward</th>
                                        <th>Phone Number</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Position</th>
                                        <th>Ward</th>
                                        <th>Phone Number</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
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

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="assets/plugins/jszip/jszip.min.js"></script>
  <script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="assets/dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
      $(document).ready(function (){
          var table;
          $(function () {
              var op = "NursesList.nonActive";
              // $("#example1").DataTable({
              //     "responsive": true, "lengthChange": false, "autoWidth": false,
              //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
              table = $('#example1').DataTable({
                  "processing": true,
                  "serverSide": true,

                  ajax: {
                      url: "utilities.php",
                      type: "POST",
                      data: function(d, l) {
                          d.op = op;
                      }
                  },
                  buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                  "paging": true,
                  "lengthChange": true,
                  "searching": true,
                  "ordering": true,
                  "info": true,
                  "autoWidth": false,
                  "responsive": true,
              });

              table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')

          });
      });
      function viewProfile(id){
          location.href = 'nurse_profile/'+id;
      }
  </script>
</body>

</html>
