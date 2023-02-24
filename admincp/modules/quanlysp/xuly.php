<?php
//include('../../config/config.php');
include "../../config/conect.php";
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
	// $sql_them = "INSERT INTO tbl_sanpham(tensanpham,masp,giasp,soluong,hinhanh,tomtat,noidung,tinhtrang,id_danhmuc) 
	// VALUE('".$tensanpham."','".$masp."','".$giasp."','".$soluong."','".$hinhanh."','".$tomtat."','".$noidung."','".$tinhtrang."','".$danhmuc."')";
	// mysqli_query($mysqli,$sql_them);

	//xu ly anh new
	$countfiles = count($_FILES['files']['name']);
	$query = "INSERT INTO tbl_anh VALUES(:id, :masp, :ten)";
	$upload = $pdo->prepare($query);
	for($i = 0; $i < $countfiles; $i++) {
  
        // File name
        $filename = $_FILES['files']['name'][$i];
      
        // Location
        $target_file = 'uploads/'.$filename;
      
        // file extension
        $file_extension = pathinfo(
            $target_file, PATHINFO_EXTENSION);
             
        $file_extension = strtolower($file_extension);
      
        // Valid image extension
        $valid_extension = array("png","jpeg","jpg");
      
        if(in_array($file_extension, $valid_extension)) {
  
            // Upload file
            if(move_uploaded_file(
                $_FILES['files']['tmp_name'][$i],
                $target_file)
            ) {
 
                // Execute query
                $upload->execute([
					'id' => null,
					'masp' => $masp,
					'ten' => $filename
				]);
            }
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
	
	header('Location:../../index.php?action=quanlysp&query=them');
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
		  	unlink('uploads/'.$row['tenanh']);
		}

		$del = $pdo->prepare("DELETE FROM tbl_anh WHERE masp = :ma");
		$del->execute(['ma'=>$_GET['masp']]);
		
		
		
		$countfiles = count($_FILES['files']['name']);
		$query = "INSERT INTO tbl_anh VALUES(:id, :masp, :ten)";
		$upload = $pdo->prepare($query);
		for($i = 0; $i < $countfiles; $i++) {
	  
			// File name
			$filename = $_FILES['files']['name'][$i];
		  
			// Location
			$target_file = 'uploads/'.$filename;
		  
			// file extension
			$file_extension = pathinfo(
				$target_file, PATHINFO_EXTENSION);
				 
			$file_extension = strtolower($file_extension);
		  
			// Valid image extension
			$valid_extension = array("png","jpeg","jpg");
		  
			if(in_array($file_extension, $valid_extension)) {
	  
				// Upload file
				if(move_uploaded_file(
					$_FILES['files']['tmp_name'][$i],
					$target_file)
				) {
	 
					//Execute query
					$upload->execute([
						'id' => null,
						'masp' => $masp,
						'ten' => $filename
					]);
				}
			}
		}

		$update = $pdo->prepare(
			"UPDATE tbl_sanpham 
			SET tensanpham = :ten, masp = :ma, giasp = :gia, soluong = :sl, tomtat = :tom, 
			noidung =:nd, tinhtrang = :tt, id_danhmuc = :dm 
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
			'dm' => $danhmuc,
			'nt'=> $_POST['nentang'],
			'masp' => $_GET['masp']
		]);

		
	
	}else{
		//khong co anh moi
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
	header('Location:../../index.php?action=quanlysp&query=them');
	
}else{
	//xoa
	// $id=$_GET['idsanpham'];
	// $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id' LIMIT 1";
	// $query = mysqli_query($mysqli,$sql);
	// $rem = $pdo->prepare(
	// 	"SELECT * FROM tbl_anh WHERE masp = :ma"
	// );
	// $rem->execute([
	// 	'ma' => $_GET['masp']
	// ]);
	
	// $count = $rem->rowCount();
	// echo $count;
	
	// while($row = $rem->fetch()){
	// 	unlink('uploads/'.$row['tenanh']);
	// }
	
	// $delete = $pdo->prepare(
	// 	"DELETE FROM tbl_sanpham WHERE masp = :ma"
	// );
	// $delete->execute(['ma' => $_GET['masp']]);
	
	
	// $removeImg = $pdo->prepare(
	// 	"DELETE FROM tbl_anh WHERE masp = :ma"
	// );
	// $removeImg->execute(['ma' => $_GET['masp']]);
	// header('Location:../../index.php?action=quanlysp&query=them');
	echo 'xoa';
}

?>