<div class="container">
  <?php
  if(isset($_SESSION['id_khachhang'])){
  ?>
  <!-- Responsive Arrow Progress Bar -->
  <div class="arrow-steps clearfix">
    <div class="step done"> <span> <a href="giohang" >giỏ hàng</a></span> </div>
    <div class="step done"> <span><a href="vanchuyen" >vận chuyển</a></span> </div>
    <div class="step done"> <span><a href="thongtinthanhtoan" >thanh toán</a><span> </div>
    <div class="step current"> <span><a href="donhangdadat" >lịch sử đơn hàng</a><span> </div>
  </div>
  <?php
  }
  ?>

</div>
<p>chờ tí</p>