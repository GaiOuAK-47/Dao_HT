<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	$json_result=array(

        "supcode" => array()
		
        );

	$sql = "SELECT pretext,number FROM supcode order by id desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

	$row = $query->fetch_assoc();

		
		if($row["number"]=='999')
		{

			$nextChar = chr(ord($row["pretext"]) + 1);
			// echo $nextChar;	


			$StrSQL = "INSERT INTO supcode (`pretext`) ";
    		$StrSQL .= "VALUES (";
    		$StrSQL .= "'".$nextChar."' ";
    		$StrSQL .= ")";
    		$query2 = mysqli_query($conn,$StrSQL);		

		}
		$sql = "SELECT pretext,number FROM supcode order by id desc LIMIT 1";
		$query = mysqli_query($conn,$sql);
		
        while($row = $query->fetch_assoc()) {
			$code=sprintf("%03s", ($row["number"]+1));

            array_push($json_result['supcode'],$row["pretext"].$code);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>