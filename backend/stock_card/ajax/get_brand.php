<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	// $_POST['idcode']='100001';
	$strSQL = "SELECT * FROM `brand`  where grcode = '".$_POST['idcode']."' and status = 'Y'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
		"bdcode" => array(),
		"bdname" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			array_push($json_result['bdcode'],$row["bdcode"]);
			array_push($json_result['bdname'],$row["bdname"]);
        }
        echo json_encode($json_result);



?>