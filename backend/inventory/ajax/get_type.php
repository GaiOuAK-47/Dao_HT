<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	// $_POST['idcode']='100001';
	$strSQL = "SELECT * FROM `type`  where grcode = '".$_POST['idcode']."' and status = 'Y'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
		"typecode" => array(),
		"typename" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			array_push($json_result['typecode'],$row["typecode"]);
			array_push($json_result['typename'],$row["typename"]);
        }
        echo json_encode($json_result);



?>