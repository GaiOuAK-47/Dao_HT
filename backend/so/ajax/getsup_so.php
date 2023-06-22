<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	// $_POST['idcode']='SO23/0004';
	$sql = "SELECT a.socode,a.sodate,a.deldate,a.downpaydate,a.firstpaydate,a.payment,a.downpay,a.installment,a.netinstallment,a.round,a.remark,c.stcode,c.stname1,a.cuscode,d.cusname,d.idno,d.road,d.subdistrict,d.district,d.province,d.zipcode,a.delstatus,b.supstatus ";
	$sql .= "FROM `somaster` as a inner join sodetail as b on (a.socode=b.socode) inner join product as c on (c.stcode=b.stcode) inner join customer as d on (a.cuscode=d.cuscode) ";
	$sql .= "where a.socode = '".$_POST['idcode']."'  LIMIT 1";
	
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "socode" => array(),
		"sodate" => array(),
		"deldate" => array(),
		"downpaydate" => array(),
		"firstpaydate" => array(),
		"payment" => array(),	
		"downpay" => array(),
		"installment" => array(),
		"netinstallment" => array(),	
		"round" => array(),
		"remark" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"cuscode" => array(),
		"cusname" => array(),
		"address" => array(),
		"delstatus" => array(),		
		"supstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			$address = ($row["idno"] == '' ? '': 'เลขที่ '.$row["idno"].' ').($row["road"] == '' ? '': 'ถนน'.$row["road"].' ');
			$address .= ($row["subdistrict"] == '' ? '': 'ต.'.$row["subdistrict"].'  ').($row["district"] == '' ? '': 'อ.'.$row["district"].'  ');
			$address .= ($row["province"] == '' ? '': 'จ.'.$row["province"].' ').($row["zipcode"] == '' ? '': ' '.$row["zipcode"]);

            array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['sodate'],$row["sodate"]);
			array_push($json_result['deldate'],$row["deldate"]);
			array_push($json_result['downpaydate'],$row["downpaydate"]);
			array_push($json_result['firstpaydate'],$row["firstpaydate"]);
			array_push($json_result['payment'],$row["payment"]);
			array_push($json_result['downpay'],$row["downpay"]);
			array_push($json_result['installment'],$row["installment"]);
			array_push($json_result['netinstallment'],$row["netinstallment"]);
			array_push($json_result['round'],$row["round"]);
			array_push($json_result['remark'],$row["remark"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['cuscode'],$row["cuscode"]);
			array_push($json_result['cusname'],$row["cusname"]);
			array_push($json_result['address'],$address);
			array_push($json_result['delstatus'],$row["delstatus"]);
			array_push($json_result['supstatus'],$row["supstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>