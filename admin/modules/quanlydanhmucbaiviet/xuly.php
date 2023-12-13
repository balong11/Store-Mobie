<?php
include('../../config/connectdb.php');
$tenbaiviet = $_POST['tendanhmuc'];
$thutu = $_POST['thutu'];
// var_dump($thutu,$tensanpham);
if(isset($_POST['thembaiviet'])){
    //them
    $sql_them = "INSERT INTO danhmucbaiviet(tendanhmuc,thutu) VALUE ('$tenbaiviet','$thutu')";
    // var_dump($sql_them->execute);
    mysqli_query($con,$sql_them);
    header('location:../../index.php?action=quanlydanhmucbaiviet&query=them');
  }elseif(isset($_POST['suabaiviet'])){
    //sua
    $sql_sua = "UPDATE danhmucbaiviet SET tendanhmuc='$tenbaiviet', thutu='$thutu' WHERE id_baiviet = '$_GET[idbaiviet]'";
    mysqli_query($con,$sql_sua);
    header('location:../../index.php?action=quanlydanhmucbaiviet&query=them');
}else{
    //xoa
    $id= $_GET["idbaiviet"];
    $sql_xoa = "DELETE FROM danhmucbaiviet WHERE id_baiviet ='".$id."'";
    mysqli_query($con,$sql_xoa);
    var_dump($sql_xoa);
    header('location:../../index.php?action=quanlydanhmucbaiviet&query=them');
}
?>