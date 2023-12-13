<?php
if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1){
    unset($_SESSION['login']);
    header("location:login.php");
}
?>

<ul class="admin_list">
    <li><a href = "index.php?action=quanlydanhmucsanpham&query=them">quản lý danh mục sản phẩm"</a></li>
    <li><a href = "index.php?action=quanlysanpham&query=them">quản lý sản phẩm"</a></li>
    <li><a href = "index.php?action=quanlydanhmucbaiviet&query=them">quản lý danh mục  bài viết"</a></li>
    <li><a href = "index.php?action=quanlybaiviet&query=them">quản lý bài viết"</a></li>
    <li><a href = "index.php?action=quanlydonhang&query=lietke">quản lý đơn hàng"</a></li>
    <li><a href = "index.php?action=quanlyweb&query=capnhat">thông tin liên hệ"</a></li>
    <li><a href = "index.php">thống kê"</a></li>

    <li><a href = "index.php?dangxuat=1">Đăng Xuất : <?php if(isset($_SESSION['login'])){
         echo $_SESSION['login'];
    }?>"</a></li>


</ul>