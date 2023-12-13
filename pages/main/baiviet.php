<?php
    $id = $_GET['id'];
    $sql_bv = "SELECT *
    FROM baiviet AS a
    WHERE a.id = $id limit 1";
    $query_bv = mysqli_query($con,$sql_bv);  

    $query_bv_all = mysqli_query($con,$sql_bv);  

    $row_bv =  mysqli_fetch_array( $query_bv);
?>

<h3>bài viết : <span style="text-align: center;text-transform:uppercase"><?php echo $row_bv['tenbaiviet']?></span> </h3>
                <ul class="baiviet">
                    <?php
                    
                     while($row_bv = mysqli_fetch_array($query_bv_all)){
                    ?>
                        <li>
                            <h2><?php echo $row_bv['tenbaiviet'] ?></h2>
                            <p class="title_product"><?php echo $row_bv['tomtat'] ?></p>
                            <p style="margin: 10px;" class="title_product"> <?php echo $row_bv['noidung'] ?></p>
  
                        </li>
                    <?php
                    }   
                    ?>
                </ul>
