<?php
include 'config.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TechNews - HTML and CSS Template</title>

    <!-- favicon -->
    <link href="assets/img/favicon.png" rel=icon>

    <!-- web-fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,500' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- font-awesome -->
    <link href="assets/fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
    <!-- Mobile Menu Style -->
    <link href="assets/css/mobile-menu.css" rel="stylesheet">

    <!-- Owl carousel -->
    <link href="assets/css/owl.carousel.css" rel="stylesheet">
    <link href="assets/css/owl.theme.default.min.css" rel="stylesheet">
    <!-- Theme Style -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar">
    <div id="main-wrapper">
        <!-- Page Preloader -->
        <!-- <div id="preloader">
            <div id="status">
                <div class="status-mes"></div>
            </div>
        </div> -->
        <!-- preloader -->
        <?php

        ?>
        <div class="uc-mobile-menu-pusher">
            <div class="content-wrapper">
                <section id="header_section_wrapper" class="header_section_wrapper">
                    <div class="container">
                        <div class="header-section">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="left_section">
                                        <span class="date">
                                            Sunday .
                                        </span>
                                        <!-- Date -->
                                        <span class="time">
                                            09 August . 2016
                                        </span>
                                        <!-- Time -->
                                        <div class="social">
                                            <a href="https://www.facebook.com/" target="_blank" class="icons-sm fb-ic"><i class="fa fa-facebook"></i></a>
                                            <!--Twitter-->
                                            <a href="https://twitter.com/" target="_blank" class="icons-sm tw-ic"><i class="fa fa-twitter"></i></a>
                                            <!--Google +-->
                                            <a href="https://www.instagram.com/accounts/login/" target="_blank" class="icons-sm inst-ic"><i class="fa fa-instagram"> </i></a>
                                            <!--Linkedin-->
                                            <a class="icons-sm tmb-ic"><i class="fa fa-tumblr"> </i></a>
                                            <!--Pinterest-->
                                            <!-- <a class="icons-sm rss-ic"><i class="fa fa-rss"> </i></a> -->
                                        </div>
                                        <!-- Top Social Section -->
                                    </div>
                                    <!-- Left Header Section -->
                                </div>
                                <div class="col-md-4">
                                    <div class="logo">
                                        <a href="index.php"><img src="assets/img/logo.png" alt="Tech NewsLogo"></a>
                                    </div>
                                    <!-- Logo Section -->
                                </div>
                                <div class="col-md-4">
                                    <div class="right_section">
                                        <ul class="nav navbar-nav">
                                            <li><a href="#">Login</a></li>
                                            <li><a href="#">Register</a></li>
                                            <li class="dropdown lang">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">En <i class="fa fa-angle-down"></i></button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                    <li><a href="#">Bn</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <!-- Language Section -->

                                        <ul class="nav-cta hidden-xs">
                                            <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-search"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <div class="head-search">
                                                            <form action="search.php" role="form" method="POST">
                                                                <!-- Input Group -->
                                                                <div class="input-group">
                                                                    <input type="text" name="search_item" class="form-control" placeholder="Type Something"> <span class="input-group-btn">
                                                                        <button type="submit" name="search" class="btn btn-primary">
                                                                            Search
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <!-- Search Section -->
                                    </div>
                                    <!-- Right Header Section -->
                                </div>
                            </div>
                        </div>
                        <!-- Header Section -->

                        <div class="navigation-section">
                            <nav class="navbar m-menu navbar-default">
                                <div class="container">
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1"><span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                                        </button>
                                    </div>
                                    <!-- Collect the nav links, forms, and other content for toggling -->
                                    <div class="collapse navbar-collapse" id="#navbar-collapse-1">
                                        <ul class="nav navbar-nav main-nav">
                                            <li class=""><a href="index.php">Home</a></li>
                                            <?php
                                            if (isset($_GET['cat_id'])) {
                                                $cat_id = $_GET['cat_id'];
                                            }
                                            $sql = "SELECT *from category where status = 1 order by serial_no asc";
                                            $query = mysqli_query($conn, $sql) or die("query failed.");
                                            if (mysqli_num_rows($query) > 0) {
                                                while ($result = mysqli_fetch_assoc($query)) {
                                                    if (isset($_GET['cat_id'])) {
                                                        if ($cat_id == $result['id']) {
                                                            $active = "active";
                                                        } else {
                                                            $active = "";
                                                        }
                                                    }
                                            ?>
                                                    <li class="<?php echo $active; ?>">
                                                        <a href="category.php?cat_id=<?php echo $result['id'] ?>">
                                                            <?php echo $result['cat_name']; ?></a>
                                                    </li>
                                            <?php }
                                            } ?>
                                        </ul>
                                    </div>
                                    <!-- .navbar-collapse -->
                                </div>
                                <!-- .container -->
                            </nav>
                            <!-- .nav -->
                        </div>
                        <!-- .navigation-section -->
                    </div>
                    <!-- .container -->
                </section>
                <!-- header_section_wrapper -->