<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	$strSQL = "SELECT a.id,a.stcode,a.stname1,b.amount ,a.unit ";
	$strSQL .= " FROM `product` as a inner join product_level as b on (a.stcode=b.stcode) ";
	$strSQL .= " where a.status = 'Y'";
	$query = mysqli_query($conn,$strSQL);

	
	$json_result=array(
		"id" => array(),
        "stcode" => array(),
		"stname1" => array(),
        "amount" => array(),
		"unit" => array()
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['id'],$row["id"]);
            array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['unit'],$row["unit"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>