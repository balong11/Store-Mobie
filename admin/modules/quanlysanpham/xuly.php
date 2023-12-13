<?php
include '../../config/connectdb.php';
$tensanpham = $_POST['tensanpham'];
$masp = $_POST['masanpham'];
$giasp = $_POST['giasanpham'];
$soluong = $_POST['soluong'];
//xử lý hình ảnh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh_n = time() . '_' . $hinhanh;

$tomtat = $_POST['tomtat'];
$noidung = $_POST['noidung'];
$tinhtrang = $_POST['tinhtrang'];
$danhmuc = $_POST['danhmuc'];

if (isset($_POST['themsanpham'])) {
    //themsp
    

    $sql_themsp = "INSERT INTO tbl_sanpham(tensanpham,masanpham,giasanpham,soluong,hinhanh,tomtat,noidung,tinhtrang,id_danhmuc) VALUE ('$tensanpham','$masp','$giasp','$soluong','$hinhanh','$tomtat','$noidung','$tinhtrang','$danhmuc')";
    mysqli_query($con, $sql_themsp);
    move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);

    // upload multiple image
    if(isset($_FILES['labrary'])){
        $total = count($_FILES['labrary']['name']); 
        $image_tmp = $_FILES['labrary']['tmp_name'];
        $idNew = mysqli_insert_id($con);
        $file['type'] = 'image/jpeg' || 'image/jpg' || 'image/png';
        // $time = time() . '_' . $_FILES['labrary']['name'];
        // var_dump($image_tmp);die;
        foreach ($_FILES['labrary']['name'] as $key =>$value){
            mysqli_query($con,"INSERT INTO image_sp(name,id_sp,created) VALUE ($tmpFilePath,$idNew,  $time)");
            move_uploaded_file($image_tmp.[$key],'uploads/'.$value);
    
        }

    }
   
    // for ($i = 0; $i < $total; $i++) {

    //     $tmpFilePath = $_FILES['labrary']['tmp_name'][$i];

    //     if ($tmpFilePath != "") {
    //         $newFilePath = "./uploads/product/" . $_FILES['labrary']['name'][$i] . $time;

    //         if (move_uploaded_file($tmpFilePath, $newFilePath)) {
    //             mysqli_query($conn,"INSERT INTO image_sp(name,id_sp,created) VALUE ($tmpFilePath,$idNew,  $time)") ;
    //         }
    //     }
    // }
    

    header('location:../../index.php?action=quanlysanpham&query=them');
} elseif (isset($_POST['suasanpham'])) {

    //suasp
    if ($_FILES['hinhanh']['name'] != '') { //nếu chọn hình ảnh thì thêm hình anh

        //xóa hình ảnh cũ
        $sql = "SELECT * FROM tbl_sanpham where id_sanpham ='$_GET[idsanpham]' LIMIT 1 ";
        $query = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('uploads/' . $row['hinhanh']);
        }

        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
        $sql_suasp = "UPDATE tbl_sanpham SET tensanpham='$tensanpham', masanpham='$masp', giasanpham='$giasp', soluong='$soluong', hinhanh='$hinhanh', tomtat='$tomtat', noidung='$noidung',tinhtrang='$tinhtrang',id_danhmuc='$danhmuc' WHERE id_sanpham = '$_GET[idsanpham]'";

    } else { //nếu k chọn thì k thêm hình ảnh

        $sql_suasp = "UPDATE tbl_sanpham SET tensanpham='$tensanpham', masanpham='$masp', giasanpham='$giasp', soluong='$soluong',tomtat='$tomtat', noidung='$noidung',tinhtrang='$tinhtrang',id_danhmuc='$danhmuc' WHERE id_sanpham = '$_GET[idsanpham]'";

    }
    mysqli_query($con, $sql_suasp);
    header('location:../../index.php?action=quanlysanpham&query=them');
} else {
    //xoasp
    $id = $_GET["idsanpham"];
    $sql = "SELECT * FROM tbl_sanpham where id_sanpham ='" . $id . "' LIMIT 1 ";
    $query = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_array($query)) {
        unlink('uploads/' . $row['hinhanh']);
    }
    $sql_xoasp = "DELETE FROM tbl_sanpham WHERE id_sanpham ='" . $id . "'";
    mysqli_query($con, $sql_xoasp);
    header('location:../../index.php?action=quanlysanpham&query=them');
}
