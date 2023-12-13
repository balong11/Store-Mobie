<p>xem đơn hàng</p>
<?php
$code = $_GET['code'];
$sql_lietke_donhang = "SELECT * FROM tbl_cart_detail,tbl_sanpham WHERE tbl_cart_detail.id_sanpham=tbl_sanpham.id_sanpham 
AND tbl_cart_detail.code_cart='$code' ORDER BY tbl_cart_detail.id_cart_detail DESC";
$query_lietke_donhang = mysqli_query($con,$sql_lietke_donhang);
?>
<table style="width:100%" border="1" style="border-collapse: collapse;">
    <tr>
        <th>id</th>
        <th>mã đơn hàng</th>
        <th>tên sản phẩm</th>
        <th>số lượng</th>
        <th>đơn giá</th>
        <th>thành tiền</th>
        
    <?php
    $i = 0;
    $tongtien = 0;
    while($row = mysqli_fetch_array($query_lietke_donhang)){
        $i++;
        $thanhtien = $row['soluongmua'] * $row['giasanpham'];
        $tongtien += $thanhtien;
    ?>
    </tr>   
        <td><?php echo $i?></td>
        <td><?php echo $row['code_cart']?></td> 
        <td><?php echo $row['tensanpham']?></td> 
        <td><?php echo $row['soluongmua']?></td> 
        <td><?php echo number_format($row['giasanpham']).'vnd' ?></td> 
        <td><?php echo number_format($thanhtien).'vnd' ?></td> 
        
    </tr>
   
    <?php
    }
    ?>
     <tr>
        <td colspan="6" >
            <p style="float:left">tổng tiền : <?php echo number_format($tongtien).'vnd' ?></p>
        </td>

    </tr>
   
</table>