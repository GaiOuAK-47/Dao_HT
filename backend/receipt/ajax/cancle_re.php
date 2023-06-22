<?php
	header('Content-Type: application/json');
    include('../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    // $_POST['idcode']='N6605009';
    $StrSQL = "UPDATE receipt SET status = 'ยกเลิก' WHERE recode = '".$_POST['idcode']."' ";
    $query = mysqli_query($conn,$StrSQL);  

    if($query)
    {

        $sql = "SELECT * from(SELECT a.socode,a.firstpaydate,a.downpay,a.installment,a.netinstallment,a.round,ifnull(SUM(b.price),0) as totalpay,(a.downpay+(a.installment*a.netinstallment)) as totalnetpay ";
        $sql .= "FROM somaster as a left outer join receipt as b on (a.socode=b.socode) ";
        $sql .= "where a.socode = '".$_POST['socode']."'  and b.status!='ยกเลิก') a  ";

        // echo $sql;
        $query = mysqli_query($conn,$sql);
        $row = $query->fetch_assoc();

        $datelog=$row["firstpaydate"];
        $payprice=$row["downpay"];
        $status=0;
        
        $StrSQL3 = "DELETE FROM installment  ";
        $StrSQL3 .= "WHERE socode='".$_POST["socode"]."' ";
        $query3 = mysqli_query($conn,$StrSQL3);

        if($query3)
        {
            for($num=0;$num<$row["installment"];$num++)
            {		
                $paid=0;
                $payprice = $payprice+$row["netinstallment"];
                $status = $payprice<=(float)$row["totalpay"];

                if($status)
                {
                    $status='จ่ายแล้ว';
                    $paid=$row["netinstallment"];
                }
                else if(abs((float)$row["totalpay"]-$payprice)<$row["netinstallment"])
                {
                    $status='ยังจ่ายไม่ครบ';
                    $paid=$row["netinstallment"]-abs((float)$row["totalpay"]-$payprice);
                }
                else
                {
                    $status='ยังไม่ได้จ่าย';
                }

                $StrSQL2 = "INSERT INTO installment (socode,paydate,mustpay,paid,status,payround";
                $StrSQL2 .= ")";
                $StrSQL2 .= "VALUES (";
                $StrSQL2 .= "'".$_POST["socode"]."','".$datelog."','".$row["netinstallment"]."','".$paid."', '".$status."', '".($num+1)."' ";
                $StrSQL2 .= ") ";
                $query2 = mysqli_query($conn,$StrSQL2);

                $datelog = date('Y-m-d', strtotime($datelog . ' +'.$row["round"].' day'));
            }
        }
    }

    if($query2) {
        echo json_encode(array('status' => '1','message'=> "ยกเลิกการใบขายสินค้าสำเร็จ"));
    }
    else
    {
        echo json_encode(array('status' => '0','message'=> $StrSQL));
    }
    exit;
?>