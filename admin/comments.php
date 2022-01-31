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
$sql = "SELECT * from comments order by id desc limit {$offset},{$limitPerPage}";
$query = mysqli_query($conn, $sql);
$result = mysqli_num_rows($query);
if ($result > 0) {

?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Comments Tables
                <small>preview Comments</small>
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
                            <h3 class="box-title">Comments List</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive no-padding text-center">
                            <table class="table table-hover table-striped table-bordered">
                                <tr>
                                    <th class="text-center">S.No.</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Blog ID</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Reviews</th>
                                    <th class="text-center">Description</th>

                                    <th class="text-center">Status</th>

                                </tr>
                                <?php
                                // $x=1;
                                while ($data = mysqli_fetch_assoc($query)) {
                                    // $cat_sql = "SELECT *from category where id = {$data['cat_id']}";
                                    // $cat_query = mysqli_query($conn, $cat_sql);
                                    // $cat_result = mysqli_fetch_assoc($cat_query);
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo ++$offset;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $data['name'];;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $data['blog_id'];;
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $data['email']; ?>
                                        </td>


                                        <td>
                                            <?php for ($i = 1; $i <= $data['review']; $i++) { ?>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo $data['comment']; ?>
                                        </td>

                                        <td>
                                            <?php
                                            if ($data['comm_status'] == 1) { ?>
                                                <a href="commstatuschange.php?status=<?php echo 0; ?>&id=<?php echo $data['id']; ?>" onclick="return confirm('Are you wnat to change status.'); ">
                                                    <input type="button" class="btn btn-success" value="Active" style="width:80px;">
                                                </a>
                                            <?php  } else {
                                            ?>
                                                <a href="commstatuschange.php?status=<?php echo 1; ?>&id=<?php echo $data['id']; ?>" onclick="return confirm('Are you wnat to change status.');">
                                                    <input type="button" class="btn btn-danger" value="InActive" style="width:80px;">
                                                </a>
                                            <?php  }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>

                            <ul class="pagination admin-pagination">
                                <?php
                                if ($pageID > 1) {
                                ?>
                                    <li>
                                        <a href="comments.php?page=<?php echo $pageID - 1; ?>">
                                            Pre
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                                <?php
                                $sqlpag = "SELECT *from comments";
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
                                            <a href="comments.php?page=<?php echo $i; ?>">
                                                <?php echo $i; ?>
                                            </a>
                                        </li>
                                <?php }
                                } ?>
                                <?php
                                if ($totalPage > $pageID) {
                                ?>
                                    <li>
                                        <a href="comments.php?page=<?php echo $pageID + 1; ?>">
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