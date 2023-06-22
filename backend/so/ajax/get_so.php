<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	$sql = "SELECT a.socode,a.sodate,a.sotype,c.stcode,c.stname1,a.cuscode,d.cusname,a.delstatus,b.supstatus FROM `somaster` as a inner join sodetail as b on (a.socode=b.socode) inner join product as c on (c.stcode=b.stcode) inner join customer as d on (a.cuscode=d.cuscode) order by a.socode desc";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "socode" => array(),
		"sodate" => array(),
		"sotype" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"cusname" => array(),
		"delstatus" => array(),		
		"supstatus" => array()
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['socode'],$row["socode"]);
            array_push($json_result['sodate'],$row["sodate"]);
			array_push($json_result['sotype'],$row["sotype"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['cusname'],$row["cuscode"].' '.$row["cusname"]);
			array_push($json_result['delstatus'],$row["delstatus"]);
			array_push($json_result['supstatus'],$row["supstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>