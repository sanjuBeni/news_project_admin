<?php
  include 'header.php';
?>
<?php
  include 'config.php';
  include 'includes/validation.php';
  include 'includes/function.php';
  include 'image.php';
  $error = [];

  // sanitize sql data

  if(isset($_GET['id']))
  {
      $id = sanitize($conn,$_GET['id']);
      $sql = "select * from news where id = '{$id}' ";
      $query = mysqli_query($conn,$sql);
      $result = mysqli_fetch_assoc($query);
      $blogID = $result['cat_id'];
      $title = $result['title'];
      $cat_Desc = $result['description'];
      $cat_Serial = $result['serial_no'];
      $cat_Status = $result['status'];
      $image = $result['image'];
  }

  // Insert Data

  if(isset($_POST['submit']) && !isset($_GET['id']))
  {
    $id = sanitize($conn,$_GET['id']);
    $blogvalue = sanitize($conn,$_POST['blogvalue']);
    $title = sanitize($conn,$_POST['title']);
    $blogno = sanitize($conn,$_POST['blogno']);
    $activestatus = sanitize($conn,$_POST['activestatus']);
    $desc = sanitize($conn,$_POST['desc']);
    // $image = $fileDest;
    date_default_timezone_set('Asia/Kolkata'); 
    $date = date("Y-m-d H:i:s");
 
    $validTitle = validTitle($title);
    if($validTitle['status'] == false)
    {
      $error = $validTitle['err'];
    }

    $serialNum = validNum($blogno);
    if($serialNum['status'] == false)
    {
      $error = $serialNum['err'];
    }

    $validSelect = validSelectVal($activestatus);
    if($validSelect['status'] == false)
    {
      $error = $validSelect['err'];
    }

    if(empty($error))
    {
      $sql = "INSERT into news(cat_id,title,description,serial_no,status,image,report_date)
      values('{$blogvalue}','{$title}','{$desc}','{$blogno}','{$activestatus}','{$fileDest}','{$date}')";
      $query = mysqli_query($conn,$sql);
      // $_SESSION['insertBlog'] = "Data is insert successfully.";
      // header('location:blogslist.php');
      echo "<script>window.location.href='blogslist.php'</script>";
      //die();
      mysqli_close($conn);
    }
  }

  // Update Data

  if(isset($_POST['submit']) && isset($_GET['id']))
  {
    $id = sanitize($conn,$_GET['id']);
    $blogvalue = sanitize($conn,$_POST['blogvalue']);
    $title = sanitize($conn,$_POST['title']);
    $blogno = sanitize($conn,$_POST['blogno']);
    $activestatus = sanitize($conn,$_POST['activestatus']);
    $desc = sanitize($conn,$_POST['desc']);
    // $image = $fileDest;
    date_default_timezone_set('Asia/Kolkata'); 
    $date = date("Y-m-d H:i:s");

    $validTitle = validTitle($title);
    if($validTitle['status'] == false)
    {
      $error = $validTitle['err'];
    }

    $serialNum = validNum($blogno);
    if($serialNum['status'] == false)
    {
      $error = $serialNum['err'];
    }

    $validSelect = validSelectVal($activestatus);
    if($validSelect['status'] == false)
    {
      $error = $validSelect['err'];
    } 

    if(empty($error))
    {
      if($fileDest == "")
      {
        $sql = "UPDATE news set cat_id = '{$blogvalue}',title='{$title}' ,description = '{$desc}',
        serial_no = '{$blogno}', status = '{$activestatus}',report_date='{$date}' where id = '{$id}'";
        $query = mysqli_query($conn,$sql);
        $_SESSION['updateBlog'] = "Data is update successfully."; 
        echo "<script>window.location.href='blogslist.php'</script>";
        // header('location:categorylist.php');
        // die();
        mysqli_close($conn);
      }
      else
      {
        $sql = "UPDATE news set cat_id = '{$blogvalue}',title='{$title}' ,description = '{$desc}',
        serial_no = '{$blogno}', status = '{$activestatus}',image='{$fileDest}',report_date='{$date}' where id = '{$id}'";
        $query = mysqli_query($conn,$sql);
        $_SESSION['updateBlog'] = "Data is update successfully."; 
        echo "<script>window.location.href='blogslist.php'</script>";
        // header('location:categorylist.php');
        // die();
        mysqli_close($conn);
      }
    }
  }

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Add Blogs
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
                  <h3 class="box-title">Blogs</h3>
                </div><!-- /.box-header -->
               
                <!-- form start -->
                <form  role="form" method="POST" enctype="multipart/form-data">
                  <div class="box-body">
                  
                 
                  <div class="form-group">
                      <label>Blog Type</label>
                      <?php
                        $blog_sql = "SELECT *from category";
                        $blog_query = mysqli_query($conn,$blog_sql);
                      ?>
                      <select name = "blogvalue" class="form-control">
                        <option value = "">Select Value</option>
                        <?php           
                          while($myData = mysqli_fetch_array($blog_query))
                          {
                      
                        ?>
                        <option 
                        value = "<?php  echo $myData['id'];?>" <?php if($blogID == $myData['id']) echo 'selected'; ?> >
                          <?php 
                            echo $myData['cat_name'];
                          ?>
                        </option>
                        <?php  } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Title"
                      value = "<?php echo $title; ?>"
                      >
                      <span style = "color:red;">
                        <?php
                          if(!empty($error))
                          {
                            echo $validTitle['err'];
                          }
                        ?>
                      </span>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Serial Number</label>
                      <input type="number" name="blogno" class="form-control" id="exampleInputEmail1" placeholder="Serial Number"
                      value = "<?php echo $cat_Serial; ?>"
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
                      <select name = "activestatus" class="form-control">
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
                      <label>Upload Blog Image</label>
                      <input type="file" class="form-control" name="file">
                      <?php echo $image; ?>
                      <img src="<?php echo $image ?>" alt=""  width="70" height="70">
                    </div>

                    <div class="form-group">
                      <label>Description</label>
                      <textarea name="desc" class="textarea form-control"  placeholder="Enter..."><?php echo $cat_Desc; ?></textarea>
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