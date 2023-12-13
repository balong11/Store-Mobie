<?php
$sql_lietke_danhmucbaiviet = "SELECT * FROM danhmucbaiviet  ORDER BY thutu DESC";
$query_lietke_danhmucbaiviet = mysqli_query($con,$sql_lietke_danhmucbaiviet);
?>
<p>liệt kê danh mục bài viết  </p>
<table width="100%" style="border-collapse: collapse" border="1";>
    <tr>
        <th>id</th>
        <th>tên danh mục</th>
        <th>quản lý</th>
    <?php
    $i = 0;
    while($row = mysqli_fetch_array($query_lietke_danhmucbaiviet)){
        $i++;
    ?>
    </tr>   
        <td><?php echo $i?></td>
        <td><?php echo $row['tendanhmuc']?></td> 
        <td>
            <a href="modules/quanlydanhmucbaiviet/xuly.php?idbaiviet=<?php echo $row['id_baiviet']?>">xoa</a> | <a href="?action=quanlydanhmucbaiviet&query=sua&idbaiviet=<?php echo $row['id_baiviet']?>">sua</a>
        </td>
    </tr>
    <?php
    }
    ?>
   
</table>