<p>sửa danh mục bài viết</p>
<?php
$sql_sua_danhmucbaiviet = "SELECT * FROM danhmucbaiviet WHERE id_baiviet='$_GET[idbaiviet]' limit 1";
$query_sua_danhmucbaiviet = mysqli_query($con,$sql_sua_danhmucbaiviet);
?>
<table width="50%" style="border-collapse: collapse";>
 <form method="post" action="modules/quanlydanhmucbaiviet/xuly.php?idbaiviet=<?php echo $_GET['idbaiviet']?>">
    <?php
    while($dong=mysqli_fetch_array($query_sua_danhmucbaiviet)){

    ?>
    <tr>
        <td>tên danh mục</td>
        <td><input type="text" value="<?php echo $dong['tendanhmuc']?>" name="tendanhmuc" ></td>
    </tr>
    <tr>
        <td>thứ tự</td>
        <td><input type="text" value="<?php echo $dong['thutu']?>" name="thutu" ></td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="suabaiviet" value="cập nhật danh mục bài viết"/></td>
    </tr>
    <?php
    }
    ?>
 </form>
</table>
