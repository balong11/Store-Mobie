<?php
if(isset($_POST['doi'])){
    // session_destroy();
    $taikhoan = $_POST['dienthoai'];
    $matkhau_cu = $_POST['password_cu'];
    $matkhau_moi = $_POST['password_moi'];
    $sql = "SELECT * FROM tbl_dangky WHERE dienthoai='$taikhoan' AND matkhau='$matkhau_cu' LIMIT 1";
    $query = mysqli_query($con,$sql);
    $count = mysqli_num_rows($query);
    if($count>0){
        $sql_update = mysqli_query($con,"UPDATE tbl_dangky SET  matkhau='$matkhau_moi'");
        echo '<p style="color:green">mật khẩu đã được thay đổi</p>';
        // var_dump($taikhoan,$matkhau);die;
    }else{
        echo '<p style="color:red">tài khoản hoặc mật khẩu cũ,vui lòng thử lại</p>';

    }

}
?>
<form method="POST" action="" autocomplete="off">
    <table border="1" class="tabe-login" style="text-align: center; border-collapse:collapse">
    <tr>
        <td colspan="2" ><h3>đổi mật khẩu tài khoản</h3></td>
    </tr>
    <tr>
        <td>tài khoản</td>
        <td><input type="text" size="30" name="dienthoai" placeholder="điện thoại..."></td>
    </tr>
    <tr>
        <td>mật khẩu cũ</td>
        <td><input type="text" size="30" name="password_cu" placeholder="mật khẩu cũ..."></td>
        
    </tr>
    <tr>
        <td>mật khẩu mới</td>
        <td><input type="text" size="30" name="password_moi" placeholder="mật khẩu mới..."></td>
        
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="doi" value="đổi mật khẩu"></td>
    </tr>
    </table>
</form>