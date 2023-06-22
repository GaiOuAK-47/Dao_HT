<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	// $_POST['idcode']='100001';
	$strSQL = "SELECT * FROM `group`  where grcode = '".$_POST['idcode']."' and status = 'Y'";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
		"stcode" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			$code=sprintf("%04s", ($row["grruncode"]+1));
            $grprecode=$row["grprecode"];
            array_push($json_result['stcode'],$grprecode.$code);
        }
        echo json_encode($json_result);



?>
