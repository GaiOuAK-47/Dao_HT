<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set('Asia/Bangkok');
    
    $StrSQL = "INSERT INTO brand (`bdname`,`grcode`, `status`, s_date, s_time, s_user) ";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$_POST["add_bdname"]."','".$_POST["add_grcode"]."','Y' ";
    $StrSQL .= ",'".date("Y-m-d")."','".date("H:i:s")."','".$_POST["id"]."' ";    
    $StrSQL .= ")";
    $query = mysqli_query($conn,$StrSQL);
    
    // echo $StrSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มแบรนด์ '.$_POST["add_bdname"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>