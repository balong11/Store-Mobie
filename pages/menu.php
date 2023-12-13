<?php
   $sql_danhmuc = "SELECT * FROM tbl_danhsach ORDER BY id_danhmuc DESC";
   $query_danhmuc = mysqli_query($con,$sql_danhmuc);
     
?>
<?php
if(isset($_GET['dangxuat'])&&$_GET['dangxuat']==1){
    unset($_SESSION['dangky']);
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="width: 100%">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
        <img src="images/lo.jpg" height="40" alt="CoolBrand">
    </a>
    <button class="navbar-toggler" type="button" data-bsimages/bb.jpg-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">trang chủ</a>
        </li>
       
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            danh mục sản phẩm
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
             while($row_danhmuc=mysqli_fetch_array($query_danhmuc)){
             ?>
            <li><a class="dropdown-item" href="index.php?quanly=danhmucsanpham&id=<?php echo $row_danhmuc['id_danhmuc']?>"><?php echo $row_danhmuc['tendanhmuc']?></a></li>
            <?php
              }
             ?>
          </ul>
          <li class="nav-item">
          <a class="nav-link" href="giohang">giỏ hàng</a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tintuc">tin tức</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="lienhe">liên hệ</a>
          </li>
             <?php
              if(isset($_SESSION['dangky'])){
             ?>
             <li class="nav-item"><a class="nav-link" href ="index.php?dangxuat=1">đăng xuất</a></li>
             <li class="nav-item"><a class="nav-link" href ="doimatkhau">đổi mật khẩu</a></li>
             <li class="nav-item"><a class="nav-link" href ="lichsudonhang">lịch sử đơn hàng</a></li>
             <?php
             }else{
             ?>
             <li class="nav-item"><a class="nav-link" href ="dangky">đăng ký</a></li>
             <?php
             }
             ?>
      </ul>
      <form class="d-flex" action="timkiem" method="post">
        <input class="form-control me-2" type="Search"  placeholder="từ khóa..." name="tukhoa" aria-label="Search"  >
        <button class="btn btn-outline-success" name="timkiem" type="submit" >tìm kiếm</button>
      </form>
    </div>
  </div>
</nav>



