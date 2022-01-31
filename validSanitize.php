<?php
function validName($name)
{
    if (empty($name)) {
        return ['status' => false, 'err' => "Enter your name"];
    }
}

function validMail($email)
{
    if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)) {
        return ['status' => false, 'err' => 'Invalid email'];
    }
}

function sanitize($conn, $data)
{
    return mysqli_real_escape_string($conn, $data);
}
