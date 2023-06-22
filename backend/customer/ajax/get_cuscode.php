<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	$json_result=array(
        "cuscode" => array()
		
		);

		$sql = "SELECT number FROM cuscode  ";
		$query = mysqli_query($conn,$sql);
		
        while($row = $query->fetch_assoc()) {
			$code=sprintf("%05s", ($row["number"]+1));
            array_push($json_result['cuscode'],$code);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>