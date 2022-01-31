<?php
require 'includes/header.php';
include 'validSanitize.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT *from news where id = {$id}";
    $query = mysqli_query($conn, $sql);
?>
    <?php
    $error = [];
    if (isset($_POST['submit']) && isset($_GET['id'])) {
        $name = sanitize($conn, $_POST['name']);
        $email = sanitize($conn, $_POST['email']);
        $review = sanitize($conn, $_POST['review']);
        $comment = sanitize($conn, $_POST['textarea']);
        $blog_id = $_GET['id'];

        $validName = validName($name);
        if ($validName['status'] == false) {
            $error = $validName['err'];
        }
        $validEmail = validMail($email);
        if ($validEmail['status'] == false) {
            $error = $validEmail['err'];
        }

        if (empty($error)) {
            $insert_sql = "INSERT into comments (blog_id,name,email,review,comment,comm_status)
            values({$blog_id},'{$name}','{$email}','{$review}','{$comment}',0)";
            $insert_query = mysqli_query($conn, $insert_sql);
            echo "<script> alert('Thanks for comment.') </script>";
            echo "<script> document.location.href='single.php?id=" . $blog_id . "'</script>";
            // header("location:single.php?id=<?php echo $blog_id; ");
        }
    }
    ?>
    <?php
    $com_sql = "SELECT *from comments blog_id = {$id}";
    $com_query = mysqli_query($conn, $com_sql);
    ?>

    <section id="entity_section" class="entity_section">

        <div class="container">
            <div class="row">
                <?php
                $result = mysqli_fetch_assoc($query);
                ?>
                <div class="col-md-8">
                    <div class="entity_wrapper">
                        <div class="entity_title">
                            <h1><?php echo $result['title']; ?></h1>
                        </div>
                        <!-- entity_title -->

                        <div class="entity_meta"><?php echo date("d M, Y", strtotime($result['report_date'])) ?>, by: Eric joan
                        </div>
                        <!-- entity_meta -->
                        <?php
                        $review_sql = "SELECT *from comments where blog_id = '{$_GET['id']}'";
                        $review_query = mysqli_query($conn, $review_sql);
                        $res_review = mysqli_fetch_assoc($review_query);
                        // echo $res_review['review'];
                        // die();
                        ?>

                        <div class="entity_rating">
                            <?php
                            for ($i = 1; $i <= $res_review['review']; $i++) {
                            ?> <i class="fa fa-star"></i>
                            <?php } ?>
                        </div>
                        <!-- entity_rating -->

                        <div class="entity_social">
                            <a href="#" class="icons-sm sh-ic">
                                <i class="fa fa-share-alt"></i>
                                <?php if (isset($_GET['id'])) {
                                    $hit = $result['hits'] += 1;
                                    $hit_sql = "UPDATE news set hits = {$hit} where id = {$_GET['id']}";
                                    $hit_query = mysqli_query($conn, $hit_sql);
                                }
                                ?>
                                <b>
                                    <?php echo $hit; ?>
                                </b>
                                <span class="share_ic">Reviews</span>
                            </a>
                            <a href="#" class="icons-sm fb-ic"><i class="fa fa-facebook"></i></a>
                            <!--Twitter-->
                            <a href="#" class="icons-sm tw-ic"><i class="fa fa-twitter"></i></a>
                            <!--Google +-->
                            <a href="#" class="icons-sm inst-ic"><i class="fa fa-google-plus"> </i></a>
                            <!--Linkedin-->
                            <a href="#" class="icons-sm tmb-ic"><i class="fa fa-ge"> </i></a>
                            <!--Pinterest-->
                            <a href="#" class="icons-sm rss-ic"><i class="fa fa-rss"> </i></a>
                        </div>
                        <!-- entity_social -->

                        <div class="entity_thumb">
                            <img class="img-responsive" src="admin/<?php echo $result['image']; ?>" alt="feature-top">
                        </div>
                        <!-- entity_thumb -->

                        <div class="entity_content">
                            <?php echo $result['description']; ?>
                        </div>
                    <?php }
                    ?>
                    <!-- entity_content -->
                    <?php
                    $count_sql = "SELECT count(id) from comments where blog_id = {$_GET['id']}";
                    $count_query = mysqli_query($conn, $count_sql);
                    $count_res = mysqli_fetch_assoc($count_query);
                    // echo "<pre>";
                    // print_r($count_res);
                    // die();
                    ?>

                    <div class="entity_footer">
                        <div class="entity_social">
                            <span><i class="fa fa-share-alt"></i><?php echo $hit; ?> <a href="">Reviews</a> </span>
                            <span><i class="fa fa-comments-o"></i><?php foreach ($count_res as $val) echo $val; ?> <a href="#comments">Comments</a> </span>
                        </div>
                        <!-- entity_social -->

                    </div>
                    <!-- entity_footer -->

                    </div>
                    <!-- entity_wrapper -->

                    <div class="related_news">
                        <div class="entity_inner__title header_purple">
                            <h2><a href="#">Related News</a></h2>
                        </div>
                        <!-- entity_title -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#"><img class="media-object" src="assets/img/cat-mobi-sm4.jpg" alt="Generic placeholder image"></a>
                                    </div>
                                    <div class="media-body">
                                        <span class="tag purple"><a href="category.html" target="_self">Mobile</a></span>
                                        <a href="single.html" target="_self">
                                            <h3 class="media-heading">Fully new look slim handset
                                                like</h3>
                                        </a>
                                        <span class="media-date"><a href="#">10Aug- 2015</a>, by: <a href="#">Eric joan</a></span>

                                        <div class="media_social">
                                            <span><a href="#"><i class="fa fa-share-alt"></i>424</a> Shares</span>
                                            <span><a href="#"><i class="fa fa-comments-o"></i>4</a> Comments</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Related news -->

                    <div class="widget_advertisement">
                        <img class="img-responsive" src="assets/img/category_advertisement.jpg" alt="feature-top">
                    </div>
                    <!--Advertisement-->

                    <div class="readers_comment">
                        <div class="entity_inner__title header_purple">
                            <h2>Readers Comment</h2>
                        </div>
                        <!-- entity_title -->

                        <?php

                        $cat_sql = "SELECT *from news where status = 1 and blog_id={$_GET['id']}";
                        $cat_query = mysqli_query($conn, $cat_sql);
                        $sql_comm = "SELECT *from comments where comm_status=1 order by id desc limit 5";
                        $query_comm = mysqli_query($conn, $sql_comm);
                        while ($result_comm = mysqli_fetch_assoc($query_comm)) {
                            if ($_GET['id'] == $result_comm['blog_id']) {
                        ?>

                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <!-- <img alt="64x64" class="media-object" data-src="assets/img/reader_img1.jpg" src="assets/img/reader_img1.jpg" data-holder-rendered="true"> -->
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h2 class="media-heading"><?php echo $result_comm['name']; ?></h2>
                                        <?php echo $result_comm['comment']; ?>

                                        <div class="entity_vote">
                                            <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
                                            <a href="#"><span class="reply_ic">Reply </span></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- media end -->
                        <?php }
                        } ?>
                    </div>
                    <!--Readers Comment-->

                    <div class="widget_advertisement">
                        <img class="img-responsive" src="assets/img/category_advertisement.jpg" alt="feature-top">
                    </div>
                    <!--Advertisement-->

                    <div class="entity_comments">
                        <div class="entity_inner__title header_black">
                            <h2>Add a Comment</h2>
                        </div>
                        <!--Entity Title -->
                        <div class="entity_comment_from">
                            <form id="comments" method="POST">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Name">
                                    <span style="color:red;">
                                        <?php
                                        if (!empty($error)) {
                                            echo $validName['err'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Email">
                                    <span style="color:red;">
                                        <?php
                                        if (!empty($error)) {
                                            echo $validEmail['err'];
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <select name="review" class="form-control">
                                        <option selected>Select Review</option>
                                        <option value=1>Poor</option>
                                        <option value=2>Fair</option>
                                        <option value=3>Average</option>
                                        <option value=4>Good</option>
                                        <option value=5>Excellent</option>
                                    </select>
                                </div>
                                <div class="form-group comment">
                                    <textarea class="form-control" name="textarea" id="inputComment" placeholder="Comment"></textarea>
                                </div>

                                <button type="submit" class="btn btn-submit red" name="submit">Submit</button>
                            </form>
                        </div>
                        <!--Entity Comments From -->

                    </div>
                    <!--Entity Comments -->

                </div>
                <!--Left Section-->

                <div class="col-md-4">
                    <div class="widget">
                        <div class="widget_title widget_black">
                            <h2><a href="#">Popular News</a></h2>
                        </div>
                        <?php
                        $pop_sql = "SELECT *from news order by hits desc limit 2";
                        $pop_query = mysqli_query($conn, $pop_sql);
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
                                        <span class="media-date">
                                            <?php echo date("d M, Y", strtotime($pop_row['report_date'])); ?>
                                            , by: Eric joan</span>

                                        <div class="widget_article_social">
                                            <span>
                                                <i class="fa fa-share-alt"></i>
                                                <?php echo $pop_row['hits']; ?> Reviews
                                            </span>
                                            <span>
                                                <a href="#comments" target="_self"><i class="fa fa-comments-o"></i>4</a> Comments
                                            </span>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                        <p class="widget_divider"><a href="category.php" target="_self">More News&nbsp;&raquo;</a></p>
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
                        <?php
                        // $rev_sql = "SELECT *from comments order by review desc limit 2";
                        // $rev_query = mysqli_query($conn, $rev_sql);
                        // while ($rev_result = mysqli_fetch_assoc($rev_query)) {
                        ?>
                        <div class="media">
                            <div class="media-left">
                                <a href="#"><img class="media-object" src="assets/img/pop_right1.jpg" alt="Generic placeholder image"></a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="single.html" target="_self"></a>
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
                        <?php //} 
                        ?>
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

                        <div class="media">
                            <div class="media-left">
                                <a href="#"><img class="media-object" src="assets/img/pop_right4.jpg" alt="Generic placeholder image"></a>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading">
                                    <a href="single.html" target="_self">DSLR is the most old camera at this time readmore about new
                                        products</a>
                                </h3>

                                <div class="media_social">
                                    <span><i class="fa fa-comments-o"></i><a href="#">4</a> Comments</span>
                                </div>
                            </div>
                        </div>
                        <p class="widget_divider"><a href="#" target="_self">More News&nbsp;&nbsp;&raquo; </a></p>
                    </div>
                    <!-- Most Commented News -->

                    <div class="widget m30">
                        <div class="widget_title widget_black">
                            <h2><a href="#">Readers Corner</a></h2>
                        </div>
                        <div class="widget_body"><img class="img-responsive left" src="assets/img/reader.jpg" alt="Generic placeholder image">

                            <p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C
                                users after installed base benefits. Dramatically visualize customer directed convergence without</p>

                            <p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C
                                users after installed base benefits. Dramatically visualize customer directed convergence without
                                revolutionary ROI.</p>
                            <button class="btn pink">Read more</button>
                        </div>
                    </div>
                    <!--  Readers Corner News -->

                    <div class="widget hidden-xs m30">
                        <img class="img-responsive widget_img" src="assets/img/podcast.jpg" alt="add_one">
                    </div>
                    <!--Advertisement-->
                </div>
                <!--Right Section-->

            </div>
            <!-- row -->

        </div>
        <!-- container -->

    </section>
    <!-- Entity Section Wrapper -->

    <?php
    require 'includes/footer.php';
    ?>