<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set('Asia/Bangkok');
	
	$strSQL = "SELECT a.clcode,a.clname,b.grcode,a.status FROM color as a inner join `group` as b on (a.grcode=b.grcode)";
	$strSQL .= " where a.clcode = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
		"clcode" => array(),
        "clname" => array(),
		"grcode" => array(),
		"status" => array()
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['clcode'],$row["clcode"]);
            array_push($json_result['clname'],$row["clname"]);
			array_push($json_result['grcode'],$row["grcode"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>