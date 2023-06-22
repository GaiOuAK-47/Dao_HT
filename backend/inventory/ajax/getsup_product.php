<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	// $_POST['idcode']='100001';
	$strSQL = "SELECT * FROM `product`  where stcode = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
		"stcode" => array(),
		"stname1" => array(),
		"unit" => array(),
		"grcode" => array(),
		"typecode" => array(),
		"bdcode" => array(),
		"clcode" => array(),
		"price" => array(),			
		"status" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['grcode'],$row["grcode"]);
			array_push($json_result['typecode'],$row["typecode"]);
			array_push($json_result['bdcode'],$row["bdcode"]);
			array_push($json_result['clcode'],$row["clcode"]);
			array_push($json_result['price'],$row["price"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



?>