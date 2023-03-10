<?php
// include('../../config/config.php');
include('../../config/conect.php');

$tenloaisp = $_POST['tendanhmuc'];
$thutu = $_POST['thutu'];
$buildpc = $_POST['buildpc'];
if(isset($_POST['themdanhmuc'])){
	//them
	// $sql_them = "INSERT INTO tbl_danhmuc(tendanhmuc,thutu) VALUE('".$tenloaisp."','".$thutu."')";
	// mysqli_query($mysqli,$sql_them);

	$stmt = $pdo->prepare(
		"INSERT INTO tbl_danhmuc(tendanhmuc, buildpc, thutu) VALUES(:ten, :pc, :tt)"
	);
	$stmt->execute([
		'ten' => $tenloaisp,
		'pc' => $buildpc,
		'tt' => $thutu
	]);

	header('Location:../../index.php?action=danhmuc');
}elseif(isset($_POST['suadanhmuc'])){
	//sua
	
	// $sql_update = "UPDATE tbl_danhmuc SET tendanhmuc='".$tenloaisp."',thutu='".$thutu."' WHERE id_danhmuc='$_GET[iddanhmuc]'";
	// mysqli_query($mysqli,$sql_update);

	$change = $pdo->prepare(
		"UPDATE tbl_danhmuc SET tendanhmuc = :ten, buildpc = :pc WHERE id_danhmuc = :id"
	);

	$change->execute([
		'ten' => $tenloaisp,
		'pc' => $buildpc,
		'id' => $_GET['iddanhmuc']
	]);
	header('Location:../../index.php?action=danhmuc');
}else{

	$id=$_GET['iddanhmuc'];
	// $sql_xoa = "DELETE FROM tbl_danhmuc WHERE id_danhmuc='".$id."'";
	// mysqli_query($mysqli,$sql_xoa);

	//xoa danh muc sp
	$del = $pdo->prepare(
		"DELETE FROM tbl_danhmuc WHERE id_danhmuc = :id"
	);

	$del->execute([
		'id' => $id
	]);

	//xoa san pham thhuoc danh muc x
	$rem = $pdo->prepare(
		"DELETE FROM tbl_sanpham WHERE id_danhmuc = :dm"
	);

	$rem->execute([
		'dm' => $id
	]);

	header('Location:../../index.php?action=danhmuc');
}

?>