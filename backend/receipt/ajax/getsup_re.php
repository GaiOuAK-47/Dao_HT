<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set('Asia/Bangkok');
	
	// $_POST['idcode']='RE23/0005';
	$strSQL = "SELECT a.recode,a.socode,b.cuscode,c.cusname,a.redate,a.payround,a.stylepayment,a.price as payprice,a.retype,a.remark,c.idno,c.road,c.subdistrict,c.district,c.province,c.zipcode,a.status ";
	$strSQL .= " FROM receipt as a inner join `somaster` as b on (a.socode=b.socode) inner join `customer` as c on (b.cuscode=c.cuscode)";
	$strSQL .= " where a.recode = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$strSQL);
	
	// echo $strSQL;

	$json_result=array(
		"recode" => array(),
        "socode" => array(),
		"cuscode" => array(),
		"cusname" => array(),
		"address" => array(),
		"redate" => array(),
		"payround" => array(),	
		"stylepayment" => array(),			
		"payprice" => array(),						
		"payment" => array(),						
		"remark" => array(),						
		"status" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			$address = ($row["idno"] == '' ? '': 'เลขที่ '.$row["idno"].' ').($row["road"] == '' ? '': 'ถนน'.$row["road"].' ');
			$address .= ($row["subdistrict"] == '' ? '': 'ต.'.$row["subdistrict"].'  ').($row["district"] == '' ? '': 'อ.'.$row["district"].'  ');
			$address .= ($row["province"] == '' ? '': 'จ.'.$row["province"].' ').($row["zipcode"] == '' ? '': ' '.$row["zipcode"]);

			array_push($json_result['recode'],$row["recode"]);
            array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['cuscode'],$row["cuscode"]);
			array_push($json_result['cusname'],$row["cusname"]);
			array_push($json_result['redate'],$row["redate"]);			
			array_push($json_result['address'],$address);
			array_push($json_result['payround'],$row["payround"]);
			array_push($json_result['stylepayment'],$row["stylepayment"]);
			array_push($json_result['payprice'],$row["payprice"]);
			array_push($json_result['payment'],$row["retype"]);
			array_push($json_result['remark'],$row["remark"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>