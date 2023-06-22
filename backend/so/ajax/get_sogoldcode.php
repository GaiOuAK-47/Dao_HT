<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	$json_result=array(

        "socode" => array()
		
        );

	$sql = "SELECT pretext,number FROM sogoldcode order by id desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

		
        while($row = $query->fetch_assoc()) {
			if($row["number"]<='999')			
			$code=sprintf("%03s", ($row["number"]+1));
			else
			$code=$row["number"]+1;

            array_push($json_result['socode'],$row["pretext"].$code);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>