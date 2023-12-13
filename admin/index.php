<?php
session_start();
if(!isset($_SESSION['login'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <title>admin</title>
</head>
<body>
    <h3 class="title_admin">chào mừng đến trang quản trị</h3>
<div class="wrapper">
    <div class="wrapper"></div>
      <?php
      include ("config/connectdb.php");
      include ("modules/header.php");
      include ("modules/menu.php");
      include ("modules/main.php");
      include ("modules/footer.php");

      ?>
     
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>    
    <script>
        CKEDITOR.replace('tomtat');
        CKEDITOR.replace('noidung');
        CKEDITOR.replace('thongtinlienhe');
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            thongke();
            var char = new Morris.Area({
                // ID của phần tử để vẽ biểu đồ.
                element: 'chart',
                // Tên của thuộc tính bản ghi dữ liệu có chứa giá trị x.
                xkey: 'date',
                // Danh sách tên của các thuộc tính bản ghi dữ liệu có chứa giá trị y.
                ykeys: ['date','order','quantity','sales'],
                // chart.
                labels: ['đơn hàng','doanh thu','số lượng bán ra']
            });
            $('.select-date').change(function(){
                var thoigian = $(this).val();
                if(thoigian == '7ngay'){
                    var text = '7 ngày qua';
                }else if(thoigian == '28ngay'){
                    var text = '28 ngày qua';
                }else if(thoigian == '90ngay'){
                    var text = '90 ngày qua';
                }else{
                    var text = '365 ngày qua';
                };
                $.ajax({
                    url:"modules/thongke.php",
                    method:"post",
                    dataType:"json",
                    data:{thoigian:thoigian},
                    success:function(data)
                        {
                            char.setData(data);
                            $('#text-date').text(text);
                        }
                    });
            });
            function thongke(){
                    var text = '365 ngay qua';
                    $.ajax({
                        url: "modules/thongke.php",
                        method: "POST",
                        dataType: "JSON",
                        success:function(data)
                            {
                                char.setData(data);
                                $('#text-date').text(text);
                            }
                    });
                };
        });
        </script>
</body>
</html>