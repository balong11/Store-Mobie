<?php
    session_start();
    // var_dump($_SESSION['cart']);die;
    include('../../admin/config/connectdb.php');
    require('../../carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $now = Carbon :: now('asia/ho_chi_minh');
    //thanhtoan
    $sql = "SELECT * FROM tbl_cart,tbl_cart_detail WHERE tbl_cart.code_cart = tbl_cart_detail.code_cart LIMIT 1";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($query);
    $id_khachhang = $_SESSION['id_khachhang'];
    // var_dump($_SESSION['id_khachhang']);die;
    $code_order = rand(0,9999);
    $insert_cart = "INSERT INTO tbl_cart(id_khachhang,code_cart,cart_status,ngaydat)
    VALUE('$id_khachhang','$code_order',1,'$now')";
    $cart_query = mysqli_query($con,$insert_cart);
    
    if(isset($cart_query) ){
            // them gio hang chi tiet
        foreach($_SESSION['cart'] as $key => $value){
            $id_sanpham = $value['id'];
            $soluongmua = $value['soluong'];
            $insert_order_detail = "INSERT INTO tbl_cart_detail(id_sanpham,code_cart,soluongmua)
            VALUE ('$id_sanpham','$code_order','$soluongmua')";
            mysqli_query($con,$insert_order_detail);
            
            // update so lượn sp còn lại
            $sql_chitiet = "SELECT * FROM tbl_sanpham
            WHERE id_sanpham = $id_sanpham limit 1";
    
            $query_chitiet = mysqli_query($con,$sql_chitiet);
            $row = mysqli_fetch_array($query_chitiet);
    
            $soluong = $row['soluong'] - $soluongmua;
            $sql = "UPDATE tbl_sanpham SET soluong = $soluong WHERE tbl_sanpham.id_sanpham = $id_sanpham";
            $query_chitiet = mysqli_query($con,$sql);
            
        }
    }

    unset($_SESSION['cart']);
    header("location:../../index.php?quanly=camon");
   
?>