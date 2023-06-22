<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	// $_POST['idcode']='SO23/0003';
	$sql = "SELECT a.socode,'ยอดชำระเงินดาวน์' as stname1,1 as amount,a.downpay as price ,a.downpay as totalprice ";
	$sql .= "FROM somaster as a where a.socode = '".$_POST['idcode']."' ";
	$sql .= " UNION ";
	$sql .= " SELECT a.socode,'ยอดผ่อนสินค้า' as stname1,a.installment as amount,a.netinstallment as price ,a.installment*a.netinstallment as totalprice ";
	$sql .= " FROM somaster as a where a.socode = '".$_POST['idcode']."' ";
	$query = mysqli_query($conn,$sql);

	// echo $sql;

	$json_result=array(
		"socode" => array(),
		"stname1" => array(),
		"amount" => array(),	
		"price" => array(),
		"totalprice" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['amount'],$row["amount"]);	
			array_push($json_result['price'],$row["price"]);
			array_push($json_result['totalprice'],$row["totalprice"]);
        }
        echo json_encode($json_result);



?>