<?php

function validPassword($password)
{
    if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password))
    {
        return ['status' => false, 'err' => "*Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character."];
    }
    return ['status' => true, 'err' => ""];
}

function validMail($email)
        {
            if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email))
            {
                return ['status' => false, 'err' => 'Invalid email'];                  
            }
            $conn = mysqli_connect("localhost","root","","admin") or die("Connection failed");
            $sql = "select *from login where email <> '{$email}'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_num_rows($result);
            if($row > 0)
            {
                return ['status' => false, 'err' => '*Wrong email!'];
            }
            mysqli_close($conn);
            return ['status' => true, 'err' => ''];
        }

function validLoginPass($pass)
{
    $conn = mysqli_connect("localhost","root","","admin") or die("Connection failed");
            $sql = "select *from login where pass <> '{$pass}'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_num_rows($result);
            if($row > 0)
            {
                return ['status' => false, 'err' => '*Wrong password!'];
            }
            else
            {
                return ['status' => true, 'err' => ''];
            }
            mysqli_close($conn);
}

function validLoginEmail($email)
{
    $conn = mysqli_connect("localhost","root","","admin") or die("Connection failed");
            $sql = "select *from login where email <> '{$email}'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_num_rows($result);
            if($row > 0)
            {
                return ['status' => false, 'err' => '*Wrong email!'];
            }
            else
            {
                return ['status' => true, 'err' => ''];
            }
            mysqli_close($conn);
}

function validName($name)
        {
            if(empty($name))
            {
                return ['status' => false, 'err' => '*Characters are required'];
            }
            elseif(strlen($name) < 4)
            {
                return ['status' => false, 'err' => '*Min 4 characters allowed'];
            }
            elseif(!preg_match("/^[a-zA-Z-' ]*$/", $name))
            {
                return ['status' => false, 'err' => '*Alphabats allowed only'];
            }
            return ['status' => true, 'err' => '']; 
        }

function validNum($num)
    {
        if(!preg_match("/^[0-9]+$/", $num))
    {
        return ['status' => false, 'err' => '*Fill valid number'];
    }
        return ['status' => true, 'err' => ''];   
    }

function validSelectVal($sel)
    {
        if(!preg_match("/^[0-1]$/", $sel))
            {
                return ['status' => false, 'err' => '*Select a value.'];
            }
        return ['status' => true, 'err' => '']; 
    }

function validSelectBlog($blog)
{
    if(empty($blog))
    {
        return ['status' => false, 'err' => '*Select a category.'];
    }
    return ['status' => true, 'err' => '']; 
}

function validTitle($title)
{
    if(empty($title))
    {
        return ['status' => false, 'err' => '*Title is required.'];
    }
    return ['status' => true, 'err' => '']; 
}

?>

