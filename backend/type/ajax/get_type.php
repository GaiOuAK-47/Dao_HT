<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set('Asia/Bangkok');

	$sql = "SELECT * FROM `type` as a inner join `group` as b on (a.grcode=b.grcode) ";
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
		"typecode" => array(),
        "typename" => array(),
		"grname" => array(),
		"status" => array()
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['typecode'],$row["typecode"]);
            array_push($json_result['typename'],$row["typename"]);
			array_push($json_result['grname'],$row["grname"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>