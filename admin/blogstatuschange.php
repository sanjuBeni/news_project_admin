<?php
    include 'config.php';
    $id = $_GET['id'];
    $status = $_GET['status'];
    // echo $id;
    // echo $status;
    $sql = "UPDATE news set status = '{$status}' where id = '{$id}'";
    $query = mysqli_query($conn,$sql);
    header('location:blogslist.php');
    mysqli_close($conn);
?>