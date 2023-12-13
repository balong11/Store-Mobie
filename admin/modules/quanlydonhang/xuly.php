<?php
require('../../../carbon/autoload.php');
include('../../config/connectdb.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;
$now = Carbon::now('asia/ho_chi_minh')->toDateString();

if(isset($_GET['code'])){
    $code = $_GET['code'];
    $sql = "UPDATE tbl_cart SET cart_status=0 WHERE code_cart='$code'";
    $query = mysqli_query($con,$sql);
    //thống kê doanh thu
    $sql_lietke_dh = "SELECT * FROM tbl_cart_detail,tbl_sanpham WHERE tbl_cart_detail.id_sanpham=tbl_sanpham.id_sanpham
             AND tbl_cart_detail.code_cart='$code' ORDER BY tbl_cart_detail.id_cart_detail DESC";
    $query_lietke_dh = mysqli_query($con,$sql_lietke_dh);

    $sql_thongke = "SELECT * FROM thongke WHERE ngaydat='$now'";
    $query_thongke = mysqli_query($con,$sql_thongke);
    // $soluongmua = '';
    // $doanhthu = '';
    while($row = mysqli_fetch_array($query_lietke_dh)){
        $soluongmua += $row['soluongmua'];
        $giatien += $row['giasanpham'];
    }
    if(mysqli_num_rows($query_thongke)==0){
        $soluongban = $soluongmua;
        $doanhthu = $giatien;
        $donhang = 1;
        $sql_update_thongke = mysqli_query($con, "INSERT INTO thongke(ngaydat,donhang,soluongban,doanhthu)
                value('$now','$donhang','$soluongban','$doanhthu')");
    

    }elseif(mysqli_num_rows($query_thongke)!=0){
        while($row_tk = mysqli_fetch_array($query_thongke)){
            $soluongban = $row_tk['soluongban']+$soluongban;
            $doanhthu = $row_tk['doanhthu']+$doanhthu;
            $donhang = $row_tk['donhang']+1;
            $sql_update_thongke = mysqli_query($con,"UPDATE thongke SET  donhang='$donhang',
            soluongban='$soluongban',doanhthu='$doanhthu' WHERE ngaydat='$now'");                  
        }
    }
    header("location:../../index.php?action=quanlydonhang&query=lietke");
}
?>