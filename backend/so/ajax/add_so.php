<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $price = explode(',', $_POST['price']);
    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    $discount = explode(',', $_POST['discount']);
    $cost = explode(',', $_POST['cost']);
    

    // $code;
    // $socode;
    // $yearsocode;
    // $year = date("Y",strtotime($_POST["add_sodate"]));
    // $sql = "SELECT * FROM options where year = '".$year."' ";
	// $query = mysqli_query($conn,$sql);

    //     while($row = $query->fetch_assoc()) {
    //         $code=sprintf("%04s", ($row["maxsocode"]+1));
    //         $yearsocode=substr($row["year"], -2);     
	// 		$socode= 'SO'.$yearsocode.'/'.$code;            
    //     }

    $StrSQL = "INSERT INTO somaster (socode,cuscode,sodate,deldate,sotype,downpaydate,firstpaydate,payment,downpay,installment,netinstallment,round,remark,delstatus ,date , time, user";
    $StrSQL .= ")";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$_POST["add_socode"]."','".$_POST["add_cuscode"]."','".$_POST["add_sodate"]."','".$_POST["add_deldate"]."','".$_POST["add_sotype"]."' ";
    $StrSQL .= ",'".$_POST["add_downpaydate"]."','".$_POST["add_firstpaydate"]."','".$_POST["add_payment"]."','".$_POST["add_downpay"]."','".$_POST["add_installment"]."','".$_POST["add_netinstallment"]."' ";
    $StrSQL .= ", '".$_POST["add_round"]."', '".$_POST["add_remark"]."', 'ยังไม่ส่งของ' , '".date("Y-m-d")."','".date("H:i:s")."' ,'".$_POST["id"]."'";
    $StrSQL .= ") ";
    $query = mysqli_query($conn,$StrSQL);

    if($query) {
        if($_POST["add_sotype"]=='ผ่อนสินค้า')
        {
            $strSQL = "UPDATE socode SET ";
            $strSQL .= "number=number+1 ";        
            $strSQL .= " order by id desc LIMIT 1 ";
            
            $query = mysqli_query($conn,$strSQL);
        }
        else if($_POST["add_sotype"]=='ทอง')
        {
            $strSQL = "UPDATE sogoldcode SET ";
            $strSQL .= "number=number+1 ";        
            $strSQL .= " order by id desc LIMIT 1 ";
            
            $query = mysqli_query($conn,$strSQL);
        }
        if($query) {
        foreach ($stcode as $key=> $value) {
            $StrSQL = "INSERT INTO sodetail (socode , stcode , price , unit , amount , supstatus , discount, cost ";

            //pono ต้องอยู่ท้ายตลอด
            $StrSQL .= ", sono)";
            $StrSQL .= "VALUES (";
            $StrSQL .= "'".$_POST["add_socode"]."', '". $stcode[$key] ."', '". $price[$key] ."', '". $unit[$key] ."' , '". $amount[$key] ."' , 'รอออกใบเสร็จรับเงิน' ";
            $StrSQL .= ", '". $discount[$key] ."' , '". $cost[$key] ."'  ";
            $StrSQL .= ", '". ++$key ."' ) ";
            $query = mysqli_query($conn,$StrSQL);
            }
        }
    }

    if($query) {
        foreach ($stcode as $key=> $value) {
            $strSQL2 = "UPDATE product_level SET ";
            $strSQL2 .= "price= price - amtprice*'".(($amount[$key]))."',amount= amount-'".$amount[$key]."',amtprice= price/amount ";
            $strSQL2 .= "WHERE stcode = '".$stcode[$key]."' and places = '1' ";
            $query2 = mysqli_query($conn,$strSQL2);
        }
    }
    
    // echo $StrSQL;
    if($query2)
    {
        $sql = "SELECT * from(SELECT a.socode,a.firstpaydate,a.downpay,a.installment,a.netinstallment,a.round,ifnull(SUM(b.price),0) as totalpay,(a.downpay+(a.installment*a.netinstallment)) as totalnetpay ";
        $sql .= "FROM somaster as a left outer join receipt as b on (a.socode=b.socode) ";
        $sql .= "where a.socode = '".$_POST['add_socode']."'  and b.status!='ยกเลิก') a ";

        // echo $sql;
        $query = mysqli_query($conn,$sql);
        $row = $query->fetch_assoc();

        $datelog=$row["firstpaydate"];
        $payprice=$row["downpay"];
        $status=0;
        

        for($num=0;$num<$row["installment"];$num++)
        {		
            $paid=0;
            $payprice = $payprice+$row["netinstallment"];
            $status = $payprice<=(float)$row["totalpay"];

            if($status)
            {
                $status='จ่ายแล้ว';
                $paid=$row["netinstallment"];
            }
            else if(abs((float)$row["totalpay"]-$payprice)<$row["netinstallment"])
            {
                $status='ยังจ่ายไม่ครบ';
                $paid=$row["netinstallment"]-abs((float)$row["totalpay"]-$payprice);
            }
            else
            {
                $status='ยังไม่ได้จ่าย';
            }

            $StrSQL2 = "INSERT INTO installment (socode,paydate,mustpay,paid,status,payround";
            $StrSQL2 .= ")";
            $StrSQL2 .= "VALUES (";
            $StrSQL2 .= "'".$_POST["add_socode"]."','".$datelog."','".$row["netinstallment"]."','".$paid."', '".$status."', '".($num+1)."' ";
            $StrSQL2 .= ") ";
            $query3 = mysqli_query($conn,$StrSQL2);

            $datelog = date('Y-m-d', strtotime($datelog . ' +'.$row["round"].' day'));
        }	
    }

    
        if($query3) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มใบขายสินค้า '. $_POST["add_socode"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
    
        mysqli_close($conn);
?>