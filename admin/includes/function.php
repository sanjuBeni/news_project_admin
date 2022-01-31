<?php
// Data Sanitize

function sanitize($conn,$data)
{
    return mysqli_real_escape_string($conn,$data); 
}

// Debug

function debug($data)
{
    echo "<pre>";
    print_r($data);
    die();
}

?>