<!DOCTYPE html>
<html>

<head>
    <base href="/nurse/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Acumen Hospitals | Change Password</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="../../../../../../code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/dist/css/styles.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="index/"><b>Acumen</b>HOSPITALS</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Reset Your Default Password</p>
            <span id="responseMessage"></span>
            <form id="resetPasswordForm" method="post" onsubmit="return false">
                <div class="input-group mb-3">
                    <input type="hidden" name="op" value="Auth.resetPassword">
                    <input type="hidden" name="email" id="email" value="">
                    <input type="password" name="password" class="form-control" placeholder="New Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm New Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6"></div>
                    <!-- /.col -->
                    <div class="col-6" id="btn-control">
                        <button type="submit" id="resetPassword" class="btn btn-success btn-block btn-sm">Reset</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <!-- <p>- OR -</p>
              <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
              </a>
              <a href="#" class="btn btn-block btn-danger" aria-readonly="true">
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
              </a> -->
            </div>
            <!-- /.social-auth-links -->

<!--            <p class="mb-1">-->
<!--                <a href="forgot-password/">I forgot my password</a>-->
<!--            </p>-->
            <!-- <p class="mb-0">
            <a href="register.html" class="text-center">Register a new membership</a>
          </p> -->
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<script src="assets/dist/js/main.js"></script>

</body>

</html>
