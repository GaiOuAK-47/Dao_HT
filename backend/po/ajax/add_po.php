<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $price = explode(',', $_POST['price']);
    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    $discount = explode(',', $_POST['discount']);
    

    $code;
    $pocode;
    $yearpocode;
    $sql = "SELECT * FROM options order by year desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

        while($row = $query->fetch_assoc()) {
            $code=sprintf("%04s", ($row["maxpocode"]+1));
            $yearsocode=substr( $row["year"], -2);            
			$pocode= 'PO'.$yearsocode.'/'.$code;
        }

    $StrSQL = "INSERT INTO pomaster (pocode,supcode,podate,deldate,payment,poqua,currency,vat,remark ,date , time";
    $StrSQL .= ")";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$pocode."','".$_POST["add_supcode"]."','".$_POST["add_podate"]."','".$_POST["add_deldate"]."','".$_POST["add_payment"]."','".$_POST["add_poqua"]."' ";
    $StrSQL .= ", '".$_POST["add_currency"]."' , '".$_POST["add_vat"]."' , '".$_POST["add_remark"]."' , '".date("Y-m-d")."','".date("H:i:s")."' ";
    $StrSQL .= ") ";
    $query = mysqli_query($conn,$StrSQL);

    if($query) {
        $strSQL = "UPDATE options SET ";
        $strSQL .= "maxpocode= maxpocode+1 ";
        $strSQL .= "WHERE year= '".date("Y")."' ";
        $query = mysqli_query($conn,$strSQL);
        foreach ($stcode as $key=> $value) {
            $StrSQL = "INSERT INTO podetail (pocode , stcode , price , unit , amount , supstatus , discount,recamount ";

            //pono ต้องอยู่ท้ายตลอด
            $StrSQL .= ", pono)";
            $StrSQL .= "VALUES (";
            $StrSQL .= "'".$pocode."', '". $stcode[$key] ."', '". $price[$key] ."', '". $unit[$key] ."' , '". $amount[$key] ."' , 'รอรับของ' ";
            $StrSQL .= ", '". $discount[$key] ."' , '0'  ";
            $StrSQL .= ", '". ++$key ."' ) ";
            $query = mysqli_query($conn,$StrSQL);
            }
    }
    
    // echo $StrSQL;

    
        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มผู้ใบสั่งซื้อ '. $pocode.' สำเร็จ', 'response_code' => $pocode));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
    
        mysqli_close($conn);
?>