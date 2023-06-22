<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	// $_POST['idcode']='100001';
	$strSQL = "SELECT a.stcode,a.stname1,a.unit,b.amount,b.amtprice,b.price,c.grname,d.typename,e.bdname,f.clname,a.status FROM `product` as a ";
	$strSQL .= " inner join `product_level` as b on (a.stcode=b.stcode) ";
	$strSQL .= " inner join `group` as c on (a.grcode=c.grcode) ";
	$strSQL .= " inner join `type` as d on (a.typecode=d.typecode) ";
	$strSQL .= " left outer join `brand` as e on (a.bdcode=e.bdcode) ";	
	$strSQL .= " left outer join `color` as f on (a.clcode=f.clcode) ";	
	$strSQL .= " where a.stcode = '".$_POST['idcode']."'  ";
	$query = mysqli_query($conn,$strSQL);
	
	$json_result=array(
		"stcode" => array(),
		"stname1" => array(),
		"unit" => array(),
		"amount" => array(),
		"amtprice" => array(),
		"price" => array(),
		"grname" => array(),
		"typename" => array(),
		"bdname" => array(),
		"clname" => array(),	
		"status" => array()
		
        );
        while($row = $query->fetch_assoc()) {
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['unit'],$row["unit"]);
			array_push($json_result['amount'],$row["amount"]);
			array_push($json_result['amtprice'],$row["amtprice"]);
			array_push($json_result['price'],$row["price"]);
			array_push($json_result['grname'],$row["grname"]);
			array_push($json_result['typename'],$row["typename"]);
			array_push($json_result['bdname'],$row["bdname"]);
			array_push($json_result['clname'],$row["clname"]);
			array_push($json_result['status'],$row["status"]);
        }
        echo json_encode($json_result);



?>