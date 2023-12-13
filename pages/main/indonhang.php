<?php
    require('../../tfpdf/tfpdf.php');
	include('../../admin/config/connectdb.php');

    ob_start();

    $pdf = new tFPDF();
    $pdf->AddPage("0");
    // $pdf->SetFont('Arial','B',16);
		// Add a Unicode font (uses UTF-8)
	$pdf->AddFont('DejaVu','','DejaVuSans-Bold.ttf',true);
	$pdf->SetFont('DejaVu','',15);

    $code = $_GET['code'];
    $sql_lietke_donhang = "SELECT * FROM tbl_cart_detail,tbl_sanpham WHERE tbl_cart_detail.id_sanpham=tbl_sanpham.id_sanpham 
    AND tbl_cart_detail.code_cart='$code ' ORDER BY tbl_cart_detail.id_cart_detail DESC";
    $query_lietke_donhang = mysqli_query($con,$sql_lietke_donhang);
	$width_cell=array(5,35,80,20,30,40);
 
    $pdf->Write(10,'Đơn hàng của bạn gồm có:');
	$pdf->Ln(10);
    
	$pdf->Cell($width_cell[0],10,'ID',1,0,'C',true);
	$pdf->Cell($width_cell[1],10,'Mã hàng',1,0,'C',true);
	$pdf->Cell($width_cell[2],10,'Tên sản phẩm',1,0,'C',true);
	$pdf->Cell($width_cell[3],10,'Số lượng',1,0,'C',true); 
	$pdf->Cell($width_cell[4],10,'Giá',1,0,'C',true);
	$pdf->Cell($width_cell[5],10,'Tổng tiền',1,1,'C',true); 
	$pdf->SetFillColor(235,236,236); 
	$fill=false;
	$i = 0;
	while($row = mysqli_fetch_array($query_lietke_donhang)){
		$i++;
	$pdf->Cell($width_cell[0],10,$i,1,0,'C',$fill);
	$pdf->Cell($width_cell[1],10,$row['code_cart'],1,0,'C',$fill);
	$pdf->Cell($width_cell[2],10,$row['tensanpham'],1,0,'C',$fill);
	$pdf->Cell($width_cell[3],10,$row['soluongmua'],1,0,'C',$fill);
	$pdf->Cell($width_cell[4],10,number_format($row['giasanpham']),1,0,'C',$fill);
	$pdf->Cell($width_cell[5],10,number_format($row['soluongmua']*$row['giasanpham']),1,1,'C',$fill);
	$fill = !$fill;

	}
	$pdf->Write(10,'Cảm ơn bạn đã đặt hàng tại website của chúng tôi.');
	$pdf->Ln(10);
    $pdf->Output();
	ob_end_flush(); 

?>