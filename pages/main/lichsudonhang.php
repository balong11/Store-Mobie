<h3>lịch sử đơn hàng</h3>
<?php
$id_khachang = $_SESSION['id_khachhang'];
$sql_lietke_donhang = "SELECT * FROM tbl_cart,tbl_dangky WHERE tbl_cart.id_khachhang=tbl_dangky.id_dangky AND 
        tbl_cart.id_khachhang='$id_khachang'  ORDER BY tbl_cart.id_cart DESC";
$query_lietke_donhang = mysqli_query($con,$sql_lietke_donhang);
?>
<table style="width:100%" border="1" style="border-collapse: collapse;">
    <tr>
        <th>id</th>
        <th>mã đơn hàng</th>
        <th>tên khách hàng</th>
        <th>email</th>
        <th>địa chỉ</th>
        <th>số điện thoại</th>
        <th>tình trạng</th>
        <th>ngày đặt</th>
        <th>quản lý</th>
        <!-- <th>in đơn hàng</th> -->
        <th>hình thức thanh toán</th>
    <?php
    $i = 0;
    while($row = mysqli_fetch_array($query_lietke_donhang)){
        $i++;
    ?>
    </tr>   
        <td><?php echo $i?></td>
        <td><?php echo $row['code_cart']?></td> 
        <td><?php echo $row['tenkhachhang']?></td> 
        <td><?php echo $row['email']?></td> 
        <td><?php echo $row['diachi']?></td> 
        <td><?php echo $row['dienthoai']?></td> 
        <td>
            <?php 
            if($row['cart_status']==1){
                echo '<a href="modules/quanlydonhang/xuly.php?&code='.$row['code_cart'].'">đơn hàng mới</a>';
            }else{
                echo "đã xem";
            }
            ?>
        </td>
        <td><?php echo $row['ngaydat']?></td> 

        <td>
            <a href="index.php?quanly=xemdonhang&code=<?php echo $row['code_cart']?>">xem đơn hàng</a> 
        </td>
        <!-- <td>
            <a href="pages/main/indonhang.php?&code=<?php echo $row['code_cart']?>">in đơn hàng</a> 
        </td> -->
        <td>
            <?php 
            if($row['cart_thanhtoan']=='vnpay' || $row['cart_thanhtoan']=='momo'){
            ?>
            <a href="index.php?quanly=lichsudonhang&congthanhtoan=<?php echo $row['cart_thanhtoan']?>&code_cart=<?php echo $row['code_cart']?>"><?php echo $row['cart_thanhtoan']?></a>
            <?php 
            }else{
            ?>
            <?php echo $row['cart_thanhtoan']?>
            <?php 
            }
            ?>
        </td>
    </tr>
    <?php
    }
    ?>
   
</table>
<?php
if(isset($_GET['congthanhtoan'])){
    $congthanhtoan = $_GET['congthanhtoan'];
    $code_cart = $_GET['code_cart'];
    echo '<h4>chi tiết thanh toán qua cổng thanh toán :  '.$congthanhtoan.' </h4>';
    if($congthanhtoan=='momo'){
        $sql_momo = mysqli_query($con,"SELECT * FROM momo WHERE code_cart='$code_cart' LIMIT 1");
        $row_momo = mysqli_fetch_array($sql_momo);
    ?>
    <table style="width:100%" border="1" style="border-collapse: collapse;">
    <thead>
      <tr>
        <th>partner_code</th>
        <th>order_id</th>
        <th>amount</th>
        <th>order_info</th>
        <th>order_type</th>
        <th>trans_id</th>
        <th>pay_type</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $row_momo['partner_code']?></td>
        <td><?php echo $row_momo['order_id']?></td>
        <td><?php echo $row_momo['amount']?></td>
        <td><?php echo $row_momo['order_info']?></td>
        <td><?php echo $row_momo['order_type']?></td>
        <td><?php echo $row_momo['trans_id']?></td>
        <td><?php echo $row_momo['pay_type']?></td>
      </tr>
        </tbody>
    </table>
    <?php
    }elseif($congthanhtoan=='vnpay'){
        $sql_vnpay = mysqli_query($con,"SELECT * FROM vnpay WHERE code_cart='$code_cart' LIMIT 1");
        $row_vnpay = mysqli_fetch_array($sql_vnpay);
    ?>
    <table style="width:100%" border="1" style="border-collapse: collapse;">
    <thead>
      <tr>
        <th>nganhang</th>
        <th>tongtien</th>
        <th>magiaodich</th>
        <th>loaithe</th>
        <th>noidungtt</th>
        <th>paydate</th>
        <th>tmncode</th>
        <th>transactionno</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $row_vnpay['nganhang']?></td>
        <td><?php echo $row_vnpay['tongtien']?></td>
        <td><?php echo $row_vnpay['magiaodich']?></td>
        <td><?php echo $row_vnpay['loaithe']?></td>
        <td><?php echo $row_vnpay['noidungtt']?></td>
        <td><?php echo $row_vnpay['paydate']?></td>
        <td><?php echo $row_vnpay['tmncode']?></td>
        <td><?php echo $row_vnpay['transactionno']?></td>
      </tr>
        </tbody>
    </table>
<?php 
    }
}
?>