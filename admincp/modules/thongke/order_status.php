<?php

    include("../../config/conect.php");

    $notyet = $pdo->prepare(
        "SELECT COUNT(id_donhang) as sl FROM tbl_donhang WHERE tbl_donhang.hoanthanh = 0"
    );
    $notyet->execute();

    while($row_1 = $notyet->fetch()){
        if($row_1['sl'] == null){$row1 =0;}else $row1=$row_1['sl'];
        $chart_data[] = array(
            'label' => "Not Yet",
            'value' => $row1,
        );

    };
    

    $compl = $pdo->prepare(
        "SELECT COUNT(id_donhang) as sl FROM tbl_donhang WHERE hoanthanh = 1"
    );
    while($row_2 = $compl->fetch()){
        echo $row_2['sl'];
        if($row_2['sl'] == ''){$row2 = 0;}else $row2=$row_2['sl'];
        $chart_data[] = array(
            'label' => 'Complete',
            'value' => $row2,
        );
    };
    

    $canc=$pdo->prepare(
        "SELECT COUNT(id_donhang) as sl FROM tbl_donhang WHERE hoanthanh = -1"
    );

    while( $row_3 = $canc->fetch()){
    
        if($row_3['sl'] == ''){$row3 =0;}else $row3=$row_3['sl'];
        $chart_data[] = array(
            'label' => 'Cancel',
            'value' => $row3,
        );
    }
    
    echo $data = json_encode($chart_data);
?>