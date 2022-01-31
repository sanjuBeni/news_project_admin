<?php
  include 'header.php';
?>
<?php
  include 'config.php';
  include 'includes/validation.php';
  $error = [];
  if(isset($_POST['submit']))
  {
    $oldPass = $_POST['opass'];
    $newPass = $_POST['npass'];
    $conPass = $_POST['cpass'];

    $validPass = validPassword($newPass);
    if($validPass['status'] == false)
    {
      $error = $validPass['err'];
    }
    
    $sql = "select * from login";
    
    $query = mysqli_query($conn,$sql);
    
    $data = mysqli_fetch_assoc($query);
    $dataPass = $data['pass'];

    if($oldPass == $dataPass)
    {
      if(empty($error))
      {
        if($newPass == $conPass)
      {
        $update = "update login set pass = '{$newPass}' where id = '{$_SESSION['id']}'";
        $mysql = mysqli_query($conn,$update);
        if($mysql)
        {
          $_SESSION['success'] = "Your password changed successfully.";
        }
      }
      else
      {
        $_SESSION['err'] = "Confirm password is not match.";   
      }
      }
    }
    else
    {
      $_SESSION['err'] = "Old password is not match.";
    }

  }
?>
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Change Password
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">General Elements</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
              
              <?php
              if(isset($_SESSION['success']))
                { 
              ?>
                  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                  </div>
              <?php  } ?>

              <?php
                if(isset($_SESSION['err']))
                {      
              ?>
                  <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                    <?php echo $_SESSION['err']; unset($_SESSION['err']); ?>
                  </div>
              <?php  } ?>

             
                <!-- form start -->
                <form role="form" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Old Password</label>
                      <input type="password" name="opass" class="form-control" id="exampleInputEmail1" placeholder="Old Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">New Password</label>
                      <input type="password" name="npass" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      <span style="color:red;">
                        <?php
                          if(!empty($error))
                          {
                            echo $validPass['err'];
                          }
                        ?>
                      </span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Confirm Password</label>
                      <input type="password" name="cpass" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
                    </div>
                 
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div><!-- /.box -->
            </div><!-- /.box-body -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <?php
        include 'footer.php';
      ?>
