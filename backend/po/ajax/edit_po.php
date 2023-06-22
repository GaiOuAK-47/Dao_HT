<?php
	header('Content-Type: application/json');
	include('../../conn.php');
    
    date_default_timezone_set("Asia/Bangkok");

    $price = explode(',', $_POST['price']);
    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    $discount = explode(',', $_POST['discount']);
    
    $StrSQL = "UPDATE pomaster SET edate = '".date("Y-m-d")."', etime='".date("H:i:s")."' ";
    $StrSQL .= ",deldate='".$_POST["deldate"]."' ,podate='".$_POST["podate"]."',payment='".$_POST["payment"]."' ,poqua='".$_POST["poqua"]."',currency='".$_POST["currency"]."' ,vat='".$_POST["vat"]."',remark='".$_POST["remark"]."' ";
    $StrSQL .= "WHERE pocode='".$_POST["pocode"]."' ";
    $query = mysqli_query($conn,$StrSQL);

    
    if($query) {
        foreach ($stcode as $key=> $value) {
            $StrSQL = "UPDATE podetail SET stcode='". $stcode[$key] ."' ,price ='". $price[$key] ."', unit ='". $unit[$key] ."', amount ='". $amount[$key] ."', discount = '". $discount[$key] ."'  ";
            $StrSQL .= "WHERE pocode='".$_POST["pocode"]."' and pono= '". ++$key ."' ";
            
            $query = mysqli_query($conn,$StrSQL);
            }
    }
    
    // echo $StrSQL;

    
        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขใบแจ้งซื้อเรียบร้อยแล้ว '. $_POST["pocode"].' สำเร็จ','sql'=> $StrSQL));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
    
        mysqli_close($conn);
?>