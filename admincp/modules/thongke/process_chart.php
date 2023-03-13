<?php

require '../../../carbon/autoload.php';

use Carbon\Carbon;
use Carbon\CarbonInterval;
include("../../config/conect.php");

if(isset($_POST['thoigian'])){
    $thoigian = $_POST['thoigian'];
}else{
    $thoigian="";
    $subdays = Carbon::now("Asia/Ho_Chi_Minh")->subdays(365)->toDateString();
}

if($thoigian == '7ngay'){
    $subdays = Carbon::now("Asia/Ho_Chi_Minh")->subdays(7)->toDateString();
}elseif($thoigian == '30ngay'){
    $subdays = Carbon::now("Asia/Ho_Chi_Minh")->subdays(30)->toDateString();
}elseif($thoigian== '60ngay'){
    $subdays = Carbon::now("Asia/Ho_Chi_Minh")->subdays(60)->toDateString();
}elseif($thoigian== '90ngay'){
    $subdays = Carbon::now("Asia/Ho_Chi_Minh")->subdays(90)->toDateString();
}elseif($thoigian == '180ngay'){
    $subdays = Carbon::now("Asia/Ho_Chi_Minh")->subdays(180)->toDateString();
}elseif($thoigian== '365ngay'){
    $subdays = Carbon::now("Asia/Ho_Chi_Minh")->subdays(365)->toDateString();
}


$now = Carbon::now("Asia/Ho_Chi_Minh")->toDateString();


$stmt = $pdo->prepare(
    "SELECT * FROM tbl_thongke WHERE ngaydat BETWEEN :sub AND :ht ORDER BY ngaydat ASC" 
);
$stmt->execute([
    'sub'=>$subdays,
    'ht'=>$now
]);

while($row = $stmt->fetch()){
    $chart_data[] = array(
        'date' => $row['ngaydat'],
        'order'=> $row['donhang'],
    );
}

echo $data =json_encode($chart_data);
?>