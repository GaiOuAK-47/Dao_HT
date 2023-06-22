<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	$sql = "SELECT b.socode,b.sono,c.stcode,c.stname1,b.amount,b.cost,b.unit,b.price,b.discount,b.supstatus ";
	$sql .= "FROM sodetail as b inner join product as c on (c.stcode=b.stcode) ";
	$sql .= "where b.socode = '".$_POST['idcode']."' order by b.sono ";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"socode" => array(),
		"sono" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount" => array(),
		"cost" => array(),		
		"unit" => array(),
		"price" => array(),
		"discount" => array(),
		"supstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['sono'],$row["sono"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['cost'],$row["cost"]);			
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['price'],$row["price"]);
			array_push($json_result['discount'],$row["discount"]);
			array_push($json_result['supstatus'],$row["supstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>