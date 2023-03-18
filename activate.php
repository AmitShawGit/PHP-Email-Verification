<?php
session_start();
include  'connection.php';

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $updatequery = " update reg set status='active' where token='$token' ";

    $query = mysqli_query($con,$updatequery);
    if($query){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg'] = "Account updated sucessfully";
            header('location:login.php');
        }else{
            $_SESSION['msg'] = "You are logged out";
            header('location:login.php');
        }
       
    } else{
        $_SESSION['msg'] = "Account not updated";
        header('location:form.php');

    }
}
?>