<?php
	header('Content-Type: application/json');
	include('../conn.php');

	$sql = "SELECT a.socode,a.sodate,a.sotype,c.stcode,c.stname1,a.cuscode,d.cusname,a.delstatus,b.supstatus FROM `somaster` as a inner join sodetail as b on (a.socode=b.socode) inner join product as c on (c.stcode=b.stcode) inner join customer as d on (a.cuscode=d.cuscode) ";
	$sql .= " where b.supstatus != 'ยกเลิก' group by a.socode order by a.socode desc";
	$query = mysqli_query($conn,$sql);

	$json_result=array(
        "socode" => array(),
		"sodate" => array(),
		"sotype" => array(),
		"cusname" => array(),
		"delstatus" => array(),		
		"supstatus" => array(),		
		"count" => array()
        );
		$count=0;
        while($row = $query->fetch_assoc()) {            
			
			// $count++;
			// array_push($json_result['count'],$count);
			$sql = "SELECT * from(SELECT a.socode,a.firstpaydate,a.downpay,a.installment,a.netinstallment,a.round,ifnull(SUM(b.price),0) as totalpay,(a.downpay+(a.installment*a.netinstallment)) as totalnetpay ";
			$sql .= "FROM somaster as a left outer join receipt as b on (a.socode=b.socode) ";
			$sql .= "where a.socode = '".$row["socode"]."'  and b.status!='ยกเลิก') a ";

			// echo $sql;
			$query2 = mysqli_query($conn,$sql);
			$row2 = $query2->fetch_assoc();

			$datelog=$row2["firstpaydate"];
			$payprice=$row2["downpay"];
			$status=0;
			

			for($num=0;$num<$row2["installment"];$num++)
			{		
				$paid=0;
				$payprice = $payprice+$row2["netinstallment"];
				$status = $payprice<=(float)$row2["totalpay"];

				if($status)
				{
					$status='จ่ายแล้ว';
					$paid=$row2["netinstallment"];
				}
				else if(abs((float)$row2["totalpay"]-$payprice)<$row2["netinstallment"])
				{
					$status='ยังจ่ายไม่ครบ';
					$paid=$row2["netinstallment"]-abs((float)$row2["totalpay"]-$payprice);
				}
				else
				{
					$status='ยังไม่ได้จ่าย';
				}

				$StrSQL2 = "INSERT INTO installment (socode,paydate,mustpay,paid,status,payround";
				$StrSQL2 .= ")";
				$StrSQL2 .= "VALUES (";
				$StrSQL2 .= "'".$row["socode"]."','".$datelog."','".$row2["netinstallment"]."','".$paid."', '".$status."', '".($num+1)."' ";
				$StrSQL2 .= ") ";
				$query3 = mysqli_query($conn,$StrSQL2);

				$datelog = date('Y-m-d', strtotime($datelog . ' +'.$row2["round"].' day'));
			}
			array_push($json_result['socode'],$row["socode"]);	
        }
		// if($query3)
        // echo json_encode($json_result);

		// echo $StrSQL;
	
		
		// mysqli_close($conn);
?>