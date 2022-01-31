<?php
include 'config.php';
$id = $_GET['id'];
$status = $_GET['status'];
// echo $id;
// echo $status;
$sql = "UPDATE comments set comm_status = '{$status}' where id = '{$id}'";
$query = mysqli_query($conn, $sql);
header('location:comments.php');
mysqli_close($conn);
