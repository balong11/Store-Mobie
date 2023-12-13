<p>quản lý thông tin liên hệ</p>
<?php
    $sql_lienhe = "SELECT * FROM lienhe WHERE id=1 ";
    $query_lienhe = mysqli_query($con,$sql_lienhe);
?>
<table width="100%" style="border-collapse: collapse"; border="1">
    <?php
    while($dong=mysqli_fetch_array($query_lienhe)){

    ?>
 <form method="post" action="modules/thongtinlienhe/xuly.php?id=<?php echo $dong['id']?>" enctype="multipart/form-data">
   
    <tr>
        <td>thông tin liên hệ</td>
        <td><textarea row="10" name="thongtinlienhe" style="resize: none"><?php echo $dong['thongtinlienhe'] ?></textarea></td>
    </tr>
    
    </tr>
    <tr>
        <td colspan="2"><input type="submit" name="submitlienhe" value="cập nhật"/></td>
    </tr>
    <?php
    }
    ?>
 </form>
</table>
