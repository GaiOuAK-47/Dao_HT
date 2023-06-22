<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set('Asia/Bangkok');

    $strSQL = "UPDATE color SET ";
    $strSQL .= "clname='".$_POST["clname"]."',grcode='".$_POST["grcode"]."',status='".$_POST["status"]."',s_date='".date("Y-m-d")."',s_time='".date("H:i:s")."',s_user='".$_POST["id"]."' ";
    $strSQL .= "WHERE clcode= '".$_POST["clcode"]."' ";

    
	$query = mysqli_query($conn,$strSQL);
    
    // echo $strSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขสี '.$_POST["clname"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>