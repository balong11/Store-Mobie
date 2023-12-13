<p>thêm sản phẩm</p>

<table width="100%" style="border-collapse: collapse"; border="1">
 <form method="post" action="modules/quanlysanpham/xuly.php" enctype="multipart/form-data">
    <tr>
        <td>tên sản phẩm</td>
        <td><input type="text" name="tensanpham"/></td>
    </tr>
    <tr>
        <td>mã sản phẩm</td>
        <td><input type="text" name="masanpham"/></td>
    </tr>
    <tr>
        <td>giá sản phẩm</td>
        <td><input type="int" name="giasanpham"/></td>
    </tr>
    <tr>
        <td>số lượng sản phẩm</td>
        <td><input type="text" name="soluong"/></td>
    </tr>
    <tr>
        <td>hình ảnh</td>
        <td><input type="file" name="hinhanh"/></td>
    </tr>
    <tr>
        <td>ảnh mô tả</td>
        <td><input type="file" name="labrary[]" multiple="multiple"/></td>
    </tr>
    <tr>
        <td>tóm tắt</td>
        <td><textarea row="10" name="tomtat" style="resize: none"></textarea></td>
    </tr>
    <tr>
        <td>nội dung</td>
        <td><textarea row="10" name="noidung" style="resize: none"></textarea></td>
    </tr>
    <tr>
        <td>danh mục sản phẩm</td>
        <td>
            <select name="danhmuc">
                <?php
                $sql_danhmuc = "SELECT * FROM tbl_danhsach ORDER BY id_danhmuc DESC";
                $query_danhmuc = mysqli_query($con,$sql_danhmuc);
                while($row_danhmuc=mysqli_fetch_array($query_danhmuc)){
                ?>
                <option value="<?php echo $row_danhmuc['id_danhmuc']?>"><?php echo $row_danhmuc['tendanhmuc']?></option>
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
                <option value="1">kích hoạt sản phẩm</option>
                <option value="0">ẩn sản phẩm</option>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="themsanpham" value="thêm sản phẩm"/></td>
    </tr>
 </form>
</table>
