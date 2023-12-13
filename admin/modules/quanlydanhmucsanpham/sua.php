<p>sửa danh mục sản phẩm</p>
<?php
$sql_sua_danhmucsanpham = "SELECT * FROM tbl_danhsach WHERE id_danhmuc='$_GET[iddanhmuc]' limit 1";
$query_sua_danhmucsanpham = mysqli_query($con,$sql_sua_danhmucsanpham);
?>
<table width="50%" style="border-collapse: collapse";>
 <form method="post" action="modules/quanlydanhmucsanpham/xuly.php?iddanhmuc=<?php echo $_GET['iddanhmuc']?>">
    <?php
    while($dong=mysqli_fetch_array($query_sua_danhmucsanpham)){

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
        <td colspan="2"><input type="submit" name="suadanhmuc" value="sửa danh mục sản phẩm"/></td>
    </tr>
    <?php
    }
    ?>
 </form>
</table>
