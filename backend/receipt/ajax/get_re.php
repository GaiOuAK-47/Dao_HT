<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	$sql = "SELECT a.recode,a.socode,a.redate,a.retype,a.price,a.stylepayment,b.downpay+(b.installment*b.netinstallment) as totalprice,a.status";
	$sql .= " ,(select sum(rc.price) pr from receipt rc where rc.socode = b.socode and rc.status != 'ยกเลิก') payprice,(b.downpay+(b.installment*b.netinstallment))-(select sum(rc.price) pr from receipt rc where rc.socode = b.socode and rc.status != 'ยกเลิก') balance,c.cuscode,c.cusname";
	$sql .= " FROM `receipt` as a inner join somaster as b on (a.socode=b.socode) inner join customer as c on (b.cuscode=c.cuscode) order by a.socode desc";
	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
		"recode" => array(),
        "socode" => array(),
		"redate" => array(),
		"retype" => array(),
		"price" => array(),
		"totalprice" => array(),
		"status" => array(),
		"payprice" => array(),
		"balance" => array(),
		"stylepayment" => array(),
		"cuscode" => array(),
		"cusname" => array()
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['recode'],$row["recode"]);
            array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['redate'],$row["redate"]);
			array_push($json_result['retype'],$row["retype"]);
			array_push($json_result['price'],$row["price"]);
			array_push($json_result['totalprice'],$row["totalprice"]);
			array_push($json_result['status'],$row["status"]);
			array_push($json_result['payprice'],$row["payprice"]);
			array_push($json_result['balance'],$row["balance"]);
			array_push($json_result['stylepayment'],$row["stylepayment"]);
			array_push($json_result['cuscode'],$row["cuscode"]);
			array_push($json_result['cusname'],$row["cusname"]);
			
        }
        echo json_encode($json_result);

		
	
		
		mysqli_close($conn);
?>