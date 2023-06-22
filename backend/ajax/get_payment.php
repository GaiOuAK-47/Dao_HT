<?php
header('Content-Type: application/json');
date_default_timezone_set('Asia/Bangkok');
include('../conn.php');

session_start();
if (!isset($_SESSION['loggedin'])) {
    http_response_code(400);
    echo json_encode(array('status' => '0', 'message' => 'Session not found.'));
    die;
}
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    try {
        $pay_date = $_GET["q"];
        $sql = "
        select 
        i.id,
        i.payround,
        a.installment,
        i.socode,
        i.mustpay,
        i.paid,
        DATE_FORMAT(i.paydate, '%Y-%m-%d') paydate,
        a.cuscode,
        c.cusname,
        GROUP_CONCAT(d.stcode ORDER BY d.stcode DESC separator '<br>') AS stcode,
        GROUP_CONCAT(e.stname1 ORDER BY d.stcode DESC separator '<br>') AS stname1, 
        i.status
        from installment i
        inner join somaster a on i.socode = a.socode
        left outer join customer as c on a.cuscode = c.cuscode
        left outer join sodetail as d on a.socode = d.socode
        left outer join product as e on d.stcode = e.stcode
        where i.paydate = '$pay_date' -- or (i.paydate <= current_date() and i.status = 'ยังไม่ได้จ่าย')
        group by i.id, i.payround, a.installment, i.socode, i.mustpay, i.paid,DATE_FORMAT(i.paydate, '%Y-%m-%d'),a.cuscode,i.status";
        $query = mysqli_query($conn,$sql);
 
        // Fetch all
        $res = $query->fetch_all(MYSQLI_ASSOC); //MYSQLI_ASSOC
    
        // Free result set
        $query->free_result();
        http_response_code(200);
        echo json_encode($res);
    } catch (mysqli_sql_exception $e) { 
        http_response_code(400);
        echo json_encode(array('status' => '0', 'message' => $e->getMessage()));
        //throw $exception;
    } catch (Exception $e) { 
        http_response_code(400);
        echo json_encode(array('status' => '0', 'message' => $e->getMessage()));
    } finally{
        mysqli_close($conn);
    }    
} else {
    http_response_code(400);
    echo json_encode(array('status' => '0', 'message' => 'request method fail.'));
}

exit;
 