<?php
    if(isset($_GET['trang'])){
        $page = $_GET['trang'];
    }else{
        $page = 1;
    }
    if($page == ''||$page == 1){
        $begin = 0;
    }else{
        $begin = ($page*3)-3;
    }
    $sql_pro = "SELECT * FROM tbl_sanpham,tbl_danhsach
    WHERE tbl_sanpham.id_danhmuc = tbl_danhsach.id_danhmuc 
    ORDER BY tbl_sanpham.id_sanpham desc limit $begin,3 ";
    $query_pro = mysqli_query($con,$sql_pro);  

?>
<h3>sản phẩm mới nhất</h3>
                <div class="row">
                    <?php
                        while($row = mysqli_fetch_array($query_pro)){
                    ?>
                    <div class="col-md-3 ">
                        <a class="test-10" href= "index.php?quanly=sanpham&id=<?php echo $row['id_sanpham']?>">  
                            <img class="img img-responsive" width="100%" src="admin/modules/quanlysanpham/uploads/<?php echo $row['hinhanh']?>">
                            <p class="title_product">tên sản phẩm : <?php echo $row['tensanpham'] ?></p>
                            <p class="price_product">giá : <?php echo number_format( $row['giasanpham']).'vnd' ?></p>
                            <p style="text-align: center;color:#df0000" ><?php echo $row['tendanhmuc'] ?></p>
                        </a>     
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div style="clear :both">
                <style type="text/css">
                    ul.list_trang {
                        padding: 0;
                        margin: 0;
                        list-style: none;
                    }
                    ul.list_trang li {
                        float: left;
                        padding: 5px 13px;
                        margin: 5px;
                        background: burlywood;
                        display: block;
                    }
                    ul.list_trang li a {
                        color: #000;
                        text-align: center;
                        text-decoration: none;
                       
                    }       
                </style>
                <?php
                $sql_trang = mysqli_query($con,"SELECT * FROM tbl_sanpham") ;
                $row_count = mysqli_num_rows($sql_trang);
                $trang = ceil($row_count/3);
                ?>
                <p>trang hiện tại : <?php echo $page?>/<?php echo $trang?> </p>
                <ul class="list_trang">
                    
                    <?php
                    for($i=1;$i<=$trang;$i++){
                    ?>
                        <li <?php if($i==$page){ echo 'style="background:red"';}else{ echo '';} ?>>
                            <a href="index.php?trang=<?php echo $i?>"><?php echo $i?></a>
                        
                        </li>
                    <?php
                    } 
                    ?>
                </ul>
                <div>


           