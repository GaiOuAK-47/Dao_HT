<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set('Asia/Bangkok');

    $strSQL = "UPDATE type SET ";
    $strSQL .= "typename='".$_POST["typename"]."',grcode='".$_POST["grcode"]."',status='".$_POST["status"]."',s_date='".date("Y-m-d")."',s_time='".date("H:i:s")."',s_user='".$_POST["id"]."' ";
    $strSQL .= "WHERE typecode= '".$_POST["typecode"]."' ";

    
	$query = mysqli_query($conn,$strSQL);
    
    // echo $strSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขประเภท '.$_POST["typename"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>