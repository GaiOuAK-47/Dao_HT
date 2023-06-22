<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	$json_result=array(

        "socode" => array()
		
        );

	$sql = "SELECT year,month,pretext,number FROM socode order by id desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

	$row = $query->fetch_assoc();

		
		if((int)$row["month"]!=date("m"))
		{

			// echo $nextChar;	

			// (date("Y")+543)

			$StrSQL = "INSERT INTO socode (`year`,`month`,`pretext`,`number`) ";
    		$StrSQL .= "VALUES (";
    		$StrSQL .= "'".(date("Y")+543)."',".date("m").",'N',0 ";
    		$StrSQL .= ")";
    		$query2 = mysqli_query($conn,$StrSQL);		

		}
		$sql = "SELECT year,month,pretext,number FROM socode order by id desc LIMIT 1";
		$query = mysqli_query($conn,$sql);
		
        while($row = $query->fetch_assoc()) {
			$code=sprintf("%03s", ($row["number"]+1));
			$month=sprintf("%02s", ($row["month"]));

            array_push($json_result['socode'],$row["pretext"].substr(($row["year"]),2,2).$month.$code);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>