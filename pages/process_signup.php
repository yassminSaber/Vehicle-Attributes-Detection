<?php
require('vendor/autoload.php');
include('include/connections.php');
if (isset($_POST['submit'])) {

    $username = stripcslashes(strtolower($_POST["username"]));
    $nationalId = stripcslashes($_POST["nationalId"]);
    $platenumber = stripcslashes($_POST["platenumber"]);
    $phonenumber = stripcslashes($_POST["phonenumber"]);
    $password = stripcslashes($_POST["password"]);
    $confirmPassword = stripcslashes($_POST["password2"]);


    $username = htmlentities(mysqli_real_escape_string($conn, $_POST['username']));
    $nationalId = htmlentities(mysqli_real_escape_string($conn, $_POST['nationalId']));
    $platenumber = htmlentities(mysqli_real_escape_string($conn, $_POST['platenumber']));
    $phonenumber = htmlentities(mysqli_real_escape_string($conn, $_POST['phonenumber']));
    $md5_pass = md5($password);
    $error_s = 0;

    $check_user = "SELECT * FROM `driver` where username  = '$username'";
    $check_result = mysqli_query($conn, $check_user);
    $num_rows = mysqli_num_rows($check_result);
    if ($num_rows != 0) {
        $user_error = '<div class="alert alert-danger text-center">Sorry, Username already exist.</div>';
        $error_s = 1;
    }

    $check_nationalId = "SELECT * FROM `driver` where nationalId  = '$nationalId'";
    $check_result = mysqli_query($conn, $check_nationalId);
    $num_rows = mysqli_num_rows($check_result);

    if ($num_rows != 0) {
        $nationalId_error = '<div class="alert alert-danger text-center">Sorry, nationalId already exist.</div>';
        $error_s = 1;
    }
    $check_plateNumber = "SELECT * FROM `driver` where platenumber  = '$platenumber'";
    $check_result = mysqli_query($conn, $check_plateNumber);
    $num_rows = mysqli_num_rows($check_result);

    if ($num_rows != 0) {
        $plateNumber_error = '<div class="alert alert-danger text-center">Sorry, platenumber already exist.</div>';
        $error_s = 1;
    }

    $check_phoneNumber = "SELECT * FROM `driver` where phonenumber  = '$phonenumber'";
    $check_result = mysqli_query($conn, $check_phoneNumber);
    $num_rows = mysqli_num_rows($check_result);

    if ($num_rows != 0) {
        $plateNumber_error = '<div class="alert alert-danger text-center">Sorry, phone Number already exist.</div>';
        $error_s = 1;
    }


    if($password != $confirmpassword){
        $passworderror = '<div class="alert alert-danger text-center">Sorry, Password and Confirm password not matched.</div>';
        $error_s = 1;
    }

    if (($num_rows == 0) && ($error_s == 0)) {
        
    

        $sql = "INSERT INTO user(nationalId,username,phonenumber,password,platenumber) VALUES
                                ('$nationalId','$username','$phonenumber','$password','$platenumber','$md5_pass')";
        mysqli_query($conn, $sql);
        
    } else {
        include('signup.php');
    }
}