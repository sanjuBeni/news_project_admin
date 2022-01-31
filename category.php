<?php
require 'includes/header.php';
?>
<?php
if (isset($_GET['cat_id'])) {
    $cat_id = $_GET['cat_id'];
    $sql = "SELECT *from news where cat_id = '{$cat_id}' and status=1 order by serial_no asc";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
} else {
    $sql = "SELECT *from news where  status=1 order by serial_no asc";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
}
?>

<section class="breadcrumb_section">
    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <?php
                if (isset($_GET['cat_id'])) {
                    $cat_sql = "SELECT *from category where id = '{$cat_id}' order by serial_no desc";
                    $cat_query = mysqli_query($conn, $cat_sql);
                    $cat_result = mysqli_fetch_assoc($cat_query);
                } else {
                    $cat_sql = "SELECT *from category order by serial_no desc";
                    $cat_query = mysqli_query($conn, $cat_sql);
                    $cat_result = mysqli_fetch_assoc($cat_query);
                }
                ?>
                <li><a href="index.php">Home</a></li>
                <li><a href=""><?php echo $cat_result['cat_name'] ?></a></li>
            </ol>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="entity_wrapper">
                <div class="entity_title header_purple">
                    <h1><a href=""><?php echo $cat_result['cat_name']; ?></a></h1>
                </div>

                <!-- entity_title -->

                <div class="entity_thumb">
                    <a href="single.php?id=<?php echo $result['id']; ?>" target="_blank">
                        <img class="img-responsive" src="admin/<?php echo $result['image']; ?>" alt="feature-top">
                    </a>
                </div>
                <!-- entity_thumb -->

                <div class="entity_title">
                    <a href="single.php?id=<?php echo $result['id']; ?>" target="_blank">
                        <h3>
                            <?php echo $result['title']; ?>
                        </h3>
                    </a>
                </div>
                <!-- entity_title -->

                <div class="entity_meta">
                    <span style="color:black;">
                        <?php echo date('d M, Y', strtotime($result['report_date'])); ?>
                    </span> by: <span style="color:black;">Eric joan</span>
                </div>
                <!-- entity_meta -->

                <div class="entity_content">
                    <?php echo substr(strip_tags($result['description']), 0, 200); ?>...
                </div>
                <!-- entity_content -->
                <div class="entity_social">
                    <span><i class="fa fa-share-alt"></i>
                        <?php echo $result['hits']; ?>
                        Reviews
                    </span>
                    <span><i class="fa fa-comments-o"></i>4, Comments</span>
                </div>
                <!-- entity_social -->

            </div>
            <!-- entity_wrapper -->

            <div class="row">
                <?php
                while ($res = mysqli_fetch_assoc($query)) {
                ?>
                    <div class="col-md-6">
                        <div class="category_article_body">
                            <div class="top_article_img">
                                <a href="single.php?id=<?php echo $res['id']; ?>">
                                    <img class="img-fluid" src="admin/<?php echo $res['image']; ?>" width='320' height='200' alt="feature-top">
                                </a>
                            </div>
                            <!-- top_article_img -->
                            <div class="category_article_title">
                                <h5>
                                    <a href="single.php?id=<?php echo $res['id']; ?>" target="_blank">
                                        <?php echo $res['title']; ?>
                                    </a>
                                </h5>
                            </div>
                            <!-- category_article_title -->

                            <div class="article_date">
                                <a href="#"><?php echo date('d M, Y', strtotime($res['report_date'])); ?></a>, by: <a href="#">Eric joan</a>
                            </div>
                            <!-- article_date -->

                            <div class="category_article_content">
                                <p><?php echo substr(strip_tags($res['description']), 0, 150);  ?>...</p>
                            </div>
                            <!-- category_article_content -->

                            <div class="article_social">
                                <span>
                                    <a href="#"><i class="fa fa-share-alt"></i>
                                        <?php echo $res['hits']; ?> </a>
                                    Reviews
                                </span>
                                <span><i class="fa fa-comments-o"></i><a href="#">4</a> Comments</span>
                            </div>
                            <!-- article_social -->

                        </div>
                        <!-- category_article_body -->

                    </div>
                    <!-- col-md-6 -->
                <?php } ?>
            </div>
            <!-- row -->

            <div class="widget_advertisement">
                <img class="img-responsive" src="assets/img/category_advertisement.jpg" alt="feature-top">
            </div>
            <!-- widget_advertisement -->

            <nav aria-label="Page navigation" class="pagination_section">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="Previous"> <span aria-hidden="true">&laquo;</span> </a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next" class="active"> <span aria-hidden="true">&raquo;</span> </a>
                    </li>
                </ul>
            </nav>
            <!-- navigation -->

        </div>
        <!-- col-md-8 -->

        <div class="col-md-4">
            <div class="widget">
                <div class="widget_title widget_black">
                    <h2><a href="#">Popular News</a></h2>
                </div>
                <?php
                $pop_sql = "SELECT *from news order by hits desc limit 2";
                $pop_query = mysqli_query($conn, $pop_sql) or die("Query fail");
                if (mysqli_num_rows($pop_query) > 0) {
                    while ($pop_row = mysqli_fetch_assoc($pop_query)) {
                ?>
                        <div class="media">
                            <div class="media-left">
                                <a href="single.php?id=<?php echo $pop_row['id']; ?>"><img class="media-object" src="admin/<?php echo $pop_row['image']; ?>" width="90" height="90" alt="Generic placeholder image"></a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="single.php?id=<?php echo $pop_row['id']; ?>" target="_self"><?php echo substr(strip_tags($pop_row['title']), 0, 15); ?></a>
                                </h3>
                                <span class="media-date"><span class="media-date">
                                        <?php echo date("d M, Y", strtotime($pop_row['report_date'])); ?>
                                        , by: Eric joan</span>, by: Eric joan</span>

                                <div class="widget_article_social">
                                    <span>
                                        <i class="fa fa-share-alt"></i>
                                        <?php echo $pop_row['hits']; ?> Reviews
                                    </span>
                                    <span>
                                        <a href="single.html" target="_blank"><i class="fa fa-comments-o"></i>4</a> Comments
                                    </span>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
                <p class="widget_divider"><a href="#" target="_blank">More News&nbsp;&raquo;</a></p>
            </div>
            <!-- Popular News -->

            <div class="widget hidden-xs m30">
                <img class="img-responsive adv_img" src="assets/img/right_add1.jpg" alt="add_one">
                <img class="img-responsive adv_img" src="assets/img/right_add2.jpg" alt="add_one">
                <img class="img-responsive adv_img" src="assets/img/right_add3.jpg" alt="add_one">
                <img class="img-responsive adv_img" src="assets/img/right_add4.jpg" alt="add_one">
            </div>
            <!-- Advertisement -->

            <div class="widget hidden-xs m30">
                <img class="img-responsive widget_img" src="assets/img/right_add5.jpg" alt="add_one">
            </div>
            <!-- Advertisement -->

            <div class="widget reviews m30">
                <div class="widget_title widget_black">
                    <h2><a href="#">Reviews</a></h2>
                </div>
                <div class="media">
                    <div class="media-left">
                        <a href="#"><img class="media-object" src="assets/img/pop_right1.jpg" alt="Generic placeholder image"></a>
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">
                            <a href="single.html" target="_blank">DSLR is the most old camera at this time readmore
                                about new
                                products</a>
                        </h3>
                        <span class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-full"></i>
                        </span>
                    </div>
                </div>
                <p class="widget_divider"><a href="#" target="_blank">More News&nbsp;&raquo;</a></p>
            </div>
            <!-- Reviews News -->

            <div class="widget hidden-xs m30">
                <img class="img-responsive widget_img" src="assets/img/right_add6.jpg" alt="add_one">
            </div>
            <!-- Advertisement -->

            <div class="widget m30">
                <div class="widget_title widget_black">
                    <h2><a href="#">Most Commented</a></h2>
                </div>
                <div class="media">
                    <div class="media-left">
                        <a href="#"><img class="media-object" src="assets/img/pop_right1.jpg" alt="Generic placeholder image"></a>
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">
                            <a href="single.html" target="_blank">Yasaki camera launches new generic hi-speed shutter
                                camera.</a>
                        </h3>

                        <div class="media_social">
                            <span><i class="fa fa-comments-o"></i><a href="#">4</a> Comments</span>
                        </div>
                    </div>
                </div>
                <p class="widget_divider"><a href="#" target="_blank">More News&nbsp;&nbsp;&raquo; </a></p>
            </div>
            <!-- Most Commented News -->

            <div class="widget m30">
                <div class="widget_title widget_black">
                    <h2><a href="#">Editor Corner</a></h2>
                </div>
                <div class="widget_body"><img class="img-responsive left" src="assets/img/editor.jpg" alt="Generic placeholder image">

                    <p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically
                        procrastinate B2C
                        users after installed base benefits. Dramatically visualize customer directed convergence
                        without</p>

                    <p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically
                        procrastinate B2C
                        users after installed base benefits. Dramatically visualize customer directed convergence
                        without
                        revolutionary ROI.</p>
                    <button class="btn pink">Read more</button>
                </div>
            </div>
            <!-- Editor News -->

            <div class="widget hidden-xs m30">
                <img class="img-responsive add_img" src="assets/img/right_add7.jpg" alt="add_one">
                <img class="img-responsive add_img" src="assets/img/right_add7.jpg" alt="add_one">
                <img class="img-responsive add_img" src="assets/img/right_add7.jpg" alt="add_one">
                <img class="img-responsive add_img" src="assets/img/right_add7.jpg" alt="add_one">
            </div>
            <!--Advertisement -->

        </div>
        <!-- col-md-4 -->

    </div>
    <!-- row -->

</div>
<!-- container -->


<?php
require 'includes/footer.php';
?>