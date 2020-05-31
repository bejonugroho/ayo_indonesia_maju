<?php
include "inc/koneksi.php";
session_start();
if($_SESSION['login']){
    include "dashboard.php";
}else{
    header('location:login.php');
}
?>