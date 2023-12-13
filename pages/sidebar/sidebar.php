
<?php ob_start(); ?>
      <h4 >danh mục sản phẩm</h4>
      <ul class="list_sidebar">
            <?php
      
                $sql_danhmuc = "SELECT * FROM tbl_danhsach ORDER BY id_danhmuc DESC";
                $query_danhmuc = mysqli_query($con,$sql_danhmuc);
                while($row = mysqli_fetch_array($query_danhmuc)){
					?>
              <li style="text-transform: uppercase;"><a href ="index.php?quanly=danhmucsanpham&id=<?php echo $row['id_danhmuc'] ?>">
                <?php echo $row['tendanhmuc'] ?></a></li>
				<?php
              }           
			  ?> 
      </ul>
      <h4 >danh mục bài viết</h4>
      <ul class="list_sidebar">
            <?php
      
                $sql_danhmuc = "SELECT * FROM danhmucbaiviet ORDER BY id_baiviet DESC";
                $query_danhmuc = mysqli_query($con,$sql_danhmuc);
                while($row = mysqli_fetch_array($query_danhmuc)){
            ?>
              <li style="text-transform: uppercase;"><a href ="index.php?quanly=danhmucbaiviet&id=<?php echo $row['id_baiviet'] ?>">
                <?php echo $row['tendanhmuc'] ?></a></li>
				<?php
              }           
			  
			  ?> 
      </ul>
			</php ob_end_flush(); ?>
      <!-- <div class="sidebar"> -->
<!-- </div> -->