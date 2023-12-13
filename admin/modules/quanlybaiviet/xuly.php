<?php
include('../../config/connectdb.php');
$tenbaiviet = $_POST['tenbaiviet'];
//xử lý hình ảnh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh_n = time().'_'.$hinhanh;

$tomtat = $_POST['tomtat'];
$noidung= $_POST['noidung'];
$tinhtrang = $_POST['tinhtrang'];
$danhmuc = $_POST['danhmuc'];

if(isset($_POST['thembaiviet'])){
    //themsp
    $sql_them = "INSERT INTO baiviet(tenbaiviet,hinhanh,tomtat,noidung,tinhtrang,id_danhmuc) VALUE ('$tenbaiviet','$hinhanh','$tomtat','$noidung','$tinhtrang','$danhmuc')";
    mysqli_query($con,$sql_them);
    move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
    header('location:../../index.php?action=quanlybaiviet&query=them');
}elseif(isset($_POST['suabaiviet'])){
  
    //suasp
  if($_FILES['hinhanh']['name'] != ''){
     //nếu chọn hình ảnh thì thêm hình anh
    //xóa hình ảnh cũ
    $sql = "SELECT * FROM baiviet WHERE id ='$_GET[idbaiviet]' LIMIT 1 ";
    $query = mysqli_query($con,$sql);
    while($row= mysqli_fetch_array($query)){
      unlink('uploads/'.$row['hinhanh']);
    }

    move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
    $sql_suabv = "UPDATE baiviet SET tenbaiviet='$tenbaiviet', hinhanh='$hinhanh', tomtat='$tomtat', noidung='$noidung',tinhtrang='$tinhtrang',id_danhmuc='$danhmuc' WHERE id = '$_GET[idbaiviet]'";
    
  }
  else
  {    //nếu k chọn thì k thêm hình ảnh
  
    $sql_suabv = "UPDATE baiviet SET tenbaiviet='$tenbaiviet', tomtat='$tomtat', noidung='$noidung',tinhtrang='$tinhtrang',id_danhmuc='$danhmuc' WHERE id = '$_GET[idbaiviet]'";
   
  }  
    mysqli_query($con,$sql_suabv);
    header('location:../../index.php?action=quanlybaiviet&query=them');
}else{
    //xoasp
    $id= $_GET["idbaiviet"];
    $sql = "SELECT * FROM baiviet where id ='".$id."' LIMIT 1 ";
    $query = mysqli_query($con,$sql);
    while($row= mysqli_fetch_array($query)){
      unlink('uploads/'.$row['hinhanh']);
    }
    $sql_xoabv = "DELETE FROM baiviet WHERE id ='".$id."'";
    mysqli_query($con,$sql_xoabv);
    header('location:../../index.php?action=quanlybaiviet&query=them');
}
?>