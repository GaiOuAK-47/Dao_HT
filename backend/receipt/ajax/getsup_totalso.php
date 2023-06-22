<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	// $_POST['idcode']='SO23/0003';
	$sql = "SELECT b.socode,b.sono,c.stcode,c.stname1,b.amount,b.unit,b.price,a.netinstallment,a.downpay,b.discount,(b.price-(b.price*b.discount/100)*b.amount) as pricetotal,b.supstatus ";
	$sql .= "FROM sodetail as b inner join product as c on (c.stcode=b.stcode) inner join somaster as a on (a.socode=b.socode) ";
	$sql .= "where b.socode = '".$_POST['idcode']."' order by b.sono ";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
		"socode" => array(),
		"sono" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"amount" => array(),	
		"unit" => array(),
		"price" => array(),
		"netinstallment" => array(),
		"downpay" => array(),
		"pricetotal" => array(),
		"discount" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['sono'],$row["sono"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],$row["amount"]);		
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['price'],$row["price"]);
			array_push($json_result['netinstallment'],$row["netinstallment"]);
			array_push($json_result['downpay'],$row["downpay"]);
			array_push($json_result['pricetotal'],$row["pricetotal"]);
			array_push($json_result['discount'],$row["discount"]);
        }
        echo json_encode($json_result);



?>