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
        $deldate = $_GET["q"];
        $sql = "
        select 
        s.socode,
        DATE_FORMAT(s.deldate, '%Y-%m-%d') deldate,
        s.deldate,
        s.cuscode,
        c.cusname,
        d.stcode,
        p.stname1,
        s.delstatus status,
        d.*,
        s.sotype
        from somaster s
        left outer join sodetail d on s.socode = d.socode
        left outer join product p on d.stcode = p.stcode
        left outer join customer c on s.cuscode = c.cuscode 
        where s.deldate = '$deldate' or (d.supstatus != 'ยกเลิก' and s.delstatus != 'ส่งสินค้าแล้ว' and s.deldate <= '$deldate')";
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
 