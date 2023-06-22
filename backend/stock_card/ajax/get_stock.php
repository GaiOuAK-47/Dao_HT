<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	$sql = "SELECT a.id,b.amount as amount1,b.amtprice,c.grname,a.stcode,a.stname1,a.unit,a.status ";
	$sql .= "FROM product a inner join product_level as b on (a.stcode=b.stcode) ";  
	$sql .= " inner join `group` as c on (a.grcode=c.grcode) ";  
	$sql .= " where b.places = 1 and a.status = 'Y' ";  

	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
		"id" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount1" => array(),
		"amtprice" => array(),		
		"grname" => array(),
		"unit" => array(),
		"status" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['id'],$row["id"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount1'],$row["amount1"]);
			array_push($json_result['amtprice'],$row["amtprice"]);
			array_push($json_result['grname'],$row["grname"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



?>