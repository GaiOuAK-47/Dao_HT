<?php
	header('Content-Type: application/json');
	include('../../conn.php');

	$sql = "SELECT year FROM options order by year desc LIMIT 1";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "pocode" => array()
		
        );
		$row = $query->fetch_assoc();
		
		if($row["year"]!=date("Y"))
		{
			$StrSQL = "INSERT INTO options (`year`) ";
    		$StrSQL .= "VALUES (";
    		$StrSQL .= "'".date("Y")."' ";
    		$StrSQL .= ")";
    		$query2 = mysqli_query($conn,$StrSQL);		

		}
		$sql = "SELECT * FROM options order by year desc LIMIT 1";
		$query = mysqli_query($conn,$sql);
		
        while($row = $query->fetch_assoc()) {
			$code=sprintf("%04s", ($row["maxpocode"]+1));
            $yearsocode=substr( $row["year"], -2);
            array_push($json_result['pocode'],'PO'.$yearsocode.'/'.$code);
			
        }
        echo json_encode($json_result);

		// echo $StrSQL;
	
		
		mysqli_close($conn);
?>