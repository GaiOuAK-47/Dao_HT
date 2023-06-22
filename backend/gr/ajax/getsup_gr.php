<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	// $_POST['idcode'] = 'GR23/0001';
	$sql = "SELECT a.grcode,a.grdate,a.invcode,a.invdate,a.payment,c.stcode,c.stname1,a.supcode,d.supname,d.idno,d.road,d.subdistrict,d.district,d.province,d.zipcode,b.grstatus ";
	$sql .= "FROM `grmaster` as a inner join grdetail as b on (a.grcode=b.grcode) inner join product as c on (c.stcode=b.stcode) inner join supplier as d on (a.supcode=d.supcode) ";
	$sql .= "where a.grcode = '".$_POST['idcode']."'  LIMIT 1";
	
	$query = mysqli_query($conn,$sql);

	// echo $sql;
	
	$json_result=array(
        "grcode" => array(),
		"grdate" => array(),
		"invcode" => array(),
		"invdate" => array(),
		"payment" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"supcode" => array(),
		"supname" => array(),
		"address" => array(),
		"grstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			$address = ($row["idno"] == '' ? '': 'เลขที่ '.$row["idno"].' ').($row["road"] == '' ? '': 'ถนน'.$row["road"].' ');
			$address .= ($row["subdistrict"] == '' ? '': 'ต.'.$row["subdistrict"].'  ').($row["district"] == '' ? '': 'อ.'.$row["district"].'  ');
			$address .= ($row["province"] == '' ? '': 'จ.'.$row["province"].' ').($row["zipcode"] == '' ? '': ' '.$row["zipcode"]);

            array_push($json_result['grcode'],$row["grcode"]);
			array_push($json_result['grdate'],$row["grdate"]);
			array_push($json_result['invcode'],$row["invcode"]);
			array_push($json_result['invdate'],$row["invdate"]);
			array_push($json_result['payment'],$row["payment"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['supcode'],$row["supcode"]);
			array_push($json_result['supname'],$row["supname"]);
			array_push($json_result['address'],$address);
			array_push($json_result['grstatus'],$row["grstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>