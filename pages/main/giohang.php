
<?php
 if(isset($_SESSION['dangky'])){
  echo "Xin Chào :" . '<span style="color:red">'.$_SESSION['dangky'].'</span>';
  // echo '<p style="color:green" >chào mừng bạn đến với giỏ hàng</p>';

 }
 $sql_sp = "SELECT * FROM tbl_sanpham,tbl_danhsach 
 WHERE tbl_sanpham.id_danhmuc = tbl_danhsach.id_danhmuc limit 1";
 $query_sp = mysqli_query($con,$sql_sp);
 $row_sp = mysqli_fetch_array($query_sp);

?>
<!---lấy số lượng sản phẩm đang có--->
<form method="post" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_sp['id_sanpham'] ?>">
<p><?php $soluong = $row_sp['soluong'] ?></p>

<?php
 if(isset($_SESSION['cart'])){
 
 }
?>

<?php
 if(isset($_SESSION['id_khachhang'])){
?>
<div class="container">
  <!-- Responsive Arrow Progress Bar -->
  <div class="arrow-steps clearfix">
    <div class="step current"> <span> <a href="giohang" >giỏ hàng</a></span> </div>
    <div class="step"> <span><a href="vanchuyen" >vận chuyển</a></span> </div>
    <div class="step"> <span><a href="thongtinthanhtoan" >thanh toán</a><span> </div>
    <div class="step"> <span><a href="index.php?quanly=donhangdadat" >lịch sử đơn hàng</a><span> </div>
  </div>

</div>
<?php
}
?>
<table style="width: 100%; text-align: center;border-collapse: collapse;" border="1"  >
  <tr>
    <th>id</th>
    <th>mã sản phẩm</th>
    <th>tên sản phẩm</th>
    <th>hình ảnh</th>
    <th>số lượng</th>
    <th>giá sản phẩm</th>
    <th>thành tiền</th>
    <th>quản lý</th>
  </tr>
  <?php
  if(isset($_SESSION['cart'])){
    $i = 0;
    $tongtien = 0; 
    foreach($_SESSION['cart'] as $cart_item){
        $thanhtien = $cart_item['soluong'] * $cart_item['giasanpham'];
        $tongtien += $thanhtien;
        $i++;
  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $cart_item['masanpham'] ?></td>
    <td><?php echo $cart_item['tensanpham'] ?></td>
    <td><img src="admin/modules/quanlysanpham/uploads/<?php echo $cart_item['hinhanh']; ?>" width="150px"></td>
    <td>
      <a href="pages/main/themgiohang.php?cong=<?php echo $cart_item['id']?>"><i class="fa-solid fa-plus fa-style" ></i></a>
      <?php echo $cart_item['soluong'] ?>
      <a href="pages/main/themgiohang.php?tru=<?php echo $cart_item['id']?>"><i class="fa-solid fa-minus fa-style"></i></a>
    </td>
    <td><?php echo number_format($cart_item['giasanpham']).'vnđ' ?></td>
    <td><?php echo number_format($thanhtien).'vnđ' ?></td>
    <td><a href="pages/main/themgiohang.php?xoa=<?php echo $cart_item['id']?>">xóa</a></td>

  </tr>
  <?php
    }
  ?>
   <tr>
    <td colspan="8"> 
        <p style="float: left;">tổng tiền : <?php echo number_format($tongtien).'vnđ' ?></p>
        <p style="float: right;"><a href="pages/main/themgiohang.php?xoatoanbo=1">xóa toàn bộ</a></p>
        <div style="clear: both;"></div>
        <?php
        $soluongmua = $cart_item['soluong'];
        // var_dump($soluongmua);die;
        if(isset($_SESSION['dangky'])&($soluong>=$soluongmua)){
        ?>
          <p><a href="vanchuyen">hình thức vận chuyển</a></p>
       
        <?php
        
        }elseif($soluong<$soluongmua){
        ?>
          <?php echo "khong du so luong" ?>
        <?php
        }else{
        ?>  
          <p><a href="dangky">đăng ký đặt hàng</a></p>
        <?php         
        }
        ?>
    </td>
  </tr>
  <?php
  }else{
  ?>
  
  <tr>
    <td colspan="8"><p>giỏ hàng trống</p></td>
  </tr>
  <?php
  }
  ?>
  
</table>
