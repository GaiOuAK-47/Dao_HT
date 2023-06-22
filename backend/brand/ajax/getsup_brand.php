<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set('Asia/Bangkok');
	
	$strSQL = "SELECT a.bdcode,a.bdname,b.grcode,a.status FROM brand as a inner join `group` as b on (a.grcode=b.grcode)";
	$strSQL .= " where a.bdcode = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
		"bdcode" => array(),
        "bdname" => array(),
		"grcode" => array(),
		"status" => array()
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['bdcode'],$row["bdcode"]);
            array_push($json_result['bdname'],$row["bdname"]);
			array_push($json_result['grcode'],$row["grcode"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>