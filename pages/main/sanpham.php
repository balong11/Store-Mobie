<p>chi tiết sản phẩm</p>
<?php
    if(isset($_GET['message']))
    {
        echo '<span style="color: red">'.$_GET['message'].'</span>';
    }
    ?>
<?php
    
    $sql_chitiet = "SELECT * FROM tbl_sanpham,tbl_danhsach 
    WHERE tbl_sanpham.id_danhmuc = tbl_danhsach.id_danhmuc
    AND tbl_sanpham.id_sanpham = '$_GET[id]' limit 1";
    $query_chitiet = mysqli_query($con,$sql_chitiet);
    while($row_chitiet = mysqli_fetch_array($query_chitiet)){
?>
<div class="warper_chitiet">
        <div class="hinhanh_sanpham">
            <img width="100%" src="admin/modules/quanlysanpham/uploads/<?php echo $row_chitiet['hinhanh']?> ">
        </div>
        <form method="post" action="pages/main/themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham'] ?>">
        <div class="chitiet_sanpham">
            <h3 class="margin:0">Tên sản phẩm : <?php echo $row_chitiet['tensanpham'] ?></h3>
            <p>Mã sản phẩm : <?php echo $row_chitiet['masanpham'] ?></p>
            <p>Giá sản phẩm : <?php echo number_format( $row_chitiet['giasanpham']).'vnd' ?></p>
            <p>Số lượng sản phẩm còn lại: <?php echo $row_chitiet['soluong'] ?></p>
            <p>danh mục sp : <?php echo $row_chitiet['tendanhmuc'] ?></p>
            <p><input  class="themgiohang" name="themgiohang" type="submit" value = "thêm giỏ hàng"></p>
            <?php
            if($row_chitiet['soluong']==0){
                echo "sản phẩm đang hết hàng";
            }
            ?>
            <p>
                <input  class="themgiohang" type="submit" name="themgiohang" value="Mua Ngay" >
            </p>
          
        </div>
        </form>
</div>
<div class="clear"></div>
<div class="tabs">
    <ul id="tabs-nav">
        <li><a href="#tab1">thông số kĩ thuật</a></li>
        <li><a href="#tab2">nội dung sản phẩm</a></li>
        <li><a href="#tab3">hình ảnh</a></li>
    </ul> <!-- END tabs-nav -->
    <div id="tabs-content">
        <div id="tab1" class="tab-content">
        <?php echo $row_chitiet['tomtat'] ?>
        </div>
        <div id="tab2" class="tab-content">
        <?php echo $row_chitiet['noidung'] ?>
        </div>
        <div id="tab3" class="tab-content">
        <img width="100%" src="admin/modules/quanlysanpham/uploads/<?php echo $row_chitiet['hinhanh']?> ">
        </div>
    
    </div> 
    </div>
<?php
}
?> 