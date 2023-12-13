<div class="container">
  <?php
  if(isset($_SESSION['id_khachhang'])){
  ?>
  <!-- Responsive Arrow Progress Bar -->
  <div class="arrow-steps clearfix">
    <div class="step done"> <span> <a href="giohang" >giỏ hàng</a></span> </div>
    <div class="step current"> <span><a href="vanchuyen" >vận chuyển</a></span> </div>
    <div class="step "> <span><a href="thongtinthanhtoan" >thanh toán</a><span> </div>
    <div class="step "> <span><a href="donhangdadat" >lịch sử đơn hàng</a><span> </div>
  </div>
  <?php
  }
  ?>
<h3>thông tin vận chuyển</h3>
<!--thêm vận chuyển-->
<?php
  if(isset($_POST['themvanchuyen'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];  
    $diachi = $_POST['diachi'];
    $ghichu = $_POST['ghichu'];
    $id_dangky = $_SESSION['id_khachhang'];
    $sql_them_vanchuyen = mysqli_query($con,"INSERT INTO vanchuyen (name,phone,diachi,ghichu,id_dangky) 
                VALUE('$name','$phone','$diachi','$ghichu','$id_dangky')");
    if($sql_them_vanchuyen){
      echo '<script style="color:red">alert(thêm vận chuyển thành công)</script>';
    }
//cập nhật vận chuyển
  }elseif(isset($_POST['capnhatvanchuyen'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $diachi = $_POST['diachi'];
    $ghichu = $_POST['ghichu'];
    $id_dangky = $_SESSION['id_khachhang'];
    $sql_update_vanchuyen = mysqli_query($con,"UPDATE vanchuyen 
        SET name='$name',phone='$phone',diachi='$diachi',ghichu='$ghichu',id_dangky='$id_dangky'
        WHERE id_dangky='$id_dangky'") ;
              
    if($sql_update_vanchuyen){
      echo '<script style="color:red">alert(cập nhật vận chuyển thành công)</script>';
    }
  }
?>
<!--lấy vận chuyển có đã có-->
<?php

    // $id_dangky = $_SESSION['id_khachhang'];

    $sql_get_vanchuyen = mysqli_query($con,"SELECT * FROM vanchuyen WHERE id_dangky LIMIT 1");
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
<div class="row">
  <div class="col-md-12">
    <form action="" autocomplete="off" method="post">
    <div class="form-group">
        <label for="email">họ tên:</label>
        <input type="text" name="name" class="form-control" value="<?php echo $name ?>" placeholder="......" >
    </div>
    <div class="form-group">
        <label for="pwd">điện thoai:</label>
        <input type="text" name="phone" class="form-control" value="<?php echo $phone ?>" placeholder="......" >
    </div>
    <div class="form-group">
        <label for="pwd">địa chỉ:</label>
        <input type="text" name="diachi" class="form-control" value="<?php echo $diachi ?>" placeholder="......" >
    </div>
    <div class="form-group">
        <label for="pwd">ghi chú:</label>
        <input type="text" name="ghichu" class="form-control" value="<?php echo $ghichu ?>" placeholder="......" >
    </div>
    <?php
    if($name=='' && $phone==''){

    ?>
    <button type="submit" name="themvanchuyen" class="btn btn-primary">thêm vận chuyển</button>
    <?php
    }elseif($name!='' && $phone!=''){
    ?>
    <button type="submit" name="capnhatvanchuyen" class="btn btn-success">cập nhật vận chuyển</button>
    <?php
    }
    ?>
    </form>
  </div>

  
  <table style="width: 100%; text-align: center" border-collapse: collapse; border="1" >
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
        <td><img src="admin/modules/quanlysanpham/uploads/<?php echo $cart_item['hinhanh']; ?>" width="150px"></td>
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
            <p style="float: left;">tổng tiền : <?php echo number_format($tongtien).'vnđ' ?></p>
          
            <div style="clear: both;"></div>
            <?php
            if(isset($_SESSION['dangky'])){
            ?>
              <p><a href="thongtinthanhtoan">hình thức thanh toán</a></p>
          
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
</div>
