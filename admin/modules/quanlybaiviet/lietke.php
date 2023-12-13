<?php
$sql_lietke_bv = "SELECT * FROM baiviet,danhmucbaiviet WHERE baiviet.id_danhmuc=danhmucbaiviet.id_baiviet  ORDER BY id DESC";
$query_lietke_bv = mysqli_query($con,$sql_lietke_bv);
?>
<p>liệt kê bài viết  </p>
<table width="100%" style="border-collapse: collapse" border="1";>
    <tr>
        <th>id</th>
        <th>tên bài viet</th>
        
        <th>danh mục</th>
        <th>hình ảnh</th>
        <th>tóm tắt</th>
        <th>nội dung</th>
        <th>tình trạng</th>
        <th>quản lý</th>

    <?php
    $i = 0;
    while($row = mysqli_fetch_array($query_lietke_bv)){
        $i++;
    ?>
    </tr>   
        <td><?php echo $i?></td>
        <td><?php echo $row['tenbaiviet']?></td>
        
        <td><?php echo $row['tendanhmuc']?></td> 
        <td><img src="modules/quanlybaiviet/uploads/<?php echo $row['hinhanh']?>" width="150px"></td> 
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
            <a href="modules/quanlybaiviet/xuly.php?idbaiviet=<?php echo $row['id']?>">xoa</a> | <a href="?action=quanlybaiviet&query=sua&idbaiviet=<?php echo $row['id']?>">sua</a>
        </td>
    </tr>
    <?php
    }
    ?>
   
</table>