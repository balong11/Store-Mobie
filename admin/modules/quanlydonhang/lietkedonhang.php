<?php
$sql_lietke_donhang = "SELECT * FROM tbl_cart,tbl_dangky WHERE tbl_cart.id_khachhang=tbl_dangky.id_dangky  ORDER BY tbl_cart.id_cart DESC";
$query_lietke_donhang = mysqli_query($con,$sql_lietke_donhang);
?>
<table style="width:100%" border="1" style="border-collapse: collapse;">
    <tr>
        <th>id</th>
        <th>mã đơn hàng</th>
        <th>tên khách hàng</th>
        <th>địa chỉ</th>
        <th>email</th>
        <th>số điện thoại</th>
        <th>tình trạng</th>
        <th>ngày đặt</th>
        <th>quản lý</th>
        <th>in đơn hàng</th>
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
            <a href="index.php?action=donhang&query=xemdonhang&code=<?php echo $row['code_cart']?>">xem đơn hàng</a> 
        </td>
        <td>
            <a href="modules/quanlydonhang/indonhang.php?&code=<?php echo $row['code_cart']?>">in đơn hàng</a> 
        </td>
    </tr>
    <?php
    }
    ?>
   
</table>