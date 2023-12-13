<p>thêm bài viết</p>

<table width="100%" style="border-collapse: collapse"; border="1">
 <form method="post" action="modules/quanlybaiviet/xuly.php" enctype="multipart/form-data">
    <tr>
        <td>tên bài viết</td>
        <td><input type="text" name="tenbaiviet"/></td>
    </tr>
    
    <tr>
        <td>hình ảnh </td>
        <td><input type="file" name="hinhanh" multiple="multiple" /></td>
    </tr>
    <tr></tr>
        <td>tóm tắt</td>
        <td><textarea row="10" name="tomtat" style="resize: none"></textarea></td>
    </tr>
    <tr>
        <td>nội dung</td>
        <td><textarea row="10" name="noidung" style="resize: none"></textarea></td>
    </tr>
    <tr>
        <td>danh mục bài viết</td>
        <td>
            <select name="danhmuc">
                <?php
                $sql_danhmuc = "SELECT * FROM danhmucbaiviet ORDER BY id_baiviet DESC";
                $query_danhmuc = mysqli_query($con,$sql_danhmuc);
                while($row_danhmuc=mysqli_fetch_array($query_danhmuc)){
                ?>
                <option value="<?php echo $row_danhmuc['id_baiviet']?>"><?php echo $row_danhmuc['tendanhmuc']?></option>
                <?php
                }
                ?>
           
            </select>
        </td>
    </tr>
    <tr>
        <td>tình trạng</td>
        <td>
            <select name="tinhtrang">
                <option value="1">kích hoạt </option>
                <option value="0">ẩn </option>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="thembaiviet" value="thêm bài viết"/></td>
    </tr>
 </form>
</table>
