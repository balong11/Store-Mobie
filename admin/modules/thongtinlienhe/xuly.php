<?php
include('../../config/connectdb.php');
$thongtinlienhe = $_POST['thongtinlienhe'];
$id = $_GET['id'];

if(isset($_POST['submitlienhe'])){
    
    $sql_sua = "UPDATE lienhe SET thongtinlienhe='$thongtinlienhe' WHERE id = '".$id."' ";
    mysqli_query($con,$sql_sua);
    header('location:../../index.php?action=thongtinlienhe&query=capnhat');
  }
?>