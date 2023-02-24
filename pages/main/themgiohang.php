<?php
	session_start();
	include("../../admincp/config/conect.php");
	//lay so luong san pham tu CSDL
	
  	

	// them so luong
	if(isset($_GET['cong'])){
		$id=$_GET['cong'];
		// $soluong = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$id'";
    	// $query_pro = mysqli_query($mysqli, $soluong);
		$query_pro = $pdo->prepare(
			"SELECT * FROM tbl_sanpham WHERE id_sanpham= :id"
		);
		$query_pro->execute([
			'id' => $id
		]);
    	$row = $query_pro->fetch();
        $sl=$row['soluong'];
    	
		
		foreach($_SESSION['cart'] as $cart_item){
			if($cart_item['id']!=$id){
				$product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
				$_SESSION['cart'] = $product;
			}else{
				$tangsoluong = $cart_item['soluong'] + 1;
				if($cart_item['soluong'] < $sl){
					
					$product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$tangsoluong,'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
				}else{
					$product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
				}
				$_SESSION['cart'] = $product;
			}
			
		}
		header('Location:../../index.php?quanly=giohang');
	}
	//tru so luong
	if(isset($_GET['tru'])){
		$id=$_GET['tru'];
		foreach($_SESSION['cart'] as $cart_item){
			if($cart_item['id']!=$id){
				$product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
				$_SESSION['cart'] = $product;
			}else{
				$trusoluong = $cart_item['soluong'] - 1;
				if($cart_item['soluong'] > 1){
					$product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$trusoluong,'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
				}else{
					$product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
				}
				$_SESSION['cart'] = $product;
			}
			
		}
		header('Location:../../index.php?quanly=giohang');
	}
	//xoa san pham
	if(isset($_SESSION['cart'])&&isset($_GET['xoa'])){
		$id=$_GET['xoa'];
		foreach($_SESSION['cart'] as $cart_item){

			if($cart_item['id']!=$id){
				$product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
			}

		$_SESSION['cart'] = $product;
		header('Location:../../index.php?quanly=giohang');
		}
	}
	//xoa tat ca
	if(isset($_GET['xoatatca'])&&$_GET['xoatatca']==1){
		unset($_SESSION['cart']);
		header('Location:../../index.php?quanly=giohang');
	}
	//them sanpham vao gio hang
	if(isset($_POST['themgiohang'])){
		$id=$_GET['idsanpham'];
		$soluong=1;
		$query = $pdo->prepare(
			"SELECT * FROM tbl_sanpham WHERE id_sanpham=:id LIMIT 1"
		);
		$query->execute(['id'=>$id]);
		$row = $query->fetch();
		$stmt = $pdo -> prepare("SELECT * FROM tbl_anh WHERE masp = :ma LIMIT 1");
		$stmt->execute(['ma' => $row['masp']]);
		$Img = $stmt->fetch();
		
		
		if($row){
			$new_product=array(array('tensanpham'=>$row['tensanpham'],'id'=>$id,'soluong'=>$soluong,'giasp'=>$row['giasp'],'hinhanh'=>$Img['tenanh'],'masp'=>$row['masp']));
			//kiem tra session gio hang ton tai
			if(isset($_SESSION['cart'])){
				$found = false;
				foreach($_SESSION['cart'] as $cart_item){
					//neu du lieu trung
					if($cart_item['id']==$id){						
						$sql = $pdo->prepare("SELECT * FROM tbl_sanpham WHERE id_sanpham = :id");
						$sql -> execute(['id'=> $id]);
						$max = $sql->fetch();
						echo $cart_item['soluong']. ' vs'.$max['soluong'];
						if($cart_item['soluong'] < $max['soluong']){
							$product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong']+1,'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
							$found = true;
						}
						else {
							$product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
							$found = true;
						}
						
					}else{
						//neu du lieu khong trung
						$product[]= array('tensanpham'=>$cart_item['tensanpham'],'id'=>$cart_item['id'],'soluong'=>$cart_item['soluong'],'giasp'=>$cart_item['giasp'],'hinhanh'=>$cart_item['hinhanh'],'masp'=>$cart_item['masp']);
					}
				}
				if($found == false){
					//lien ket du lieu new_product voi product
					$_SESSION['cart']=array_merge($product,$new_product);
				}else{
					$_SESSION['cart']=$product;
				}
			}else{
				$_SESSION['cart'] = $new_product;
			}

		}
		header('Location:../../index.php?quanly=giohang');
		
	}
	
	
	
?>