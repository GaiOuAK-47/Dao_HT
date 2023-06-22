<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	// $_POST['idcode']='SO23/0003';
	$sql = "SELECT * from(SELECT a.socode,a.firstpaydate,a.downpay,a.installment,a.netinstallment,a.round,ifnull(SUM(b.price),0) as totalpay,(a.downpay+(a.installment*a.netinstallment)) as totalnetpay ";
	$sql .= "FROM somaster as a left outer join receipt as b on (a.socode=b.socode) ";
	$sql .= "where a.socode = '".$_POST['idcode']."'  and b.status!='ยกเลิก') a  ";

	// echo $sql;
	$query = mysqli_query($conn,$sql);
	$row = $query->fetch_assoc();

	$json_result=array(
		"date" => array(),
		"payprice" => array(),
		"cost" => array(),
		"status" => array()		
		);
	
	$datelog=$row["firstpaydate"];
	$payprice=$row["downpay"];
	$status=0;
	
	for($num=0;$num<$row["installment"];$num++)
	{
		array_push($json_result['date'],$datelog);
		$datelog = date('Y-m-d', strtotime($datelog . ' +'.$row["round"].' day'));
		
		$payprice = $payprice+$row["netinstallment"];
		$status = $payprice<=(float)$row["totalpay"];

		array_push($json_result['payprice'],$payprice);
		array_push($json_result['cost'],(float)$row["totalpay"]);
		array_push($json_result['status'],$status);
	}	
		
        
        echo json_encode($json_result);



?>