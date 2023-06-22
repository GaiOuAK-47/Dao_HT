<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    if( $_POST["flg"] ){
        $status = "ส่งสินค้าแล้ว";
        $flg = "ยืนยันการส่งสินค้าสำเร็จ"; 
    }else{
        $status = "ยังไม่ส่งของ";
        $flg = "ยกเลิกการส่งสินค้าสำเร็จ";        
    }
    
    $StrSQL = "UPDATE somaster SET delstatus = '$status' WHERE socode = '".$_POST['idcode']."' ";
    $query = mysqli_query($conn,$StrSQL);  
    if( $query) {
        echo json_encode(array('status' => '1','message'=> $flg));
    }
    else
    {
        echo json_encode(array('status' => '0','message'=> $StrSQL));
    }
    exit;
?>
