<?php
 ob_start();
if(isset($_POST['dangky'])){
    // session_destroy();
    $hovaten = $_POST['hovaten'];
    $email = $_POST['email'];
    $diachi = $_POST['diachi'];
    $matkhau = $_POST['matkhau'];
    $dienthoai = $_POST['dienthoai'];
    $sql_dangky = mysqli_query($con,"INSERT INTO tbl_dangky(tenkhachhang,email,diachi,matkhau,dienthoai) 
    VALUE ('$hovaten','$email','$diachi','$matkhau','$dienthoai') ");
    if($sql_dangky){
        echo '<p style="color:red" >bạn đã đăng ký thành công</p>';
        $_SESSION['dangky'] = $hovaten;
        $_SESSION['id_khachhang'] = mysqli_insert_id($con);
       
        header("location:index.php?quanly=giohang");
    }  
         

}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>đăng ký tài khoản</title>
    <style type="text/css">
        body{
            background: #f2f2f2;
        }
        .wrapper-resigter {
            width: 34%;
            margin: 0 auto;
        }
        form.table-register {
            width: 100%;
        }
        form.table-register tr td {
            padding: 5px;
        }

    </style>
</head>
<body>
<div class="wrapper-resigter">
    <form  method="POST"  autocomplete="off" action="">
        <table border="1" class="table-register" style="text-align: center; border-collapse:collapse">
        <tr>
            <td colspan="6"><h3>Đăng Ký Tài Khoản</h3></td>
        </tr>
        <tr>
            <td>họ và tên</td>
            <td><input type="text" size="30" name="hovaten"></td>
        </tr>
        <tr>
            <td>email </td>
            <td><input type="text" size="30" name="email"></td>
        </tr>
        <tr>
            <td>địa chỉ</td>
            <td><input type="text" size="30" name="diachi"></td>
        </tr>
        <tr>
            <td>mật khẩu</td>
            <td><input type="text" size="30" name="matkhau"></td>
        </tr>
        <tr>
            <td>điện thoại</td>
            <td><input type="text" size="30" name="dienthoai"></td>
        </tr>
        <tr>
            <td ><input type="submit" name="dangky" value="đăng ký"></td>
            <td ><a href="dangnhap" > đăng Nhập</a></td>
        </tr>
        </table>
    </form>
</div>    
</body>
</html>
