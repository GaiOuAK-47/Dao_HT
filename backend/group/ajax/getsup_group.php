<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set('Asia/Bangkok');
	
	$strSQL = "SELECT * FROM `group` where grcode = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
		"grcode" => array(),
        "grname" => array(),
		"grprecode" => array(),
		"status" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			array_push($json_result['grcode'],$row["grcode"]);
            array_push($json_result['grname'],$row["grname"]);
			array_push($json_result['grprecode'],$row["grprecode"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>