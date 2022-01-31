<?php

if (isset($_POST['submit']) && isset($_FILES['file'])) {
  $file = $_FILES['file'];
  $fileName = $file['name'];
  $fileSize = $file['size'];
  $fileTmp = $file['tmp_name'];
  $uploadFolder = 'blogimage/';
  $imgError = [];

  $fileExtArr = explode(".", $fileName); // explode convert string to array
  $fileExt = strtolower(end($fileExtArr));
  $fileType = ['jpg', 'jpeg', 'png'];
  if (in_array($fileExt, $fileType)) {
    if ($fileSize < 2097152) {
      $fileNewName = rand(10000, 99999) . "." . $fileExt;
      $fileDest = $uploadFolder . $fileNewName;
      move_uploaded_file($fileTmp, $fileDest);
    } else {
      $imgError = "File size not more then 2MB.";
    }
  } else {
    $imgError = "This extension file not allowed, Please choose a JPG or PNG file";
  }
}
