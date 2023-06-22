<?php
	header('Content-Type: application/json');
	include_once('../../conn.php');

	$sql = "SELECT cuscode,cusname,province,idno,road,subdistrict,district,status ";
	$sql .= "FROM customer  ";   

	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
        "cuscode" => array(),
		"cusname" => array(),
		"province" => array(),		
		"address" => array(),		
		"status" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
            array_push($json_result['cuscode'],$row["cuscode"]);
			array_push($json_result['cusname'],$row["cusname"]);
			array_push($json_result['province'],$row["province"]);
			array_push($json_result['address'],$row["idno"]." ".$row["road"]." ".$row["subdistrict"]." ".$row["district"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



?>