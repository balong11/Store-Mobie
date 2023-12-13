<?php
ob_start();
if(isset($_POST['dangnhap'])){
    // session_destroy();
    $dienthoai = $_POST['dienthoai'];
    $matkhau = $_POST['matkhau'];
    $sql = "SELECT * FROM tbl_dangky WHERE dienthoai='$dienthoai' AND matkhau='$matkhau' LIMIT 1";
    // var_dump("$sql");die;
    $query = mysqli_query($con,$sql);
    $count = mysqli_num_rows($query);
    if($count>0){
        $row = mysqli_fetch_array($query);
        $_SESSION['dangky'] = $row['tenkhachhang'];
        $_SESSION['id_khachhang'] = $row['id_dangky'];

        header("location:index.php");
   
    }else{
        echo '<span style="color:red" >'."tài khoản hoặc mật khẩu không đúng,vui lòng thử lại".'</span>';
        
    }

}
ob_end_flush();
?>

<form method="POST" action="" autocomplete="off">
    <table border="1" class="tabe-login" style="text-align: center; border-collapse:collapse">
    <tr>
        <td colspan="2" ><h3>đăng nhập tài khoản</h3></td>
    </tr>
    <tr>
        <td>username</td>
        <td><input type="text" size="30" name="dienthoai" placeholder="điện thoại..." ></td>
    </tr>
    <tr>
        <td>pasword</td>
        <td><input type="text" size="30" name="matkhau" placeholder="mật khẩu..." ></td>
        
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="dangnhap" value="đăng nhập"></td>
    </tr>
    </table>
</form>
