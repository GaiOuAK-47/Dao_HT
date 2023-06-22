<?php
	header('Content-Type: application/json');
	include_once('../../conn.php');

	// $_POST['idcode']='100001';
	$strSQL = "SELECT * FROM `color`  where grcode = '".$_POST['idcode']."' and status = 'Y'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
		"clcode" => array(),
		"clname" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			array_push($json_result['clcode'],$row["clcode"]);
			array_push($json_result['clname'],$row["clname"]);
        }
        echo json_encode($json_result);



?>