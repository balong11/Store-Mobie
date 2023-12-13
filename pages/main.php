<div id="main">
        <div class="row">
    <!-------large- middle sm small xsamll----------->
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <?php
            include ("sidebar/sidebar.php")
          ?>

        </div>

        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
        <!-- <div class="maincontent"> -->

                <?php
                if(isset($_GET['quanly'])){
                  $tam = $_GET['quanly'];
                }else{
                  $tam = '';
                }//danh mục sản phẩm
                if($tam=='danhmucsanpham'){
                  include ("pages/main/danhmucsp.php");
                     //giỏ hàng               
                }elseif($tam=='giohang'){
                  include ("main/giohang.php");
                  //danh muc bài viết
                }elseif($tam=='danhmucbaiviet'){
                  include ("main/danhmucbaiviet.php");  
                  //bài viết
                }elseif($tam=='baiviet'){
                  include ("main/baiviet.php");
                  //tin tức
                }elseif($tam=='tintuc'){
                  include ("main/tintuc.php");
                  //liên hệ
                }elseif($tam=='lienhe'){
                  include ("main/lienhe.php");
                  //san pham
                }elseif($tam=='sanpham'){
                  include ("main/sanpham.php");
                  // đăng ký
                }elseif($tam=='dangky'){
                  include ("main/dangky.php");
                  //thanh toán
                }elseif($tam=='thanhtoan'){
                    include ("main/thanhtoan.php");
                  //đăng nhập
                }elseif($tam=='dangnhap'){
                    include ("main/dangnhap.php");
                  // tìm kiếm
                }elseif($tam=='timkiem'){
                    include ("main/timkiem.php");
                  //cảm ơn
                }elseif($tam=='camon'){
                    include ("main/camon.php");

                    //đổi mật khẩu
                }elseif($tam=='doimatkhau'){
                    include ("main/doimatkhau.php");
                    
                }elseif($tam=='vanchuyen'){
                    include ("main/vanchuyen.php");
                  //thông tin thanh toán
                }elseif($tam=='thongtinthanhtoan'){
                    include ("main/thongtinthanhtoan.php");

                    //lịch sử đơn hàng
                }elseif($tam=='lichsudonhang'){
                    include ("main/lichsudonhang.php");
                    //dơn hàng đã đặt
                }elseif($tam=='donhangdadat'){
                    include ("main/donhangdadat.php");

                }elseif($tam=='xemdonhang'){
                    include ("main/xemdonhang.php");

                }else{
                  include ("main/index.php");
                }

                ?>
        <!-- </div> -->
        </div>
        </div>
</div>