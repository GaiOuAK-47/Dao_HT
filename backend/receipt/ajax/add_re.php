<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set("Asia/Bangkok");
   

    $code;
    $recode;
    $yearrecode;
    $year = date("Y",strtotime($_POST["add_redate"]));
    $sql = "SELECT * FROM options where year = '".$year."' ";
	$query = mysqli_query($conn,$sql);

        while($row = $query->fetch_assoc()) {
            $code=sprintf("%04s", ($row["maxrecode"]+1));
            $yearrecode=substr( $row["year"], -2);            
			$recode= 'RE'.$yearrecode.'/'.$code;
        }

    $sql = "SELECT a.downpay+(a.installment*a.netinstallment) as pricetotal,a.netinstallment FROM somaster as a where a.socode = '".$_POST["socode"]."'  ";
    $query = mysqli_query($conn,$sql);
    $row = $query->fetch_assoc();

    $netinstallment = $row["netinstallment"]; 
    $pricetotal = $row["pricetotal"]; 

    $sql = "SELECT count(recode) as count,COALESCE(sum(price),0) as totalprice FROM receipt where socode = '".$_POST["socode"]."' and status != 'ยกเลิก' and stylepayment != 'ชำระเงินดาวน์' ";
    $query = mysqli_query($conn,$sql);
    $row = $query->fetch_assoc();

    $count = ($row["count"]+1); 
    $totalprice = $row["totalprice"]; 

    if($_POST["stylepayment"]!='ชำระเงินดาวน์');
    $count='';

    $StrSQL = "INSERT INTO receipt (recode,socode,redate,retype,`status`,price,balance,stylepayment,remark,payround,createby";
    $StrSQL .= ")";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$recode."','".$_POST["socode"]."','".$_POST["add_redate"]."','".$_POST["payment"]."','ชำระแล้ว','".$_POST["payprice"]."','".($pricetotal-($totalprice+$_POST["payprice"]))."','".$_POST["stylepayment"]."' ";
    $StrSQL .= ", '".$_POST["remark"]."' ,'".$count."', '".$_POST["id"]."'  ";
    $StrSQL .= ") ";
    $query = mysqli_query($conn,$StrSQL);

    if($query) {
        $strSQL = "UPDATE options SET ";
        $strSQL .= "maxrecode= maxrecode+1 ";
        $strSQL .= "WHERE year= '".$year."' ";
        $query = mysqli_query($conn,$strSQL);

    }

    
    if(($pricetotal-($totalprice+$_POST["payprice"])<=0))
    {
        $strSQL = "UPDATE sodetail SET ";
        $strSQL .= "supstatus= 'ชำระเงินครบแล้ว' ";
        $strSQL .= "WHERE socode = '".$_POST["socode"]."' ";
        $query = mysqli_query($conn,$strSQL);
    }

    if($_POST["stylepayment"]!='ชำระเงินดาวน์')
    {
    // echo $round.'<br>';
    $sql = "SELECT paid FROM installment where socode = '".$_POST["socode"]."' and ( status !='จ่ายแล้ว' and status !='ยกเลิก') ";
    $sql .= "ORDER BY `payround` LIMIT 1 ";
    $query = mysqli_query($conn,$sql);
    $row = $query->fetch_assoc();

    $payprice=$_POST["payprice"]+$row["paid"];
    $round=ceil($payprice/$netinstallment);

        for($num=1;$num<=$round;$num++)
        {
            $paid=0;
            $status='';
            if($num*$netinstallment<=$payprice)
            {
                $paid=$netinstallment;
                $status='จ่ายแล้ว';
            }
            else
            {
                $paid = $payprice-(($num-1)*$netinstallment);
                $status='จ่ายยังไม่ครบ';
            }

            $strSQL2 = "UPDATE installment SET ";
            $strSQL2 .= "paid= '".$paid."' , status= '".$status."' ";
            $strSQL2 .= "WHERE socode= '".$_POST["socode"]."' and ( status !='จ่ายแล้ว' and status !='ยกเลิก') ";
            $strSQL2 .= "ORDER BY `payround`LIMIT 1 ";
            $query2 = mysqli_query($conn,$strSQL2);
        }
    }
    else
    $query2=true;
    
        if($query2) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มใบเสร็จ '. $recode.' สำเร็จ', 'response_code' => $recode));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
    
        mysqli_close($conn);
?>