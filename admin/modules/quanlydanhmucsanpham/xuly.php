<?php
include('../../config/connectdb.php');
$tenloaisanpham = $_POST['tendanhmuc'];
$thutu = $_POST['thutu'];
// var_dump($thutu,$tensanpham);
if(isset($_POST['themdanhmuc'])){
    //them
    $sql_them = "INSERT INTO tbl_danhsach(tendanhmuc,thutu) VALUE ('$tenloaisanpham','$thutu')";
    // var_dump($sql_them->execute);
    mysqli_query($con,$sql_them);
    header('location:../../index.php?action=quanlydanhmucsanpham&query=them');
}elseif(isset($_POST['suadanhmuc'])){
    //sua
    $sql_sua = "UPDATE tbl_danhsach SET tendanhmuc='$tensanpham', thutu='$thutu' WHERE id_danhmuc = '$_GET[iddanhmuc]'";
    mysqli_query($con,$sql_sua);
    header('location:../../index.php?action=quanlydanhmucsanpham&query=them');
}else{
    //xoa
    $id= $_GET["iddanhmuc"];
    $sql_xoa = "DELETE FROM tbl_danhsach WHERE id_danhmuc ='".$id."'";
    mysqli_query($con,$sql_xoa);
    var_dump($sql_xoa);
    header('location:../../index.php?action=quanlydanhmucsanpham&query=them');
}
?>