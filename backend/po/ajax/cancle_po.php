<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    // $_POST['idcode']='N6605009';
   
    $StrSQL = "UPDATE podetail SET supstatus = 'ยกเลิก' WHERE pocode = '".$_POST['idcode']."' ";
    $query3 = mysqli_query($conn,$StrSQL);  

    if($query3) {
        echo json_encode(array('status' => '1','message'=> "ยกเลิกการใบสั่งซื้อสินค้าสำเร็จ"));
    }
    else
    {
        echo json_encode(array('status' => '0','message'=> $StrSQL));
    }
    exit;
?>
