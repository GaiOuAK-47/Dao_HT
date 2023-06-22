<?php
	header('Content-Type: application/json');
	include('../conn.php');

	// $_POST['idcode']='SO23/0003';
	$sql = "SELECT * from(SELECT a.socode,c.cuscode,c.cusname,e.stcode,e.stname1,a.firstpaydate,a.downpay,a.installment,a.netinstallment,a.round,ifnull(SUM(b.price),0) as totalpay,(a.downpay+(a.installment*a.netinstallment)) as totalnetpay ";
	$sql .= "FROM somaster as a left outer join receipt as b on (a.socode=b.socode) ";
	$sql .= " inner join customer as c on (a.cuscode=c.cuscode) ";
	$sql .= " inner join sodetail as d on (a.socode=d.socode) ";
	$sql .= " inner join product as e on (d.stcode=e.stcode) ";
	// $sql .= "where a.socode = '".$_POST['idcode']."'  ";
	$sql .= " ) a ";
	$sql .= " group by a.cuscode order by a.socode ";

	// echo $sql;
	$query = mysqli_query($conn,$sql);

	$json_result=array(
		"cuscode" => array(),
		"cusname" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"netinstallment" => array(),		
		"date" => array(),
		"paid" => array(),		
		"mustpay" => array(),
		"actualpay" => array(),
		"status" => array()		
		);
	
	// $datelog=$row["firstpaydate"];
	// $payprice=$row["downpay"];
	$status=0;
	$balance=0;
	
	while($row = $query->fetch_assoc()) {
		// $datelog = date('Y-m-d', strtotime($datelog . ' +'.$row["round"].' day'));
		$payprice = $row["netinstallment"];

		//var_dump($row);
		array_push($json_result['date'],$row["firstpaydate"]);
		
		$status = $payprice<=(float)$row["totalpay"];
		array_push($json_result['cuscode'],$row["cuscode"]);
		array_push($json_result['cusname'],$row["cusname"]);	
		array_push($json_result['stcode'],$row["stcode"]);
		array_push($json_result['stname1'],$row["stname1"]);
		array_push($json_result['netinstallment'],$row["netinstallment"]);		
		$balance=((float)$row["totalpay"])-$payprice;
		if($balance<=0)
		$balance=0;
		array_push($json_result['paid'],$balance);
		array_push($json_result['mustpay'],$payprice);

		array_push($json_result['actualpay'],((float)$row["totalpay"])-$payprice+$row["netinstallment"]);		
		array_push($json_result['status'],$status);

		array_push($json_result['date'],$row["firstpaydate"]);
		
		$status = $payprice<=(float)$row["totalpay"];
		array_push($json_result['cuscode'],$row["cuscode"]);
		array_push($json_result['cusname'],$row["cusname"]);	
		array_push($json_result['stcode'],$row["stcode"]);
		array_push($json_result['stname1'],$row["stname1"]);
		array_push($json_result['netinstallment'],$row["netinstallment"]);		
		$balance=((float)$row["totalpay"])-$payprice;
		if($balance<=0)
		$balance=0;
		array_push($json_result['paid'],$balance);
		array_push($json_result['mustpay'],$payprice);

		array_push($json_result['actualpay'],((float)$row["totalpay"])-$payprice+$row["netinstallment"]);		
		array_push($json_result['status'],$status);
	}	
		
	//exit;
    echo json_encode($json_result);



?>