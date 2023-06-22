<?php
	header('Content-Type: application/json');
	include('../../conn.php');
	
	// $_POST['idcode']='100001';
	$strSQL = "SELECT a.stcode,a.stname1,a.price,b.amtprice as cost,a.unit ";
	$strSQL .= " FROM `product` as a inner join product_level as b on (a.stcode=b.stcode) ";
	$strSQL .= " where a.stcode = '".$_POST['idcode']."'";
	$query = mysqli_query($conn,$strSQL);

	// echo $strSQL;
	
	$json_result=array(
		"stcode" => array(),
		"stname1" => array(),
		"price" => array(),
		"cost" => array(),
		"unit" => array()
		
        );

        while($row = $query->fetch_assoc()) {
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['price'],$row["price"]);
			array_push($json_result['cost'],$row["cost"]);
			array_push($json_result['unit'],$row["unit"]);
        }
        echo json_encode($json_result);



?>