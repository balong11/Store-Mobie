<div class="clear"></div>
<div class="main">
    <?php
     if(isset($_GET['action']) && $_GET["query"]){
        $tam = $_GET['action'];
        $query = $_GET['query'];
      }else{
        $tam = '';
        $query ='';
      }
      //quanlydanhmucsanpham 
      if($tam=='quanlydanhmucsanpham' && $query == 'them'){
        include ("modules/quanlydanhmucsanpham/them.php");
        include ("modules/quanlydanhmucsanpham/lietke.php");

      }elseif($tam=='quanlydanhmucsanpham' && $query == 'sua'){
        include ("modules/quanlydanhmucsanpham/sua.php");

        //quanlysanpham 
      }if($tam=='quanlysanpham' && $query == 'them'){
        include ("modules/quanlysanpham/them.php");
        include ("modules/quanlysanpham/lietke.php");

      }elseif($tam=='quanlysanpham' && $query == 'sua'){
        include ("modules/quanlysanpham/sua.php"); 

        //quan lý đơn hàng
      }elseif($tam=='quanlydonhang' && $query == 'lietke'){
        include ("modules/quanlydonhang/lietkedonhang.php"); 

      }elseif($tam=='donhang' && $query == 'xemdonhang'){
        include ("modules/quanlydonhang/xemdonhang.php");    

        //quản lý danh muc bài viết
      }elseif($tam=='quanlydanhmucbaiviet' && $query == 'them'){
        include ("modules/quanlydanhmucbaiviet/them.php"); 
        include ("modules/quanlydanhmucbaiviet/lietke.php"); 

      }elseif($tam=='quanlydanhmucbaiviet' && $query == 'sua'){
        include ("modules/quanlydanhmucbaiviet/sua.php"); 
        //quản lý bài viết
      }elseif($tam=='quanlybaiviet' && $query == 'them'){
        include ("modules/quanlybaiviet/them.php"); 
        include ("modules/quanlybaiviet/lietke.php"); 

      }elseif($tam=='quanlybaiviet' && $query == 'sua'){
        include ("modules/quanlybaiviet/sua.php"); 

      }elseif($tam=='quanlyweb' && $query == 'capnhat'){
        include ("modules/thongtinlienhe/quanly.php"); 
      

      }else{
        include ("modules/dashboard.php");
      }

    ?>
</div>
