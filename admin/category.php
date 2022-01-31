<?php
  include 'header.php';
?>
<?php
  include 'config.php';
  include 'includes/validation.php';
  include 'includes/function.php';
  $error = [];

  // sanitize sql data

  if(isset($_GET['id']))
  {
      $id = sanitize($conn,$_GET['id']);
      $sql = "select * from category where id = '{$id}' ";
      $query = mysqli_query($conn,$sql);
      $result = mysqli_fetch_assoc($query);
      $cat_Name = $result['cat_name'];
      $cat_Desc = $result['cat_desc'];
      $cat_Serial = $result['serial_no'];
      $cat_Status = $result['status'];
  }

  // Insert Data

  if(isset($_POST['submit']) && !isset($_GET['id']))
  {
    $cname = sanitize($conn,$_POST['cname']);
    $snum = sanitize($conn,$_POST['snum']);
    $selectVal = sanitize($conn,$_POST['selectval']);
    $desc = sanitize($conn,$_POST['desc']);
 
    $catName = validName($cname);
    if($catName['status'] == false)
    {
      $error = $catName['err'];
    }

    $serialNum = validNum($snum);
    if($serialNum['status'] == false)
    {
      $error = $serialNum['err'];
    }

    $validSelect = validSelectVal($selectVal);
    if($validSelect['status'] == false)
    {
      $error = $validSelect['err'];
    }

    if(empty($error))
    {
      $sql = "insert into category(cat_name,cat_desc,serial_no,status)
      values('{$cname}','{$desc}','{$snum}','{$selectVal}')
      ";
      $query = mysqli_query($conn,$sql);
      $_SESSION['insertData'] = "Data is insert successfully.";
      header('location:category.php');
      //die();
      mysqli_close($conn);
    }
  }

  // Update Data

  if(isset($_POST['submit']) && isset($_GET['id']))
  {
    $id = sanitize($conn,$_GET['id']);
    $cname = sanitize($conn,$_POST['cname']);
    $snum = sanitize($conn,$_POST['snum']);
    $selectVal = sanitize($conn,$_POST['selectval']);
    $desc = sanitize($conn,$_POST['desc']);
 
    $catName = validName($cname);
    if($catName['status'] == false)
    {
      $error = $catName['err'];
    }

    $serialNum = validNum($snum);
    if($serialNum['status'] == false)
    {
      $error = $serialNum['err'];
    }

    $validSelect = validSelectVal($selectVal);
    if($validSelect['status'] == false)
    {
      $error = $validSelect['err'];
    }

    if(empty($error))
    {
      $sql = "update category set cat_name = '{$cname}', cat_desc = '{$desc}',
      serial_no = '{$snum}', status = '{$selectVal}' where id = '{$id}'";
      $query = mysqli_query($conn,$sql);
      $_SESSION['update'] = "Data is update successfully."; 
      echo "<script>window.location.href='categorylist.php'</script>";
      // header('location:categorylist.php');
      // die();
      mysqli_close($conn);
    }
  }

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Category List
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
                <div class="box-header with-border">
                  <h3 class="box-title">Category's</h3>
                </div><!-- /.box-header -->
                <?php
              if(isset($_SESSION['insertData']))
                { 
              ?>
                  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                    <?php echo $_SESSION['insertData']; unset($_SESSION['insertData']); ?>
                  </div>
              <?php  } ?>
                <!-- form start -->
                <form  role="form" method="POST">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Category Name</label>
                      <input type="text" name="cname" class="form-control" id="exampleInputEmail1" placeholder="Category Name"
                      value = "<?php echo $cat_Name; ?>"
                      >
                      <span style = "color:red;">
                        <?php
                          if(!empty($error))
                          {
                            echo $catName['err'];
                          }
                        ?>
                      </span>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Serial Number</label>
                      <input type="number" name="snum" class="form-control" id="exampleInputEmail1" placeholder="Serial Number"
                      value = <?php echo $cat_Serial; ?>
                      >
                      <span style = "color:red;">
                        <?php
                          if(!empty($error))
                          {
                            echo $serialNum['err'];
                          }
                        ?>
                      </span>
                    </div>
                    <div class="form-group">
                      <label>Active Status</label>
                      <select name = "selectval" class="form-control">
                        <option value="">Select Value</option>
                        <option value="1" <?php if($cat_Status == 1) echo 'selected'; ?>>
                          Active
                        </option>
                        <option value="0" <?php if($cat_Status == 0) echo 'selected'; ?>>
                          Inactive
                        </option>
                      </select>
                      <span style = "color:red;">
                        <?php
                          if(!empty($error))
                          {
                            echo $validSelect['err'];
                          }
                        ?>
                      </span>
                    </div>

                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="desc" class="form-control" rows="3" placeholder="Enter..."><?php echo $cat_Desc;?>
                      </textarea>
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