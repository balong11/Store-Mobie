<?php
    $id = $_GET['id'];
    $sql_pro = "SELECT *
    FROM tbl_sanpham AS a
    JOIN tbl_danhsach ON a.id_danhmuc = tbl_danhsach.id_danhmuc
    WHERE a.id_danhmuc = $id order by a.id_sanpham desc";
    $query_pro = mysqli_query($con,$sql_pro);  
    //tendanhmuc<bỏ nếu k cần>
    $id = $_GET['id'];
    $sql_cate = "SELECT *FROM tbl_danhsach AS b WHERE b.id_danhmuc = $id limit 1";
    $query_cate = mysqli_query($con,$sql_cate); 
    $row_cate =  mysqli_fetch_array( $query_cate);
?>

<h3>danh mục sản phẩm : <?php echo $row_cate['tendanhmuc']?> </h3>
                <div class="row">
                    <?php
                        while($row = mysqli_fetch_array($query_pro)){
                    ?>
                    <div class="col-md-3">
                        <a href= "index.php?quanly=sanpham&id=<?php echo $row['id_sanpham']?>">  
                            <img class="img img-responsive" width="100%" src="admin/modules/quanlysanpham/uploads/<?php echo $row['hinhanh']?>">
                            <p class="title_product">tên sản phẩm : <?php echo $row['tensanpham'] ?></p>
                            <p class="price_product">giá : <?php echo number_format( $row['giasanpham']).'vnd' ?></p>
                        </a>     
                        </div>
                    <?php
                    }
                    ?>
                </div>
