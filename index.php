<?php
include 'includes/header.php';

$sql = "SELECT *from news where status = 1 order by cat_id desc";
$query = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($query);
?>

<section id="feature_news_section" class="feature_news_section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="feature_article_wrapper">
                    <div class="feature_article_img">
                        <img class="img-responsive top_static_article_img" src="admin/<?php echo $result['image']; ?>" alt="feature-top">
                    </div>
                    <!-- feature_article_img -->

                    <div class="feature_article_inner">
                        <!-- <div class="tag_lg red"><a href="category.html">Hot News</a></div> -->
                        <div class="feature_article_title">
                            <h1><a href="single.php?id=<?php echo $result['id']; ?>" target="_self"><?php echo $result['title']; ?> </a></h1>
                        </div>
                        <!-- feature_article_title -->

                        <div class="feature_article_date">Stive Clark,
                            <?php echo date("d M, Y", strtotime($result['report_date'])); ?>
                        </div>
                        <!-- feature_article_date -->

                        <div class="feature_article_content">
                            <?php echo substr(strip_tags($result['description']), 0, 105) . "..."; ?>
                        </div>
                        <!-- feature_article_content -->

                        <div class="article_social">
                            <span><i class="fa fa-share-alt"></i><?php echo $result['hits'] ?>Reviews</span>
                            <?php

                            $sql_comm = "SELECT count(id) from comments where comm_status = 1 and blog_id = {$result['id']}";
                            $query_comm = mysqli_query($conn, $sql_comm);
                            $fetch_res = mysqli_fetch_assoc($query_comm);
                            // $result_comm = mysqli_num_rows($query_comm);
                            // print_r($result_comm);
                            // die();
                            ?>
                            <span><i class="fa fa-comments-o"></i>
                                <?php
                                foreach ($fetch_res as $key => $value) {
                                    echo $value;
                                }
                                ?> Comments</span>
                        </div>
                        <!-- article_social -->

                    </div>
                    <!-- feature_article_inner -->

                </div>
                <!-- feature_article_wrapper -->

            </div>
            <!-- col-md-7 -->

            <?php
            $sql_li = "SELECT *from news where status = 1 order by hits desc limit 2";
            $query_li = mysqli_query($conn, $sql_li);
            while ($res = mysqli_fetch_assoc($query_li)) {
            ?>

                <div class="col-md-5">
                    <div class="feature_static_wrapper">
                        <div class="feature_article_img">
                            <img class="img-responsive" src="admin/<?php echo $res['image']; ?>" alt="feature-top">
                        </div>
                        <!-- feature_article_img -->

                        <div class="feature_article_inner">
                            <!-- <div class="tag_lg purple"><a href="category.html">Top Viewed</a></div> -->
                            <div class="feature_article_title">
                                <h1><a href="single.php?id=<?php echo $res['id']; ?>" target="_self"><?php echo substr(strip_tags($res['title']), 0, 30); ?> </a></h1>
                            </div>
                            <!-- feature_article_title -->

                            <div class="category_article_date"><?php echo date("d M, Y", strtotime($res['report_date'])); ?>, by: Eric joan</div>
                            <!-- feature_article_date -->

                            <div class="feature_article_content">
                                <?php echo substr(strip_tags($res['description']), 0, 98) ?>... </div>
                            <!-- feature_article_content -->

                            <div class="article_social">
                                <span><i class="fa fa-share-alt"></i><?php echo $res['hits'] ?>Reviews</span>
                                <?php
                                // echo $res['id'];
                                // die();
                                $sql_com = "SELECT count(id) from comments where blog_id = {$res['id']}";
                                $query_com = mysqli_query($conn, $sql_com);
                                $fetch = mysqli_fetch_assoc($query_com);
                                // $result_com = mysqli_num_rows($query_com);
                                // print_r($fetch);
                                // die();
                                ?>
                                <span><i class="fa fa-comments-o"></i>
                                    <?php
                                    foreach ($fetch as $val) echo $val;
                                    ?> Comments</span>
                            </div>
                            <!-- article_social -->

                        </div>
                        <!-- feature_article_inner -->

                    </div>
                    <!-- feature_static_wrapper -->

                </div>
                <!-- col-md-5 -->
            <?php } ?>

        </div>
        <!-- Row -->

    </div>
    <!-- container -->

</section>
<!-- Feature News Section -->

<section id="category_section" class="category_section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php
                $cat_sql = "SELECT *from category where `status` = 1";
                $cat_query = mysqli_query($conn, $cat_sql);
                if (mysqli_num_rows($cat_query) > 0) {
                    while ($cat_result = mysqli_fetch_assoc($cat_query)) {
                ?>
                        <div class="category_section mobile">
                            <div class="article_title header_purple">
                                <h2><a href="category.html" target="_self"><?php echo $cat_result['cat_name']; ?></a></h2>
                            </div>
                            <!----article_title------>
                            <div class="category_article_wrapper">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php
                                        $sql_db = "SELECT *from news where status = 1 and cat_id={$cat_result['id']} order by hits desc";
                                        $query_db = mysqli_query($conn, $sql_db);
                                        $result_db = mysqli_fetch_assoc($query_db);

                                        ?>
                                        <div class="top_article_img">
                                            <a href="single.php?id=<?php echo $result_db['id']; ?>" target="_self"><img class="img-responsive" src="admin/<?php echo $result_db['image']; ?>" alt="feature-top">
                                            </a>
                                        </div>
                                        <!----top_article_img------>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="category_article_title">
                                            <h2><a href="single.php?id=<?php echo $result_db['id']; ?>" target="_self"><?php echo strip_tags($result_db['title']); ?>
                                                </a></h2>
                                        </div>
                                        <!----category_article_title------>
                                        <div class="category_article_date"><?php echo date("d M, Y", strtotime($result_db['report_date'])); ?>, by: Eric joan</div>
                                        <!----category_article_date------>
                                        <div class="category_article_content">
                                            <?php echo substr(strip_tags($result_db['description']), 0, 200) ?>...
                                        </div>
                                        <!----category_article_content------>
                                        <div class="media_social">
                                            <span><i class="fa fa-share-alt"></i><?php echo $result_db['hits'] ?> Reviews</span>
                                            <?php
                                            $comm_sql = "SELECT count(id) from comments where blog_id = {$result_db['id']}";
                                            $comm_query = mysqli_query($conn, $comm_sql);
                                            // $comm_row = mysqli_num_rows($comm_query);
                                            $comm_res = mysqli_fetch_array($comm_query);

                                            ?>
                                            <span><i class="fa fa-comments-o"></i>
                                                <?php
                                                // print_r($comm_res);
                                                foreach ($comm_res as $key => $val) {
                                                    echo $val;
                                                    break;
                                                }
                                                ?>
                                                Comments</span>
                                        </div>
                                        <!----media_social------>

                                    </div>
                                </div>
                            </div>
                            <div class="category_article_wrapper">
                                <div class="row">
                                    <?php
                                    //print_r(mysqli_fetch_assoc($query_db));
                                    //$r_db = mysqli_query($conn, $sql_db);
                                    while ($result_db1 = mysqli_fetch_assoc($query_db)) {

                                    ?>
                                        <div class="col-md-6">
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="single.php?id=<?php echo $result_db1['id']; ?>"><img class="media-object" src="admin/<?php echo $result_db1['image']; ?>" width="70" height="70" alt="Generic placeholder image"></a>
                                                </div>
                                                <div class="media-body">

                                                    <h3 class="media-heading"><a href="single.php?id=<?php echo $result_db1['id']; ?>" target="_self">
                                                            <?php echo substr(strip_tags($result_db1['title']), 0, 20); ?>...</a></h3>
                                                    <span class="media-date"><?php echo date("d M, Y", strtotime($result_db1['report_date'])); ?>, by: Eric joan</span>

                                                    <div class="media_social">
                                                        <span><i class="fa fa-share-alt"></i><?php echo $result_db1['hits']; ?>
                                                            Reviews</span>
                                                        <?php
                                                        $re_sql = "SELECT count(id) from comments where blog_id = {$result_db1['id']}";
                                                        $re_query = mysqli_query($conn, $re_sql);
                                                        $re_fetch = mysqli_fetch_assoc($re_query);
                                                        ?>
                                                        <span><i class="fa fa-comments-o"></i>
                                                            <?php foreach ($re_fetch as $key => $value) {
                                                                echo $value;
                                                                break;
                                                            } ?>
                                                            Comments</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    } ?>

                                </div>
                            </div>
                            <p class="divider"><a href="#">More News&nbsp;&raquo;</a></p>
                        </div>
                        <!-- Mobile News Section -->

                <?php }
                } ?>

            </div>
            <!-- Left Section -->

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
                                    </h3> <span class="media-date"><span class="media-date">
                                            <?php echo date("d M, Y", strtotime($pop_row['report_date'])); ?>
                                            , by: Eric joan</span>

                                        <div class="widget_article_social">
                                            <span>
                                                <i class="fa fa-share-alt"></i>
                                                <?php echo $pop_row['hits']; ?> Reviews
                                            </span>
                                            <?php
                                            $p_sql = "SELECT count(id) from comments where blog_id = {$pop_row['id']}";
                                            $p_query = mysqli_query($conn, $p_sql);
                                            $p_fetch = mysqli_fetch_assoc($p_query);
                                            ?>
                                            <span>
                                                <i class="fa fa-comments-o"></i>
                                                <?php
                                                foreach ($p_fetch as $val) {
                                                    echo $val;
                                                    break;
                                                }
                                                ?>
                                                Comments
                                            </span>
                                        </div>
                                </div>
                            </div>
                    <?php }
                    } ?>



                    <p class="widget_divider"><a href="#" target="_self">More News&nbsp;&raquo;</a></p>
                </div>
                <!-- Popular News -->

                <div class="widget hidden-xs m30">
                    <img class="img-responsive adv_img" src="assets/img/right_add1.jpg" alt="add_one">
                    <img class="img-responsive adv_img" src="assets/img/right_add2.jpg" alt="add_one">
                    <img class="img-responsive adv_img" src="assets/img/right_add3.jpg" alt="add_one">
                    <img class="img-responsive adv_img" src="assets/img/right_add4.jpg" alt="add_one">
                </div>
                <!-- Advertisement -->


                <div class="widget reviews m30">
                    <div class="widget_title widget_black">
                        <h2><a href="#">Reviews</a></h2>
                    </div>
                    <?php
                    $rev_sql = "SELECT *from comments order by review desc limit 1";
                    $rev_query = mysqli_query($conn, $rev_sql);
                    $result_rev = mysqli_fetch_assoc($rev_query);
                    // print_r($result_rev);
                    // die();
                    $sql_result = "SELECT *from news where id = {$result_rev['blog_id']}";
                    $query_result = mysqli_query($conn, $sql_result);
                    $review_result = mysqli_fetch_assoc($query_result);
                    // print_r($review_result);
                    // die();
                    ?>
                    <div class="media">
                        <div class="media-left">
                            <a href="#"><img class="media-object" src="admin/<?php echo $review_result['image']; ?>" height="90" width="90" alt="Generic placeholder image"></a>
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">
                                <a href="single.html" target="_self">
                                    <?php echo strip_tags($review_result['title']); ?></a>
                            </h3>
                            <span class="rating">
                                <?php
                                for ($i = 1; $i <= $result_rev['review']; $i++) {
                                ?>
                                    <i class="fa fa-star"></i>
                                <?php } ?>
                            </span>
                        </div>
                    </div>


                    <p class="widget_divider"><a href="#" target="_self">More News&nbsp;&raquo;</a></p>
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
                    <?php
                    $most_sql = "SELECT count(*) from comments GROUP BY blog_id";
                    $most_query = mysqli_query($conn, $most_sql);
                    if (mysqli_num_rows($most_query) > 0) {
                        $most_result = mysqli_fetch_assoc($most_query);
                        // $news_sql = "SELECT *from news where id = {$most_result['blog_id']}";
                        // $news_query = mysqli_query($conn, $news_sql);
                        // $news_result = mysqli_fetch_assoc($news_query);
                        // print_r($most_result);
                        // die();
                    }
                    ?>
                    <div class="media">
                        <div class="media-left">
                            <a href="#"><img class="media-object" src="assets/img/pop_right1.jpg" alt="Generic placeholder image"></a>
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">
                                <a href="single.html" target="_self">Yasaki camera launches new generic
                                    hi-speed shutter camera.</a>
                            </h3>

                            <div class="media_social">
                                <span><i class="fa fa-comments-o"></i><a href="#">4</a> Comments</span>
                            </div>
                        </div>
                    </div>

                    <p class="widget_divider"><a href="#" target="_self">More News&nbsp;&nbsp;&raquo;
                        </a></p>
                </div>
                <!-- Most Commented News -->

                <div class="widget m30">
                    <div class="widget_title widget_black">
                        <h2><a href="#">Editor Corner</a></h2>
                    </div>
                    <div class="widget_body"><img class="img-responsive left" src="assets/img/editor.jpg" alt="Generic placeholder image">

                        <p>Collaboratively administrate empowered markets via plug-and-play networks.
                            Dynamically procrastinate B2C
                            users after installed base benefits. Dramatically visualize customer
                            directed convergence without</p>

                        <p>Collaboratively administrate empowered markets via plug-and-play networks.
                            Dynamically procrastinate B2C
                            users after installed base benefits. Dramatically visualize customer
                            directed convergence without
                            revolutionary ROI.</p>
                        <button class="btn pink">Read more</button>
                    </div>
                </div>
                <!-- Editor News -->

            </div>
            <!-- Right Section -->

        </div>
        <!-- Row -->

    </div>
    <!-- Container -->

</section>
<!-- Category News Section -->

<?php
include 'includes/footer.php';
?>