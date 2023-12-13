<?php
    //lay dữ liệu từ đb lien he ra
    $sql_lh = "SELECT *FROM lienhe WHERE id=1 limit 1";
    $query_lh = mysqli_query($con,$sql_lh); 
    $row_bv = mysqli_fetch_array($query_lh) ;
    echo $row_bv['thongtinlienhe'];
?>

<!-- <h3> Liên hệ : </h3>
                <ul class="lienhe">
                    <?php
                    
                     while($row_bv = mysqli_fetch_array($query_lh)){
                    ?>
                        <li>

                            <p style="margin: 10px;" class="title_product"> <?php echo $row_bv['thongtinlienhe'] ?></p>
  
                        </li>
                    <?php
                    }   
                    ?>
                </ul> -->
