<?php
$sql_lietke_sanpham = "SELECT * FROM tbl_sanpham,tbl_danhsach WHERE tbl_sanpham.id_danhmuc=tbl_danhsach.id_danhmuc  ORDER BY id_sanpham DESC";
$query_lietke_sanpham = mysqli_query($con,$sql_lietke_sanpham);
?>
<p>liệt kê sản phẩm  </p>
<table width="100%" style="border-collapse: collapse" border="1";>
    <tr>
        <th>id</th>
        <th>tên sản phẩm</th>
        <th>mã sản phẩm</th>
        <th>giá sản phẩm</th>
        <th>số lượng sản phẩm</th>
        <th>danh mục</th>
        <th>hình ảnh</th>
        <th>tóm tắt</th>
        <th>nội dung</th>
        <th>tình trạng</th>
        <th>quản lý</th>

    <?php
    $i = 0;
    while($row = mysqli_fetch_array($query_lietke_sanpham)){
        $i++;
    ?>
    </tr>   
        <td><?php echo $i?></td>
        <td><?php echo $row['tensanpham']?></td>
        <td><?php echo $row['masanpham']?></td> 
        <td><?php echo $row['giasanpham']?></td> 
        <td><?php echo $row['soluong']?></td> 
        <td><?php echo $row['tendanhmuc']?></td> 
        <td><img src="modules/quanlysanpham/uploads/<?php echo $row['hinhanh']?>" width="150px"></td>  
        <td><?php echo $row['tomtat']?></td> 
        <td><?php echo $row['noidung']?></td> 
        <td><?php if($row['tinhtrang']==1){
              echo "kích hoạt";
            }else{
                echo "ẩn";
              }
             ?>
        </td>  
        <td>
            <a href="modules/quanlysanpham/xuly.php?idsanpham=<?php echo $row['id_sanpham']?>">xoa</a> | <a href="?action=quanlysanpham&query=sua&idsanpham=<?php echo $row['id_sanpham']?>">sua</a>
        </td>
    </tr>
    <?php
    }
    ?>
   
</table>