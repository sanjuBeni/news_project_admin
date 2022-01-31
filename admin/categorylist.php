<?php
  include 'header.php';
?>
<?php

  include 'config.php';
  $limitPerPage = 3;
  if(isset($_GET['page']))
  {
    $pageId = $_GET['page'];
  }
  else
  {
    $pageId = 1;
  }
  $offset = ($pageId - 1) * $limitPerPage;
  $sql = "SELECT * from category order by id desc limit {$offset},{$limitPerPage}";
  $query = mysqli_query($conn,$sql);
  $row = mysqli_num_rows($query);
  if($row > 0)
  {
    
?>

     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Category Tables
          <small>preview of category tables</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">Simple</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Category List</h3>
              </div><!-- /.box-header -->
              <?php
              if(isset($_SESSION['update']))
                { 
              ?>
                  <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>	<i class="icon fa fa-check"></i> Alert!</h4>
                    <?php echo $_SESSION['update']; unset($_SESSION['update']); ?>
                  </div>
              <?php  } ?>
              <div class="box-body table-responsive no-padding text-center">
                <table class="table table-hover table-striped table-bordered">
                  <tr>
                    <th class="text-center">C.No.</th>
                    <th class="text-center">Category Name</th>
                    <th class="text-center">Serial Number</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Update</th>
                  </tr>
                  <?php
                    // $x = 1;
                    while($result = mysqli_fetch_assoc($query))
                    {
                  ?>
                  <tr>
                    <td>
                      <?php 
                        echo ++$offset; 
                      ?>
                    </td>
                    <td>
                      <?php echo $result['cat_name']; ?> 
                    </td>
                    <td>
                      <?php echo $result['serial_no']; ?>
                    </td>
                    <td>
                      <?php echo $result['cat_desc']; ?>
                    </td>
                    <td>
                      <?php
                      if($result['status'] == 1)
                      { ?>
                        <a href="statusChange.php?id=<?php echo $result['id'];?>&status=<?php echo 0; ?>"
                        onclick = "return confirm('Are you wnat to change status.');"
                        >
                          <input type="button" class="btn btn-success" style="width:80px;" value="Active">
                        </a> 
                      <?php }
                      else
                      { ?>
                        <a href="statusChange.php?id=<?php echo $result['id'];?>&status=<?php echo 1; ?>"
                        onclick = "return confirm('Are you wnat to change status.');"
                        >
                          <input type="button" class="btn btn-danger" style="width:80px;" value="InActive">
                        </a> 
                      <?php
                      }
                      ?>
                    </td>
                    <td>              
                        <a href="category.php?id=<?php echo $result['id'];?>"
                        onclick = "return confirm('Are you wnat to update data.');"
                        >
                          <i class="fa fa-pencil-square fa-2x" style="color:orange" aria-hidden="true"></i>
                        </a>
                    </td>
                  </tr>
                  <?php
                    }
                  ?>
                </table>
                
                <ul class="pagination admin-pagination">
                  <?php 
                    if($pageId > 1)
                    {
                  ?>
                  <li>
                    <a href="categorylist.php?page=<?php echo ($pageId - 1); ?>">Pre</a>
                  </li>
                  <?php } ?>
                <?php
                // Pagination code 
                  $sqlPag = "SELECT *FROM category";
                  $queryPag = mysqli_query($conn,$sqlPag);
                  if(mysqli_num_rows($queryPag) > 0)
                  {
                    $totalRecord = mysqli_num_rows($queryPag);
                    $totalPage = ceil($totalRecord/$limitPerPage);
                    for($i = 1; $i <= $totalPage; $i++)
                    {
                      if($i == $pageId)
                      {
                        $active = "active";
                      }
                      else
                      {
                        $active = "";
                      }
                ?>
                      <li class = "<?php echo $active ?>">
                        <a href="categorylist.php?page=<?php echo $i;?>">
                          <?php echo $i ?>
                        </a>
                      </li>
                <?php 
                  }}
                ?>
                  <?php 
                    if($totalPage > $pageId)
                    {
                  ?>
                    <li>
                      <a href="categorylist.php?page=<?php echo ($pageId + 1) ?>">
                        Next
                      </a>
                    </li>
                  <?php } ?>
                  </ul>                
                 
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div>
        </div>
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php } ?>
<?php
  include 'footer.php';
?>
