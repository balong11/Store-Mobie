<p>sửa sản phẩm</p>
<?php
$sql_sua_sanpham = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[idsanpham]' limit 1";
$query_sua_sanpham = mysqli_query($con,$sql_sua_sanpham);
?>
<table width="100%" style="border-collapse: collapse";>
 <form method="post" action="modules/quanlysanpham/xuly.php?idsanpham=<?php echo $_GET['idsanpham']?>" enctype="multipart/form-data">
    <?php
    while($row=mysqli_fetch_array($query_sua_sanpham)){

    ?>
    <tr>
        <td>tên sản phẩm</td>
        <td><input type="text" value="<?php echo $row['tensanpham']?>" name="tensanpham" ></td>
    </tr>
    <tr>
        <td>mã sản phẩm</td>
        <td><input type="text" value="<?php echo $row['masanpham']?>" name="masanpham" ></td>
    </tr>
    <tr>
        <td>giá sản phẩm</td>
        <td><input type="int" value="<?php echo $row['giasanpham']?>" name="giasanpham" ></td>
    </tr>
    <tr>
        <td>số lượng sản phẩm</td>
        <td><input type="text" value="<?php echo $row['soluong']?>" name="soluong" ></td>
    </tr>
    <tr>
        <td>hình ảnh</td>
        <td>
            <input type="file" name="hinhanh" >
            <img src="uploads/<?php echo $row['hinhanh']?>" alt="">
        </td>
    </tr>
    <tr>
        <td>tóm tắt</td>
        <td><textarea row="" style="resize: none" name="tomtat" value="<?php echo $row['tomtat']?>"  ></textarea></td>
    </tr>
    <tr>
        <td>nội dung</td>
        <td><textarea row="10" style="resize: none" name="noidung" value="<?php echo $row['noidung']?>"  ></textarea></td>
    </tr>
    <tr>
        <td>danh mục sản phẩm</td>
        <td>
            <select name="danhmuc">
                <?php
                $sql_danhmuc = "SELECT * FROM tbl_danhsach ORDER BY id_danhmuc DESC";
                $query_danhmuc = mysqli_query($con,$sql_danhmuc);
                while($row_danhmuc=mysqli_fetch_array($query_danhmuc)){
                    if($row_danhmuc['id_danhmuc']==$row['id_danhmuc']){
                ?>
                <option selected value="<?php echo $row_danhmuc['id_danhmuc']?>"><?php echo $row_danhmuc['tendanhmuc']?></option>
                <?php
                    }else{
                ?>
                <option value="<?php echo $row_danhmuc['id_danhmuc']?>"><?php echo $row_danhmuc['tendanhmuc']?></option>
                <?php
                    }
                }
                ?>       
           
            </select>
        </td>
    <tr>
        <td>tình trạng</td>
        <td>
            <select name="tinhtrang">
                <?php
                if($row['tinhtrang']==1){
                ?>
                <option value="1" selected>kích hoạt</option>
                <option value="0">ẩn</option>
                <?php
                }else{
                ?>
                <option value="1">kích hoạt</option>
                <option value="0" selected>ẩn</option>
                <?php
                }
                ?>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="suasanpham" value="sửa sản phẩm"/></td>
    </tr>
    <?php
    }
    ?>
 </form>
</table>
