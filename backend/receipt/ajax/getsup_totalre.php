<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	// $_POST['idcode']='SO23/0003';
	$sql = "SELECT b.recode,b.socode,payround,b.retype,b.status,b.price,b.stylepayment,b.remark, case when b.stylepayment = 'แบ่งชำระ' then 1 else 0  end as sumpay ";
	$sql .= "FROM receipt as b  ";
	$sql .= "where b.socode = '".$_POST['idcode']."' order by b.payround ";
	$query = mysqli_query($conn,$sql);
	
	$json_result=array(
		"recode" => array(),
		"socode" => array(),
		"payround" => array(),
		"retype" => array(),
		"status" => array(),
		"price" => array(),
		"stylepayment" => array(),
		"remark" => array(),
		"sumpay" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['recode'],$row["recode"]);
			array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['payround'],$row["payround"]);
			array_push($json_result['retype'],$row["retype"]);
			array_push($json_result['status'],$row["status"]);
			array_push($json_result['price'],$row["price"]);
			array_push($json_result['stylepayment'],$row["stylepayment"]);
			array_push($json_result['remark'],$row["remark"]);
			array_push($json_result['sumpay'],$row["sumpay"]);
        }
        echo json_encode($json_result);



?>