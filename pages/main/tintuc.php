<h3>Tin Tức Mói Nhất</h3>
<?php
    $sql_bv = "SELECT *
    FROM baiviet 
    WHERE tinhtrang = 1 order by id desc";
    $query_bv = mysqli_query($con,$sql_bv);  
    
?>
                <div class="col-md-9">
                <ul class="product_list">
                    <?php
                    
                     while($row_bv = mysqli_fetch_array($query_bv)){
                    ?>
                        <li>
                            <a href= 'index.php?quanly=baiviet&id=<?php  echo $row_bv["id"]?>'>  
                                <img src="admin/modules/quanlybaiviet/uploads/<?php echo $row_bv['hinhanh']?>" width="150px">
                                <p class="title_product">tên bài viết : <?php echo $row_bv['tenbaiviet'] ?></p>
                            </a>   
                            <p style="margin: 10px;" class="title_product"> <?php echo $row_bv['tomtat'] ?></p>
  
                        </li>
                    <?php
                    }   
                    ?>
                </ul>
                </div>
