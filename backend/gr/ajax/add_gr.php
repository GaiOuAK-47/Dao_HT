<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $recamount = explode(',', $_POST['recamount']);
    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    $pocode = explode(',', $_POST['pocode']);
    $price = explode(',', $_POST['price']);
    $discount = explode(',', $_POST['discount']);
    

    $code;
    $grcode;
    $yeargrcode;
    
    $sql = "SELECT * FROM options order by year desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

        while($row = $query->fetch_assoc()) {
            $code=sprintf("%04s", ($row["maxgrcode"]+1));
            $yeargrcode=substr( $row["year"], -2);
			$grcode= 'GR'.$yeargrcode.'/'.$code;
            
        }

    $StrSQL = "INSERT INTO grmaster (grcode,supcode,grdate,invcode,invdate,payment ,date , time";
    $StrSQL .= ")";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$grcode."','".$_POST["add_supcode"]."','".$_POST["add_grdate"]."','".$_POST["add_invcode"]."','".$_POST["add_invdate"]."','".$_POST["add_payment"]."' ";
    $StrSQL .= " , '".date("Y-m-d")."','".date("H:i:s")."' ";
    $StrSQL .= ") ";
    $query = mysqli_query($conn,$StrSQL);

    if($query) {
        $strSQL = "UPDATE options SET ";
        $strSQL .= "maxgrcode='".$code."' ";
        $strSQL .= "WHERE year= ".date("Y")." ";
        $query = mysqli_query($conn,$strSQL);

        
        foreach ($stcode as $key=> $value) {

            $sql3 = "SELECT amount,recamount FROM podetail where pocode = '".$pocode[$key]."' and stcode = '".$stcode[$key]."' ";
	        $query3 = mysqli_query($conn,$sql3);
            $checkstatus;
            while($row = $query3->fetch_assoc()) {

                $poamount=$row["amount"];

                if($poamount != ($amount[$key]+$row["recamount"]))
                $checkstatus='รับยังไม่ครบ';
                else 
                $checkstatus='รับครบแล้ว';
            }

            $strSQL2 = "UPDATE product_level SET ";
            $strSQL2 .= "price= price + '".(($price[$key]*$amount[$key])-(($price[$key]*$amount[$key])*$discount[$key]/100) )."',amount= amount+'".$amount[$key]."',amtprice= price/amount ";
            $strSQL2 .= "WHERE stcode = '".$stcode[$key]."' and places = '1' ";
            $query2 = mysqli_query($conn,$strSQL2);

            $strSQL2 = "UPDATE podetail SET ";
            $strSQL2 .= "recamount= recamount+'".$amount[$key]."',supstatus = '".$checkstatus."' ";
            $strSQL2 .= "WHERE stcode = '".$stcode[$key]."' and pocode = '".$pocode[$key]."' ";
            $query2 = mysqli_query($conn,$strSQL2);
            
            $StrSQL = "INSERT INTO grdetail (grcode , stcode , price , unit , amount , discount, pocode , grstatus, places  ";
        
            //grno ต้องอยู่ท้ายตลอด
            $StrSQL .= ", grno)";
            $StrSQL .= "VALUES (";
            $StrSQL .= "'".$grcode."', '". $stcode[$key] ."', '". $price[$key] ."', '". $unit[$key] ."' , '". $amount[$key] ."', '". $discount[$key] ."', '". $pocode[$key] ."' , '".$checkstatus."', '1' ";            
            $StrSQL .= ", '". ++$key ."' ) ";
            $query2 = mysqli_query($conn,$StrSQL);


        }        
            
        
    }
    
    // echo $StrSQL;

    
        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มใบรับสินค้า '. $grcode.' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
    
        mysqli_close($conn);
?>