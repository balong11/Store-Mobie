<?php
$sql_lietke_danhmucsanpham = "SELECT * FROM tbl_danhsach  ORDER BY thutu DESC";
$query_lietke_danhmucsanpham = mysqli_query($con,$sql_lietke_danhmucsanpham);
?>
<p>liệt kê danh mục sản phẩm  </p>
<table width="100%" style="border-collapse: collapse" border="1";>
    <tr>
        <th>id</th>
        <th>tên danh mục</th>
        <th>quản lý</th>
    <?php
    $i = 0;
    while($row = mysqli_fetch_array($query_lietke_danhmucsanpham)){
        $i++;
    ?>
    </tr>   
        <td><?php echo $i?></td>
        <td><?php echo $row['tendanhmuc']?></td> 
        <td>
            <a href="modules/quanlydanhmucsanpham/xuly.php?iddanhmuc=<?php echo $row['id_danhmuc']?>">xoa</a> | <a href="?action=quanlydanhmucsanpham&query=sua&iddanhmuc=<?php echo $row['id_danhmuc']?>">sua</a>
        </td>
    </tr>
    <?php
    }
    ?>
   
</table>