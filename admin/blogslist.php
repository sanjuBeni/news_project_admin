<?php
include 'header.php';
?>
<?php
include 'config.php';
$limitPerPage = 5;
// $pageID = $_GET['page'];
if (isset($_GET['page'])) {
  $pageID = $_GET['page'];
} else {
  $pageID = 1;
}
$offset = ($pageID - 1) * $limitPerPage;
$sql = "SELECT * from news order by id desc limit {$offset},{$limitPerPage}";
$query = mysqli_query($conn, $sql);
$result = mysqli_num_rows($query);
if ($result > 0) {

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blogs Tables
        <small>preview Blogs</small>
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
              <h3 class="box-title">Blogs List</h3>
            </div><!-- /.box-header -->
            <?php
            if (isset($_SESSION['updateBlog'])) {
            ?>
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4> <i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $_SESSION['updateBlog'];
                unset($_SESSION['updateBlog']); ?>
              </div>
            <?php  } ?>

            <div class="box-body table-responsive no-padding text-center">
              <table class="table table-hover table-striped table-bordered">
                <tr>
                  <th class="text-center">S.No.</th>
                  <th class="text-center">Category Name</th>
                  <th class="text-center">Title</th>
                  <th class="text-center">Serial Number</th>
                  <th class="text-center">Reporting Date</th>
                  <th class="text-center">Hits</th>
                  <th class="text-center">Description</th>
                  <th class="text-center">Image</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Update</th>
                  <th class="text-center">Commnets</th>
                </tr>
                <?php
                // $x=1;
                while ($data = mysqli_fetch_assoc($query)) {
                  $cat_sql = "SELECT *from category where id = {$data['cat_id']}";
                  $cat_query = mysqli_query($conn, $cat_sql);
                  $cat_result = mysqli_fetch_assoc($cat_query);
                ?>
                  <tr>
                    <td>
                      <?php
                      echo ++$offset;
                      ?>
                    </td>
                    <td>
                      <?php
                      echo $cat_result['cat_name'];
                      ?>
                    </td>
                    <td>
                      <?php echo $data['title']; ?>
                    </td>
                    <td>
                      <?php echo $data['serial_no']; ?>
                    </td>
                    <td>
                      <?php echo $data['report_date']; ?>
                    </td>
                    <td>
                      <?php echo $data['hits']; ?>
                    </td>
                    <td>
                      <?php echo $data['description']; ?>
                    </td>
                    <td>
                      <img src="<?php echo $data['image']; ?>" width="50" height="50">
                    </td>
                    <td>
                      <?php
                      if ($data['status'] == 1) { ?>
                        <a href="blogstatuschange.php?status=<?php echo 0; ?>&id=<?php echo $data['id']; ?>" onclick="return confirm('Are you wnat to change status.'); ">
                          <input type="button" class="btn btn-success" value="Active" style="width:80px;">
                        </a>
                      <?php  } else {
                      ?>
                        <a href="blogstatuschange.php?status=<?php echo 1; ?>&id=<?php echo $data['id']; ?>" onclick="return confirm('Are you wnat to change status.');">
                          <input type="button" class="btn btn-danger" value="InActive" style="width:80px;">
                        </a>
                      <?php  }
                      ?>
                    </td>
                    <td>
                      <a href="blogs.php?id=<?php echo $data['id']; ?>">
                        <i class="fa fa-pencil-square fa-2x" style="color:orange" aria-hidden="true"></i>
                      </a>
                    </td>
                    <td>
                      <a href="comments.php">
                        <i class="fa fa-comments fa-2x" style="color:black" aria-hidden="true"></i>
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              </table>

              <ul class="pagination admin-pagination">
                <?php
                if ($pageID > 1) {
                ?>
                  <li>
                    <a href="blogslist.php?page=<?php echo $pageID - 1; ?>">
                      Pre
                    </a>
                  </li>
                <?php
                }
                ?>
                <?php
                $sqlpag = "SELECT *from news";
                $querypag = mysqli_query($conn, $sqlpag);
                if (mysqli_num_rows($querypag) > 0) {
                  $totalRecord = mysqli_num_rows($querypag);

                  $totalPage = ceil($totalRecord / $limitPerPage);
                  for ($i = 1; $i <= $totalPage; $i++) {
                    if ($i == $pageID) {
                      $active = "active";
                    } else {
                      $active = "";
                    }
                ?>
                    <li class=<?php echo $active; ?>>
                      <a href="blogslist.php?page=<?php echo $i; ?>">
                        <?php echo $i; ?>
                      </a>
                    </li>
                <?php }
                } ?>
                <?php
                if ($totalPage > $pageID) {
                ?>
                  <li>
                    <a href="blogslist.php?page=<?php echo $pageID + 1; ?>">
                      Next
                    </a>
                  </li>
                <?php
                }
                ?>
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