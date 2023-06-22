<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	$sql = "SELECT * from (SELECT a.socode,b.sodate,c.cuscode,c.cusname,COUNT(a.stcode) as total,(b.downpay+(b.installment*b.netinstallment)) as pricetotal,ifnull((select sum(rc.price) pr from receipt rc where rc.socode = a.socode and rc.status != 'ยกเลิก'), 0) price,a.supstatus,f.firstname,f.lastname ";
	$sql .= "   FROM `sodetail` as a  ";
	$sql .= "  inner join somaster as b on (a.socode=b.socode)";
	$sql .= "  inner join customer as c on (b.cuscode=c.cuscode)";
	$sql .= "  left outer join user as f on (b.user=f.code)";
	$sql .= "  where a.supstatus = 'รอออกใบเสร็จรับเงิน'  group by socode) as z WHERE pricetotal>price";
	$query = mysqli_query($conn,$sql);

	// echo $sql;
	
	$json_result=array(
		"socode" => array(),
		"sodate" => array(),
		"cuscode" => array(),
		"cusname" => array(),
		"total" => array(),
        "pricetotal" => array(),
		"price" => array(),
		"supstatus" => array(),
		"firstname" => array(),
		"lastname" => array()
		);
		
        while($row = $query->fetch_assoc()) {
			array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['sodate'],$row["sodate"]);
			array_push($json_result['cuscode'],$row["cuscode"]);
			array_push($json_result['cusname'],$row["cusname"]);
			array_push($json_result['total'],$row["total"]);
			array_push($json_result['pricetotal'],$row["pricetotal"]);
			array_push($json_result['price'],(float)$row["price"]);
			array_push($json_result['supstatus'],$row["supstatus"]);
			array_push($json_result['firstname'],$row["firstname"]);
			array_push($json_result['lastname'],$row["lastname"]);
        }
        echo json_encode($json_result);



		mysqli_close($conn);
?>