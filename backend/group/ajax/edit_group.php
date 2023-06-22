<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set('Asia/Bangkok');

    $strSQL = "UPDATE `group` SET ";
    $strSQL .= "grname='".$_POST["grname"]."',status='".$_POST["status"]."',grprecode='".$_POST["grprecode"]."'";
    $strSQL .= ",e_date='".date("Y-m-d")."',e_time='".date("H:i:s")."',e_user='".$_POST["id"]."' ";
    $strSQL .= "WHERE grcode= '".$_POST["grcode"]."' ";

    
	$query = mysqli_query($conn,$strSQL);
    
    // echo $strSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขหมวด '.$_POST["grname"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>