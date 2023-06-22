<?php
	header('Content-Type: application/json');
	include('../../conn.php');
    
    date_default_timezone_set("Asia/Bangkok");

    
    $StrSQL = "UPDATE grmaster SET edate = '".date("Y-m-d")."', etime='".date("H:i:s")."' ";
    $StrSQL .= ",grdate='".$_POST["grdate"]."' ,invdate='".$_POST["invdate"]."',payment='".$_POST["payment"]."' ,invcode='".$_POST["invcode"]."' ";
    $StrSQL .= "WHERE grcode='".$_POST["grcode"]."' ";
    $query = mysqli_query($conn,$StrSQL);

    
    // echo $StrSQL;

    
        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขใบรับสินค้าเรียบร้อยแล้ว '. $_POST["grcode"].' สำเร็จ','sql'=> $StrSQL));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
    
        mysqli_close($conn);
?>