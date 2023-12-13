<p>sửa bài viết</p>
<?php
$sql_sua_bv = "SELECT * FROM baiviet WHERE id='$_GET[idbaiviet]' limit 1";
$query_sua_bv = mysqli_query($con,$sql_sua_bv);
?>
<table width="100%" style="border-collapse: collapse";>
<?php
    while($dong=mysqli_fetch_array($query_sua_bv)){

    ?>
 <form method="post" action="modules/quanlybaiviet/xuly.php?idbaiviet=<?php echo $dong['id']?>" enctype="multipart/form-data">
   
    <tr>
        <td>tên bài viết</td>
        <td><input type="text" value="<?php echo $dong['tenbaiviet']?>" name="tenbaiviet" ></td>
    </tr>
   
    <tr>
        <td>hình ảnh</td>
        <td><input type="file" name="hinhanh" >
              <img src="modules/quanlysanpham/uploads/<?php echo $row['hinhanh']?>" width="150px">
        </td>
    </tr>
    <tr>
        <td>tóm tắt</td>
        <td><textarea row="10" style="resize: none" name="tomtat" value="<?php echo $dong['tomtat']?>"  ></textarea></td>
    </tr>
    <tr>
        <td>nội dung</td>
        <td><textarea row="10" style="resize: none" name="noidung" value="<?php echo $dong['noidung']?>"  ></textarea></td>
    </tr>
    <tr>
        <td>danh mục bài viết</td>
        <td>
            <select name="danhmuc">
                <?php
                $sql_danhmuc = "SELECT * FROM danhmucbaiviet ORDER BY id_baiviet DESC";
                $query_danhmuc = mysqli_query($con,$sql_danhmuc);
                while($row_danhmuc=mysqli_fetch_array($query_danhmuc)){
                    if($row_danhmuc['id_baiviet']==$row['id_danhmuc']){
                ?>
                <option selected value="<?php echo $row_danhmuc['id_baiviet']?>"><?php echo $row_danhmuc['tendanhmuc']?></option>
                <?php
                    }else{
                ?>
                <option value="<?php echo $row_danhmuc['id_baiviet']?>"><?php echo $row_danhmuc['tendanhmuc']?></option>
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
        <td colspan="2"><input type="submit" name="suabaiviet" value="cập nhật bài viết"/></td>
    </tr>
    <?php
    }
    ?>
 </form>
</table>
