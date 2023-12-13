<?php
    session_start();
    include('../../admin/config/connectdb.php');
    require('../../carbon/autoload.php');
    require_once('configvnpay.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $now = Carbon::now('asia/ho_chi_minh');

    // lấy id thông tin vận chuyển
    $id_dangky = $_SESSION['id_khachhang'];
    $sql_get_vanchuyen = mysqli_query($con,"SELECT * FROM vanchuyen WHERE id_dangky='$id_dangky' LIMIT 1");
    $row_get_vanchuyen = mysqli_fetch_array($sql_get_vanchuyen);
    $id_vanchuyen = $row_get_vanchuyen['id_vanchuyen'];
    //lấy vào đơn hàng
    $sql = "SELECT * FROM tbl_cart,tbl_cart_detail WHERE tbl_cart.code_cart = tbl_cart_detail.code_cart LIMIT 1";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($query);
    $id_khachhang = $_SESSION['id_khachhang'];
    $code_order = rand(0,9999);
    $cart_thanhtoan = $_POST['payment'];
 
    $tongtien = 0;
    foreach($_SESSION['cart'] as $key => $value){
        $thanhtien = $value['soluong'] * $value['giasanpham'];
        $tongtien += $thanhtien;
    }
    //thanh toán bằng tiền mặt và chuyển khoản
    if($cart_thanhtoan == 'tienmat' || $cart_thanhtoan =='chuyenkhoan'){
        $insert_cart = "INSERT INTO tbl_cart(id_khachhang,code_cart,cart_status,ngaydat,cart_thanhtoan,cart_vanchuyen)
        VALUE('$id_khachhang','$code_order',1,'$now','$cart_thanhtoan','$id_vanchuyen')";
        $cart_query = mysqli_query($con,$insert_cart);
        if(isset($cart_query) ){
                // them đơn hang chi tiet
            foreach($_SESSION['cart'] as $key => $value){
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
        }
        header("location:../../index.php?quanly=camon");  
    //thanh toán bằng vnpay  
    }elseif($cart_thanhtoan == 'vnpay'){
        
        $vnp_TxnRef = $code_order;      //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'thanh toán đơn hàng đã đặt tại web';  //nội dung thanh toán
        $vnp_OrderType = 'billpayment';             //loại hàng hóa
        $vnp_Amount = $tongtien * 100;               //tổng tiền
        $vnp_Locale = 'vn';                          //ngôn ngữ
        $vnp_BankCode = $_GET['vnp_BankCode'];              //chọn ngân hàng
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];       // lấy địa chỉ ip
        $vnp_ExpireDate = $expire;                   //hết hạn
        //Billing
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=>$vnp_ExpireDate
            
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
             // them đơn hang chi tiet
                $_SESSION['code_cart'] = $code_order;
                $insert_cart = "INSERT INTO tbl_cart(id_khachhang,code_cart,cart_status,ngaydat,cart_thanhtoan,cart_vanchuyen)
                     VALUE('$id_khachhang','$code_order',1,'$now','$cart_thanhtoan','$id_vanchuyen')";
                $cart_query = mysqli_query($con,$insert_cart);
                if(isset($cart_query) ){
               
                foreach($_SESSION['cart'] as $key => $value){
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
            }
                header('Location: ' . $vnp_Url);
                die();
        } else {
            echo json_encode($returnData);
        }
        
    }elseif($cart_thanhtoan == 'paypal'){
        //thanh toán bằng paypal
        echo 'thanh toán bằng paypal';
    }elseif($cart_thanhtoan == 'momo'){
        //thanh toán bằng momo
        
    }



    unset($_SESSION['cart']);
    
   
?>