<?php
include('admin/config/connectdb.php');
require('carbon/autoload.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;

$now = Carbon::now('asia/ho_chi_minh');
// thanhn toán vnpay
if(isset($_GET['vnp_Amount'])){
    $vnp_Amount = $_GET['vnp_Amount'];
    $vnp_BankCode = $_GET['vnp_BankCode'];
    $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
    $vnp_CardType = $_GET['vnp_CardType']; 
    $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
    $vnp_PayDate = $_GET['vnp_PayDate'];
    $vnp_TmnCode = $_GET['vnp_TmnCode'];
    $vnp_TransactionNo = $_GET['vnp_TransactionNo'];
    $code_cart = $_SESSION['code_cart'] ?? '';

    //insert db vnpay
    $insert_vnpay = "INSERT INTO vnpay(tongtien,nganhang,magiaodich,loaithe,noidungtt,paydate,tmncode,transactionno,code_cart)
        VALUE('$vnp_Amount','$vnp_BankCode','$vnp_BankTranNo','$vnp_CardType','$vnp_OrderInfo','$vnp_PayDate','$vnp_TmnCode',
        '$vnp_TransactionNo','$code_cart')";
    $cart_query = mysqli_query($con,$insert_vnpay);
    if($cart_query){
        //insert giỏ hàng
        echo '<h3>giao dịch bằng vnpay thành công</h3>';
        echo '<h3>vui lòng vào trang <a target="_blank" href="index.php?quanly=lichsudonhang">lịch sử đơn hàng</a> để xem chi tiết đơn hàng</h3>';

    }else{
        echo 'giao dịch vnpay thất bại';
    }
//thanh toán momo 
}elseif(isset($_GET['partnerCode'])){
    $id_khachhang = $_SESSION['id_khachhang'];
    $partnerCode = $_GET['partnerCode'];
    $order_Id = $_GET['orderId'];
    $amount = $_GET['amount'];
    $order_Info = $_GET['orderInfo']; 
    $order_Type = $_GET['orderType'];
    $trans_Id = $_GET['transId'];
    $pay_Type = $_GET['payType'];
    $code_order = Rand(0,9999);
    $cart_thanhtoan = 'momo';
    // lấy id thông tin vận chuyển
    $sql_get_vanchuyen = mysqli_query($con,"SELECT * FROM vanchuyen WHERE id_dangky='$id_khachhang' LIMIT 1");
    $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
    $id_vanchuyen = $row_get_vanchuyen['id_vanchuyen'];    
    //insert ĐB momo
    $insert_momo = "INSERT INTO momo(partner_code,order_id,amount,order_info,order_type,trans_id,pay_type,code_cart)
            VALUE('$partnerCode','$order_Id','$amount','$order_Info','$order_Type','$trans_Id','$pay_Type','$code_order')";
    $cart_query = mysqli_query($con,$insert_momo);
    //insert giỏ hàng
    if($cart_query){
        $insert_cart = "INSERT INTO tbl_cart(id_khachhang,code_cart,cart_status,ngaydat,cart_thanhtoan,cart_vanchuyen)
        VALUE('$id_khachhang','$code_order',1,'$now','$cart_thanhtoan','$id_vanchuyen')";
        $cart_query = mysqli_query($con,$insert_cart);
        //thêm chi tiết giỏ hàng
        foreach($_SESSION['cart'] as $key=> $value){
            $id_sanpham = $value['id'];
            $soluongmua = $value['soluong'];
            $insert_order_detail = "INSERT INTO tbl_cart_detail(id_sanpham,code_cart,soluongmua)
            VALUE ('$id_sanpham','$code_order','$soluongmua')";
            mysqli_query($con,$insert_order_detail);
            
            // update so lượng sp còn lại
            $sql_chitiet = "SELECT * FROM tbl_sanpham
            WHERE id_sanpham = $id_sanpham limit 1";
            $query_chitiet = mysqli_query($con,$sql_chitiet);
            $row = mysqli_fetch_array($query_chitiet);
            $soluong = $row['soluong'] - $soluongmua;
            $sql = "UPDATE tbl_sanpham SET soluong = $soluong WHERE tbl_sanpham.id_sanpham = $id_sanpham";
            $query_chitiet = mysqli_query($con,$sql);    
        }
                
        echo '<h3>giao dịch bằng momo thành công</h3>';
        echo '<h3>vui lòng vào trang <a target="_blank" href="index.php?quanly=lichsudonhang">lịch sử đơn hàng</a> để xem chi tiết đơn hàng</h3>';

    }else{
        echo 'giao dịch momo thất bại';
    }
  
}
unset($_SESSION['cart']);


?>
<p>cảm ơn bạn đã mua hàng của chúng tôi</p>

