<?php
    include 'config.php';
    $id = $_GET['id'];
    // echo $id;
    $status = $_GET['status'];
    // echo $status
    $sql = "update category set status = '{$status}' where id = '{$id}'";
    $query = mysqli_query($conn,$sql);
    mysqli_close($conn);
    header('location:categorylist.php');
    die();

?>