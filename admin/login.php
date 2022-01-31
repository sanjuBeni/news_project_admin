<?php
session_start();
// include 'login.php';
include 'config.php';
include 'includes/validation.php';
$error = [];
if(isset($_SESSION['logged_in']))
{
  header('location:index.php');
  die();
}
    if(isset($_POST['submit']))
    {
      // echo "clicked";
      $email = $_POST['email'];
      $pass = $_POST['pass'];

      // Email Valid
      
      $emailValid = validMail($email);
      if($emailValid['status'] == false)
      {
        $error = $emailValid['err'];
      }

      // Password Valid

      $passValid = validLoginPass($pass);
      if($passValid['status'] == false)
      {
        $error = $passValid['err'];
      }      
      // print_r($error);

      // echo $email; echo $pass;
      $sql = "select * from login where email='{$email}' and pass='{$pass}' limit 1";
      $result = mysqli_query($conn,$sql);
      // print_r($result);

      if(mysqli_num_rows($result) > 0)
      {
        $myData = mysqli_fetch_assoc($result);
        // print_r($myData);
        $_SESSION['name'] = $myData['name'];
        $_SESSION['pass'] = $myData['pass'];
        $_SESSION['id'] = $myData['id'];
        $_SESSION['logged_in'] = true;
        header('location:index.php');
        die();
      }
      mysqli_close($conn);



    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><b>Admin</b>LTE</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="Email">
            <span style = "color:red;">
              <?php
                if(!empty($error))
                {
                  echo $emailValid['err'];
                }
              ?>
            </span>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="pass" class="form-control" placeholder="Password">
            <span style = "color:red;">
              <?php
                if(!empty($error))
                {
                  echo $passValid['err'];
                }
              ?>
            </span>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
