<?php
//include('../../config/config.php');
include "../../config/conect.php";
$tensanpham = $_POST['tensanpham'];
$masp = $_POST['masp'];
$giasp = $_POST['giasp'];

//xuly hinh anh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$location = 'uploads/';
$file_extension = pathinfo($location, PATHINFO_EXTENSION);         
$file_extension = strtolower($file_extension);
$valid_extension = array("png","jpeg","jpg");
$hinhanh = time().'_'.$hinhanh.$file_extension;

$soluong = $_POST['soluong'];
$tomtat = $_POST['tomtat'];
$noidung = $_POST['noidung'];
$tinhtrang = $_POST['tinhtrang'];
$danhmuc = $_POST['danhmuc'];




if(isset($_POST['themsanpham'])){
	//them
	// $sql_them = "INSERT INTO tbl_sanpham(tensanpham,masp,giasp,soluong,hinhanh,tomtat,noidung,tinhtrang,id_danhmuc) 
	// VALUE('".$tensanpham."','".$masp."','".$giasp."','".$soluong."','".$hinhanh."','".$tomtat."','".$noidung."','".$tinhtrang."','".$danhmuc."')";
	// mysqli_query($mysqli,$sql_them);

	$stmt = $pdo->prepare(
		"INSERT INTO tbl_sanpham
		VALUE(:id, :ten, :masp, :gia, :sl, :anh, :tom, :nd, :tt, :dm)"
	);

	$stmt ->execute([
		'id' => null,
		'ten' => $tensanpham,
		'masp' => $masp,
		'gia' => $giasp,
		'sl' => $soluong,
		'anh' => $hinhanh,
		'tom' => $tomtat,
		'nd' => $noidung,
		'tt' => $tinhtrang,
		'dm' => $danhmuc
	]);
	move_uploaded_file($hinhanh_tmp,$location.$hinhanh);
	header('Location:../../index.php?action=quanlysp&query=them');
}elseif(isset($_POST['suasanpham'])){
	//sua
	if(!empty($_FILES['hinhanh']['name'])){
		//xoa hinh anh cu
		$del = $pdo->prepare(
			"SELECT * FROM tbl_sanpham WHERE id_sanpham = :id_sp LIMIT 1"
		);
		$del->execute([
			'id_sp' => $_GET['idsanpham']
		]);
		// $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$_GET[idsanpham]' LIMIT 1";
		// $query = mysqli_query($mysqli,$sql);
		while($row = $del->fetch()){
			unlink('uploads/'.$row['hinhanh']);
		}
		move_uploaded_file($hinhanh_tmp,$location.$hinhanh);
		
		// $sql_update = "UPDATE tbl_sanpham SET tensanpham='".$tensanpham."',masp='".$masp."',giasp='".$giasp."'
		//,soluong='".$soluong."',hinhanh='".$hinhanh."',tomtat='".$tomtat."',noidung='".$noidung."',
		//tinhtrang='".$tinhtrang."',id_danhmuc='".$danhmuc."' WHERE id_sanpham='$_GET[idsanpham]'";
		$update = $pdo->prepare(
			"UPDATE tbl_sanpham 
			SET tensanpham = :ten, masp = :ma, giasp = :gia, soluong = :sl, hinhanh = :anh, tomtat = :tom, 
			noidung =:nd, tinhtrang = :tt, id_danhmuc = :dm 
			WHERE id_sanpham = :id"
		);
		$update->execute([
			'ten' => $tensanpham,
			'ma' => $masp,
			'gia' => $giasp,
			'sl' => $soluong,
			'anh' => $hinhanh,
			'tom' => $tomtat,
			'nd' => $noidung,
			'tt' => $tinhtrang,
			'dm' => $danhmuc,
			'id' => $_GET['idsanpham']
		]);
		

	}else{
		//$sql_update = "UPDATE tbl_sanpham SET tensanpham='".$tensanpham."',masp='".$masp."',giasp='".$giasp."',soluong='".$soluong."',
		//tomtat='".$tomtat."',noidung='".$noidung."',tinhtrang='".$tinhtrang."',id_danhmuc='".$danhmuc."' 
		//WHERE id_sanpham='$_GET[idsanpham]'";
		$update = $pdo->prepare(
			"UPDATE tbl_sanpham 
			SET tensanpham = :ten, masp = :ma, giasp = :gia, soluong = :sl, tomtat = :tom, 
			noidung =:nd, tinhtrang = :tt, id_danhmuc = :dm 
			WHERE id_sanpham = :id"
		);
		$update -> execute([
			'ten' => $tensanpham,
			'ma' => $masp,
			'gia' => $giasp,
			'sl' => $soluong,
			'tom' => $tomtat,
			'nd' => $noidung,
			'tt' => $tinhtrang,
			'dm' => $danhmuc,
			'id' => $_GET['idsanpham']
		]);
	}
	//mysqli_query($mysqli,$sql_update);
	header('Location:../../index.php?action=quanlysp&query=them');
}else{
	// $id=$_GET['idsanpham'];
	// $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id' LIMIT 1";
	// $query = mysqli_query($mysqli,$sql);
	$rem = $pdo->prepare(
		"SELECT * FROM tbl_sanpham WHERE id_sanpham = :id LIMIT 1"
	);
	$rem->execute([
		'id' => $_GET['idsanpham']
	]);
	while($row = $rem->fetch()){
		unlink('uploads/'.$row['hinhanh']);
	}
	$delete = $pdo->prepare(
		"DELETE FROM tbl_sanpham WHERE id_sanpham = :id"
	);
	$delete->execute(['id' => $_GET['idsanpham']]);
	// $sql_xoa = "DELETE FROM tbl_sanpham WHERE id_sanpham='".$id."'";
	// mysqli_query($mysqli,$sql_xoa);
	header('Location:../../index.php?action=quanlysp&query=them');
}

?>