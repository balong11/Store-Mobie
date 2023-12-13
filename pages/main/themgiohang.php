<?php

session_start();
include('../../admin/config/connectdb.php');
//them so luong cong san pham
if(isset($_GET['cong'])){
    $id=$_GET['cong'];
    foreach($_SESSION['cart'] as $cart_item){
        if($cart_item['id']!=$id){
            $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=> $cart_item['soluong'],
            'giasanpham'=>$cart_item['giasanpham'],'hinhanh'=>$cart_item['hinhanh'],'masanpham'=>$cart_item['masanpham']);
            $_SESSION['cart'] = $product; 
        }else{
            $tangsoluong = $cart_item['soluong'] +1;
            if($cart_item['soluong']<=10){
                $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=> $tangsoluong ,
                'giasanpham'=>$cart_item['giasanpham'],'hinhanh'=>$cart_item['hinhanh'],'masanpham'=>$cart_item['masanpham']);

            }else{
                $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=> $cart_item['soluong'] ,
                'giasanpham'=>$cart_item['giasanpham'],'hinhanh'=>$cart_item['hinhanh'],'masanpham'=>$cart_item['masanpham']);

            }
            $_SESSION['cart'] = $product; 
        }
        
    }
    header('location:../../index.php?quanly=giohang'); 
}
//tru san pham
if(isset($_GET['tru'])){
    $id=$_GET['tru'];
    foreach($_SESSION['cart'] as $cart_item){
        if($cart_item['id']!=$id){
            $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=> $cart_item['soluong'],
            'giasanpham'=>$cart_item['giasanpham'],'hinhanh'=>$cart_item['hinhanh'],'masanpham'=>$cart_item['masanpham']);
            $_SESSION['cart'] = $product; 
        }else{
            $tangsoluong = $cart_item['soluong'] -1;
            if($cart_item['soluong']>1){
                $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=> $tangsoluong ,
                'giasanpham'=>$cart_item['giasanpham'],'hinhanh'=>$cart_item['hinhanh'],'masanpham'=>$cart_item['masanpham']);

            }else{
                $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=> $cart_item['soluong'] ,
                'giasanpham'=>$cart_item['giasanpham'],'hinhanh'=>$cart_item['hinhanh'],'masanpham'=>$cart_item['masanpham']);

            }if( $cart_item['soluong'] ==0){
                echo "sản phẩm hết hàng";
            }
            $_SESSION['cart'] = $product; 
        }
        
    }
    header('location:../../index.php?quanly=giohang'); 
}
//xoa 1 sp
if(isset($_SESSION['cart']) && isset($_GET['xoa'])){
    $id=$_GET['xoa']; 
    foreach($_SESSION['cart'] as $cart_item){
        if($cart_item['id']!=$id){
            $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=> $cart_item['soluong'],
            'giasanpham'=>$cart_item['giasanpham'],'hinhanh'=>$cart_item['hinhanh'],'masanpham'=>$cart_item['masanpham']);

        }
    $_SESSION['cart'] = $product;  
    header('location:../../index.php?quanly=giohang'); 
    }
    
}
//xoa tat ca
if(isset($_GET['xoatoanbo']) && $_GET['xoatoanbo']==1){
    unset($_SESSION['cart']);
    header('location:../../index.php?quanly=giohang');  
}
//them soluong

if(isset($_POST['themgiohang']) || !empty($_POST['themgiohang'])){
    //ket noi đb
    $id = $_GET['idsanpham'];
    $soluong = 1;
    $sql = "SELECT *FROM tbl_sanpham WHERE id_sanpham='$id' limit 1";
    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($query);
    // var_dump($row);die();
    if($row && $row['soluong'] > 0)
    {
        //goi giỏ hàng
        $new_product=array(array('tensanpham'=>$row['tensanpham'],'id'=>$id,'soluong'=>$soluong,'giasanpham'=>$row['giasanpham'],'hinhanh'=>$row['hinhanh'],'masanpham'=>$row['masanpham']));
        // kiểm tra session gio hang tồn tại
        if(isset($_SESSION['cart'])){
            $found = false;
            foreach($_SESSION['cart'] as $cart_item){
                //nếu dữ liệu trùng thì số lượng cộng thêm 1
                if($cart_item['id']==$id){
                    $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=> $soluong+1,'giasanpham'=>$cart_item['giasanpham'],'hinhanh'=>$cart_item['hinhanh'],'masanpham'=>$cart_item['masanpham']);
                    $found = true;
                }else{
                    // nếu dữ liệu k trùng 
                    $product[]=array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasanpham'=>$cart_item['giasanpham'],'hinhanh'=>$cart_item['hinhanh'],'masanpham'=>$cart_item['masanpham']);
                }
            }
            if($found == false){
                // liên kết dữ liệu new_product với product
                $_SESSION['cart'] = array_merge($product,$new_product);
            }else{
                $_SESSION['cart'] = $product;
            }
            
        }else{
            $_SESSION['cart'] = $new_product;
        }

    }
    else
    {
        $message = 'Sản phẩm đã hết';
        Redirect($_SERVER['HTTP_REFERER'].'&message='.$message );    
    }

    // check button submit
    if(isset($_POST['themgiohang']) && $_POST['themgiohang'] == "Mua Ngay"){
        Redirect('/vanchuyen');    
    }else{
        Redirect('/giohang');   
    }
}
?> 