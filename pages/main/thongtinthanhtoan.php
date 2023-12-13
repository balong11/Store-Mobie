<div class="container">
  <?php
  if(isset($_SESSION['id_khachhang'])){
  ?>
  <!-- Responsive Arrow Progress Bar -->
  <div class="arrow-steps clearfix">
    <div class="step done "> <span> <a href="index.php?quanly=giohang" >giỏ hàng</a></span> </div>
    <div class="step done"> <span><a href="index.php?quanly=vanchuyen" >vận chuyển</a></span> </div>
    <div class="step current"> <span><a href="thongtinthanhtoan" >thanh toán</a><span> </div>
    <div class="step "> <span><a href="index.php?quanly=donhangdadat" >lịch sử đơn hàng</a><span> </div>
  </div>
  <?php
  }
  ?>
  <form action="pages/main/xulythanhtoan.php" method="post" >
  <div class="row">
    
  <?php
  //thông tin vận chuyển đã lưu
    $id_dangky = $_SESSION['id_khachhang'];
    $sql_get_vanchuyen = mysqli_query($con,"SELECT * FROM vanchuyen WHERE id_dangky='$id_dangky' LIMIT 1");
    $count = mysqli_num_rows($sql_get_vanchuyen);
    if($count>0){
      $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
      $name = $row_get_vanchuyen['name'];
      $phone = $row_get_vanchuyen['phone'];
      $diachi = $row_get_vanchuyen['diachi'];
      $ghichu = $row_get_vanchuyen['ghichu'];
    }else{
      $name = '';
      $phone = '';
      $diachi = '';
      $ghichu = '';

    }
    ?>

    <!-- thông tin vận chuyển và giỏ hàng -->
    <div class="col-md-8">
      <h4>thông tin vận chuyển và giỏ hàng</h4>
      <ul>
        <li>họ và tên vận chuyển : <b><?php echo $name ?></b></li>
        <li>điện thoại : <b><?php echo $phone ?></b></li>
        <li>địa chỉ : <b><?php echo $diachi ?></b></li>
        <li>ghi chú : <b><?php echo $ghichu ?></b></li>
        <h5>giỏ hàng của bạn:</h5>
        <table style="width: 100%; text-align: center;border-collapse: collapse;" border="1">
            <tr>
              <th>id</th>
              <th>mã sản phẩm</th>
              <th>tên sản phẩm</th>
              <th>hình ảnh</th>
              <th>số lượng</th>
              <th>giá sản phẩm</th>
              <th>thành tiền</th>
              
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
              <td><img src="admin/modules/quanlysanpham/uploads/<?php echo $cart_item['hinhanh'] ?>" width="150px"></td>
              <td>
                <?php echo $cart_item['soluong'] ?>
              </td>
              <td><?php echo number_format($cart_item['giasanpham']).'vnđ' ?></td>
              <td><?php echo number_format($thanhtien).'vnđ' ?></td>

            </tr>
            <?php
              }
            ?>
            <tr>
              <td colspan="8"> 
                  <div style="clear: both;"></div>
                  
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
        </ul>
        
    </div>
    <style  type="text/css">
      .col-md-4.hinhthucthanhtoan .form-check {
          margin: 12px;
      }
    </style>
    <div class="col-md-4 hinhthucthanhtoan">
      <h4>phương thức thanh toán</h4>
      thanh toán khi nhận hàng
      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" id="exampleRadios1" value="tienmat" checked>
        <img src="images/thanh toán.jpg" height="30" width="30">
        <label class="form-check-label" for="exampleRadios1">thanh toán khi nhận hàng</label>
      </div>
  
      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" id="exampleRadios2" value="chuyenkhoan" >
        <img src="images/atm.png" height="40" width="40">
        <label class="form-check-label" for="exampleRadios2">chuyển khoản</label>
      </div>
      
      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" id="exampleRadios3" value="vnpay" >
        <img src="images/vnpay.png" height="30" width="40">
        <label class="form-check-label" for="exampleRadios3">vnpay</label>
      </div>
      
    <div>
    <p>tổng tiền : <b><?php echo number_format($tongtien).'vnđ' ?></b></p>

    <input type="submit" name="redirect" value="thanh toán ngay"  class="btn btn-danger">  
       
    </form>
    </div>
    <p></p>
    <?php
      $tongtien = 0;
      foreach($_SESSION['cart'] as $key => $value){
          $thanhtien = $value['soluong'] * $value['giasanpham'];
          $tongtien += $thanhtien;
      }
    ?> 
    
    <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                   action="pages/main/xulythanhtoan_momo.php">
      <input type="submit" name="momo" value="thanh toán MOMO QRcode" class="btn btn-danger">
      <input type="hidden" name="tongtien" value="<?php echo $tongtien ?>" > 
    
    </form>
      <p></p>
    <form class="" method="POST" target="_blank" enctype="application/x-www-form-urlencoded"
                action="pages/main/xulythanhtoanmomo_atm.php">
      <input type="submit" name="momo" value="thanh toán MOMO ATM" class="btn btn-danger">
      <input type="hidden" name="tongtien" value="<?php echo $tongtien ?>" >  
      
    </form>
    
    </div>
</div>

