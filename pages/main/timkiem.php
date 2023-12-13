<?php
    if(isset($_POST['timkiem'])){
        $tukhoa = $_POST['tukhoa'];
      
    }else{
        $tukhoa = '';
    }
    $sql_pro = "SELECT * FROM tbl_sanpham,tbl_danhsach
    WHERE tbl_sanpham.id_danhmuc = tbl_danhsach.id_danhmuc 
    AND tbl_sanpham.tensanpham LIKE '$tukhoa' " ;
    $query_pro = mysqli_query($con,$sql_pro); 
    // var_dump($query_pro);die;
?>
<h3>Từ Khóa Tìm Kiếm : <?php echo $_POST['tukhoa']?></h3>
                <ul class="product_list">
                    <?php
                        while($row = mysqli_fetch_array($query_pro)){
                    ?>
                    <li>
                        <a href= "index.php?quanly=sanpham&id=<?php echo $row['id_sanpham']?>">  
                            <img src="admin/modules/quanlysanpham/uploads/<?php echo $row['hinhanh']?>">
                            <p class="title_product">tên sản phẩm : <?php echo $row['tensanpham'] ?></p>
                            <p class="price_product">giá : <?php echo number_format( $row['giasanpham']).'vnd' ?></p>
                            <p style="text-align: center;color:#d1d1d1" ><?php echo $row['tendanhmuc'] ?></p>
                        </a>     
                    </li>
                    <?php
                    }
                    ?>
                </ul>

           