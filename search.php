<?php
require 'includes/header.php';

if (isset($_POST['search'])) {
    $search_item = mysqli_real_escape_string($conn, $_POST['search_item']);
    // echo $search_item;
    // die();
    $search_sql = "SELECT *from news where title like '%{$search_item}%' or description like '%{$search_item}%'";
    $search_query = mysqli_query($conn, $search_sql);
    // $result_search = mysqli_fetch_assoc($search_query);
    // print_r($result_search);
    // die();
    $row = mysqli_num_rows($search_query);
}

?>


<section id="category_section" class="category_section">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="category_section camera">
                    <div class="article_title header_orange">
                        <h2>Search Item</h2>
                    </div>
                    <!-- article_title -->

                    <div class="category_article_wrapper">
                        <?php
                        if ($row > 0) {
                            while ($result_search = mysqli_fetch_assoc($search_query)) { ?>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="top_article_img">
                                            <a href="single.html" target="_self">
                                                <img class="img-responsive" src="admin/<?php echo $result_search['image']; ?>" alt="feature-top">
                                            </a>
                                        </div>
                                        <!-- top_article_img -->

                                    </div>
                                    <div class="col-md-7">

                                        <div class="category_article_title">
                                            <h2><a href="single.html" target="_self"><?php echo $result_search['title']; ?></a></h2>
                                        </div>
                                        <!-- category_article_title -->

                                        <div class="article_date"><a href="#">10Aug- 2015</a>, by: <a href="#">Eric
                                                joan</a></div>
                                        <!----article_date------>
                                        <!-- category_article_wrapper -->

                                        <div class="category_article_content">
                                            <?php echo substr(strip_tags($result_search['description']), 0, 200); ?>...
                                        </div>
                                        <!-- category_article_content -->

                                        <div class="media_social">
                                            <span><a href="#"><i class="fa fa-share-alt"></i>424 </a>
                                                Shares</span>
                                            <span><i class="fa fa-comments-o"></i><a href="#">4</a>
                                                Comments</span>
                                        </div>
                                        <!-- media_social -->

                                    </div>
                                    <!-- col-md-7 -->
                                </div>
                                <!-- row -->
                        <?php }
                        } else {
                            echo "<div class='container'>";
                            echo "<h3>No Record found</h3>";
                            echo "</div>";
                        } ?>

                    </div>
                    <!-- category_article_wrapper -->

                </div>
                <!-- Camera News Section -->


                <!-- Design News Section -->
            </div>
            <!-- Left Section -->

            <div class="col-md-4">
                <div class="widget">
                    <div class="widget_title widget_black">
                        <h2><a href="#">Popular News</a></h2>
                    </div>
                    <div class="media">
                        <div class="media-left">
                            <a href="#"><img class="media-object" src="assets/img/pop_right1.jpg" alt="Generic placeholder image"></a>
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">
                                <a href="single.html" target="_self">Canon launches photo centric 00214
                                    Model supper shutter camera</a>
                            </h3> <span class="media-date"><a href="#">10Aug- 2015</a>, by: <a href="#">Eric
                                    joan</a></span>

                            <div class="widget_article_social">
                                <span>
                                    <a href="single.html" target="_self"> <i class="fa fa-share-alt"></i>424</a>
                                    Shares
                                </span>
                                <span>
                                    <a href="single.html" target="_self"><i class="fa fa-comments-o"></i>4</a>
                                    Comments
                                </span>
                            </div>
                        </div>
                    </div>

                    <p class="widget_divider"><a href="#" target="_self">More News&nbsp;&raquo;</a></p>
                </div>
                <!-- Popular News -->

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

            </div>
            <!-- Right Section -->

        </div>
        <!-- Row -->

    </div>
    <!-- Container -->

</section>
<!-- Category News Section -->





<?php
require 'includes/footer.php';
?>