<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    // $_POST['idcode']='N6605009';
    $sql = "SELECT b.socode,b.sono,c.stcode,b.amount,b.cost,b.unit,b.price ";
	$sql .= "FROM sodetail as b inner join product as c on (c.stcode=b.stcode) ";
	$sql .= "where b.socode = '".$_POST['idcode']."' order by b.sono ";

    $stcode=[];
    $amount=[];
    $cost=[];
    $query = mysqli_query($conn,$sql);

    while($row = $query->fetch_assoc()) {

        array_push($stcode,$row["stcode"]);
        array_push($amount,$row["amount"]);
        array_push($cost,$row["cost"]);
    }

    if($query) {
        
        foreach ($stcode as $key=> $value) {
            $strSQL2 = "UPDATE product_level SET ";
            $strSQL2 .= "price= price + '".(($cost[$key]))."'*'".(($amount[$key]))."',amount= amount+'".$amount[$key]."',amtprice= price/amount ";
            $strSQL2 .= "WHERE stcode = '".$stcode[$key]."' and places = '1' ";
            $query2 = mysqli_query($conn,$strSQL2);
        }

        if($query2)
        {
            $StrSQL = "UPDATE sodetail SET supstatus = 'ยกเลิก' WHERE socode = '".$_POST['idcode']."' ";
            $query3 = mysqli_query($conn,$StrSQL);  
        }
    }

    if($query3) {
        echo json_encode(array('status' => '1','message'=> "ยกเลิกการใบขายสินค้าสำเร็จ"));
    }
    else
    {
        echo json_encode(array('status' => '0','message'=> $StrSQL));
    }
    exit;
?>
