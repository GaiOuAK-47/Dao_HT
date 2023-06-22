<?php
	header('Content-Type: application/json');
	include_once('../../conn.php');

	$sql = "SELECT supcode,supname,province,idno,road,subdistrict,district,status ";
	$sql .= "FROM supplier  ";   

	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
        "supcode" => array(),
		"supname" => array(),
		"province" => array(),		
		"address" => array(),		
		"status" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
            array_push($json_result['supcode'],$row["supcode"]);
			array_push($json_result['supname'],$row["supname"]);
			array_push($json_result['province'],$row["province"]);
			array_push($json_result['address'],$row["idno"]." ".$row["road"]." ".$row["subdistrict"]." ".$row["district"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



?>