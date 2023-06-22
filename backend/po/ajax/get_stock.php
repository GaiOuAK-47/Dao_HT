<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	$sql = "SELECT * FROM `product` where status = 'Y'";
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"id" => array(),
        "stcode" => array(),
		"stname1" => array()
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['id'],$row["id"]);
            array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>