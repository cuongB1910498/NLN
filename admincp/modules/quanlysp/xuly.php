<?php
include "../../config/conect.php";
require('../../../vendor/autoload.php');
use Cloudinary\Cloudinary;
$cloudinary = new Cloudinary(
	[
		'cloud' => [
			'cloud_name' => 'dx3ymfyd4',
			'api_key'    => '198624231658798',
			'api_secret' => '9IshlkXpSpVocXzqy49XPNtq_Ww',
		],
	]
);
$tensanpham = $_POST['tensanpham'];
$masp = $_POST['masp'];
$giasp = $_POST['giasp'];

$soluong = $_POST['soluong'];
$tomtat = $_POST['tomtat'];
$noidung = $_POST['noidung'];
$tinhtrang = $_POST['tinhtrang'];
$danhmuc = $_POST['danhmuc'];




if(isset($_POST['themsanpham'])){
	//them
	//xu ly anh
	$countfiles = count($_FILES['files']['name']);
	$query = "INSERT INTO tbl_anh VALUES(:id, :masp, :ten, :link)";
	$upload = $pdo->prepare($query);
	for($i = 0; $i < $countfiles; $i++) {
        try{
			$filename = $_FILES['files']['name'][$i];
			$file_tmp = $_FILES['files']['tmp_name'][$i];
			$data = $cloudinary->uploadApi()->upload(
				$file_tmp, 
				[
					'public_id' => $filename
				]
			);

			$query = "INSERT INTO tbl_anh VALUES(:id, :masp, :ten, :link)";
			$upload = $pdo->prepare($query);
			$upload->execute([
				'id' => null,
				'masp' => $masp,
				'ten' => $filename,
				'link' => $data['secure_url']
			]);
		}catch (Exception $e) {
			echo "ĐÃ có lỗi xảy ra";
		}
            
    }
    

	$stmt = $pdo->prepare(
		"INSERT INTO tbl_sanpham
		VALUE(:id, :ten, :masp, :gia, :sl, :tom, :nd, :tt, :nt, :dm)"
	);

	$stmt ->execute([
		'id' => null,
		'ten' => $tensanpham,
		'masp' => $masp,
		'gia' => $giasp,
		'sl' => $soluong,
		'tom' => $tomtat,
		'nd' => $noidung,
		'tt' => $tinhtrang,
		'nt'=> $_POST['nentang'],
		'dm' => $danhmuc
	]);
	
	header('Location:../../index.php?action=quanlysp');
}elseif(isset($_POST['suasanpham'])){
	//sua
	if($_FILES['files']['name'][0] != ''){ // ảnh nhận vào sẽ có dạng mảng 1 chiều
		//co anh moi
		$selectImg = $pdo->prepare(
			"SELECT * FROM tbl_anh WHERE masp = :masp"
		);
		$selectImg->execute([
			'masp' => $_GET['masp']
		]);
		
		//xoa hinh anh cu

		while($row = $selectImg->fetch()){
			// xoa tren clondinary
			$data = $cloudinary->uploadApi()->destroy($row['tenanh']);
		}

		//xoa anh tren tbl_anh
		$del = $pdo->prepare("DELETE FROM tbl_anh WHERE masp = :ma");
		$del->execute(['ma'=>$_GET['masp']]);
		
		
		//upload tat ca cac anh
		$countfiles = count($_FILES['files']['name']);
		for($i = 0; $i < $countfiles; $i++) {
			try{
				$filename = $_FILES['files']['name'][$i];
				$file_tmp = $_FILES['files']['tmp_name'][$i];
				$data = $cloudinary->uploadApi()->upload(
					$file_tmp, 
					[
						'public_id' => $filename
					]
				);
	
				$query = "INSERT INTO tbl_anh VALUES(:id, :masp, :ten, :link)";
				$upload = $pdo->prepare($query);
				$upload->execute([
					'id' => null,
					'masp' => $masp,
					'ten' => $filename,
					'link' => $data['secure_url']
				]);
			}catch (Exception $e) {
				echo "ĐÃ có lỗi xảy ra";
			}
		}


		// update tbl_sanpham
		$update = $pdo->prepare(
			"UPDATE tbl_sanpham 
			SET tensanpham = :ten, masp = :ma, giasp = :gia, soluong = :sl, tomtat = :tom, 
			noidung =:nd, tinhtrang = :tt, nentang = :nt, id_danhmuc = :dm
			WHERE masp = :masp"
		);
		$update->execute([
			'ten' => $tensanpham,
			'ma' => $masp,
			'gia' => $giasp,
			'sl' => $soluong,
			'tom' => $tomtat,
			'nd' => $noidung,
			'tt' => $tinhtrang,
			'nt'=> $_POST['nentang'],
			'dm' => $danhmuc,
			'masp' => $_GET['masp']
		]);
	
	}else{
		//khong co anh moi
		//update tbl_sanpham
		$update = $pdo->prepare(
			"UPDATE tbl_sanpham 
			SET tensanpham = :ten, masp = :ma, giasp = :gia, soluong = :sl, tomtat = :tom, 
			noidung =:nd, tinhtrang = :tt, id_danhmuc = :dm 
			WHERE masp = :masp"
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
			'masp' => $_GET['masp']
		]);
		

		echo 'sua k co anh';
	}
	header('Location:../../index.php?action=quanlysp');
	
}else{
	//xoa
	$id=$_GET['idsanpham'];
	
	$rem = $pdo->prepare(
		"SELECT * FROM tbl_anh WHERE masp = :ma"
	);
	$rem->execute([
		'ma' => $_GET['masp']
	]);
	
	//$count = $rem->rowCount();
	//echo $count;
	
	while($row = $rem->fetch()){
		$data = $cloudinary->uploadApi()->destroy($row['tenanh']);
	}
	
	$delete = $pdo->prepare(
		"DELETE FROM tbl_sanpham WHERE masp = :ma"
	);
	$delete->execute(['ma' => $_GET['masp']]);
	
	
	$removeImg = $pdo->prepare(
		"DELETE FROM tbl_anh WHERE masp = :ma"
	);
	$removeImg->execute(['ma' => $_GET['masp']]);
	header('Location:../../index.php?action=quanlysp&query=them');
	echo 'xoa';
}

?>