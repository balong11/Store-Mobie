<?php
    $id = $_GET['id'];
    $sql_bv = "SELECT *
    FROM baiviet AS a
    WHERE a.id_danhmuc = $id order by a.id desc";
    $query_bv = mysqli_query($con,$sql_bv);  
    //tendanhmuc<bỏ nếu k cần>
    $id = $_GET['id'];
    $sql_cate = "SELECT *FROM danhmucbaiviet AS b WHERE b.id_baiviet = $id limit 1";
    $query_cate = mysqli_query($con,$sql_cate); 
    $row_cate =  mysqli_fetch_array( $query_cate);
?>

<h3>danh mục bài viết : <span style="text-align: center;text-transform:uppercase"><?php echo $row_cate['tendanhmuc']?></span> </h3>
                <ul class="product_list">
                    <?php
                    
                     while($row_bv = mysqli_fetch_array($query_bv)){
                    ?>
                        <li>
                            <a href= 'index.php?quanly=baiviet&id=<?php  echo $row_bv["id"]?>'>  
                                <img src="admin/modules/quanlybaiviet/uploads/<?php echo $row_bv['hinhanh']?>">
                                <p class="title_product">tên bài viết : <?php echo $row_bv['tenbaiviet'] ?></p>
                            </a>   
                            <p style="margin: 10px;" class="title_product"> <?php echo $row_bv['tomtat'] ?></p>
  
                        </li>
                    <?php
                    }   
                    ?>
                </ul>
