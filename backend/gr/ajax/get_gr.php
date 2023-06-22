<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	$sql = "SELECT a.grcode,a.grdate,b.pocode,c.stcode,c.stname1,a.supcode,d.supname,b.grstatus FROM `grmaster` as a inner join grdetail as b on (a.grcode=b.grcode) left outer join product as c on (c.stcode=b.stcode) left outer join supplier as d on (a.supcode=d.supcode) order by a.grcode desc";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "grcode" => array(),
		"grdate" => array(),
		"pocode" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"supname" => array(),
		"grstatus" => array()
		
        );
        while($row = $query->fetch_assoc()) {
            array_push($json_result['grcode'],$row["grcode"]);
            array_push($json_result['grdate'],$row["grdate"]);
			array_push($json_result['pocode'],$row["pocode"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['supname'],$row["supcode"].' '.$row["supname"]);
			array_push($json_result['grstatus'],$row["grstatus"]);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>