<?php

    include('../config/connectdb.php');
    require('../../carbon/autoload.php');
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    $now = Carbon::now('asia/ho_chi_minh')->toDateString();

    if(isset($_POST['thoigian'])){
        $thoigian = $_POST['thoigian'];
    }else{
        $thoigian = "";
        $subdays = Carbon::now('asia/ho_chi_minh')->subdays(365)->toDateString();
    }
    if($thoigian=='7ngay'){
        $subdays = Carbon::now('asia/ho_chi_minh')->subdays(7)->toDateString();
    }elseif($thoigian=='28ngay'){
        $subdays = Carbon::now('asia/ho_chi_minh')->subdays(28)->toDateString();
    }elseif($thoigian=='90ngay'){
        $subdays = Carbon::now('asia/ho_chi_minh')->subdays(90)->toDateString();
    }elseif($thoigian=='365ngay'){
        $subdays = Carbon::now('asia/ho_chi_minh')->subdays(365)->toDateString();
    }
    $subdays = Carbon::now('asia/ho_chi_minh')->subdays(365)->toDateString();

    $now = Carbon::now('asia/ho_chi_minh')->toDateString();
    $sql = "SELECT * FROM  thongke WHERE ngaydat BETWEEN '$subdays' AND '$now' ORDER BY ngaydat ASC";
    $sql_query = mysqli_query($con,$sql);
    while($val = mysqli_fetch_array($sql_query)){
        
        $chart_data[]=array(
            'date' => $val['ngaydat'],
            'order' => $val['donhang'],
            'quantity' => $val['soluongban'],
            'sales' => $val['doanhthu'],

        );
    } 
    echo $data = json_encode($chart_data);

?>