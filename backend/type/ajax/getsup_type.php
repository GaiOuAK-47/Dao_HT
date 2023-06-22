<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set('Asia/Bangkok');
	
	$strSQL = "SELECT * FROM `type` where typecode = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
		"typecode" => array(),
        "typename" => array(),
		"status" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			array_push($json_result['typecode'],$row["typecode"]);
            array_push($json_result['typename'],$row["typename"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>