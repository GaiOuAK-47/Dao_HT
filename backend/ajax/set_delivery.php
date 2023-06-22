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
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    mysqli_autocommit($conn, false);
    $conn->begin_transaction(); 
    try {
        extract($_POST, EXTR_OVERWRITE, "_");
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $action_by = $_SESSION['id'];
        $sql = "UPDATE somaster SET delstatus = 'ส่งสินค้าแล้ว', edate = ?, etime = ?, euser = ? WHERE socode = ?"; // sql
        $data = [$date, $time, $action_by, $socode]; // put your data into array
        $stmt = mysqli_prepare($conn,$sql); // prepare
        mysqli_stmt_bind_param($stmt,'ssss', ...$data); // bind array at once
        if (!mysqli_stmt_execute($stmt)){
            throw new mysqli_sql_exception("Update data error."); 
            die;
        } 

        //$query = mysqli_query($conn, "select * from somaster where socode = '$socode' and delstatus = 'ส่งสินค้าแล้ว' "); 
        if(!!$stmt->errno){
            throw new mysqli_sql_exception("Update data fialed."); 
            die;
        }
 

        $conn->commit();
        //mysqli_commit($conn);
        http_response_code(200);
        echo json_encode(array('status' => '1', 'message' => "ส่งสินค้า รหัส $socode สำเร็จ", 'code' => $socode));
    } catch (mysqli_sql_exception $e) {
        $conn->rollback();
        http_response_code(400);
        echo json_encode(array('status' => '0', 'message' => $e->getMessage()));
        //throw $exception;
    } catch (Exception $e) { 
        $conn->rollback();
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
 