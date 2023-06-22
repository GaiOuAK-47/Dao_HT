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
 
        $year = date("Y",strtotime($pay_date));
        $sql = "select * from options where year = ? ";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $year);

        if (!mysqli_stmt_execute($stmt)) throw new mysqli_sql_exception("get data filed.");
        $query = mysqli_stmt_get_result($stmt);
        $option = $query->fetch_assoc();
        $query->free_result();

        $code=sprintf("%04s", ($option["maxrecode"]+1));
        $yearrecode=substr($option["year"], -2);            
        $recode= 'RE'.$yearrecode.'/'.$code;      

        $sql = "
        select 
        s.socode,
        s.sotype,
        s.payment,
        (s.downpay + s.installment * s.netinstallment) price_total,
        s.downpay, 
        s.installment,
        s.netinstallment, 
        (select sum(r.price) from receipt r where r.socode = s.socode) paid_total,
        (select max(r.payround) from receipt r where r.socode = s.socode) paid_round
        from somaster s
        inner join sodetail d on s.socode = d.socode
        inner join product p on d.stcode = p.stcode 
        where status != 'ยกเลิก' and s.socode = ?;";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $socode);

        if (!mysqli_stmt_execute($stmt)) throw new mysqli_sql_exception("get data filed.");
        $query = mysqli_stmt_get_result($stmt);
        $sodetail = $query->fetch_assoc();
        $query->free_result();

        $date = date("Y-m-d");
        $action_date = date("Y-m-d H:i:s");
        $action_by = $_SESSION['id'];
        $payround = $sodetail ? (int)($sodetail["paid_round"] ?? 0)+1 : 1; 
        $paid_total = $sodetail ? (int)($sodetail["paid_total"] ?? 0) : 0;
        $price_total = $sodetail ? (int)($sodetail["price_total"] ?? 0) : 0;
        $balance = $price_total - ($paid_total + (float)$mustpay);
 
        $sql = "INSERT INTO receipt (recode,socode,redate,retype,status,price,balance,stylepayment,remark,payround,createby) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $data = [$recode, $socode, $pay_date, $retype, 'ชำระแล้ว', (float)$mustpay, $balance, 'แบ่งชำระ', 'ชำระจากหน้า dashboard', $payround, $action_by];
        $stmt = mysqli_prepare($conn, $sql); // prepare
        mysqli_stmt_bind_param($stmt,'sssssdsssss', ...$data); // bind array at once
        if (!mysqli_stmt_execute($stmt)){
            throw new mysqli_sql_exception("Insert data error."); 
            die;
        }

        $sql = "UPDATE installment SET status = 'จ่ายแล้ว', paid = ? WHERE id = ?"; // sql
        $data = [$mustpay, $id]; // put your data into array
        $stmt = mysqli_prepare($conn,$sql); // prepare
        mysqli_stmt_bind_param($stmt,'ii', ...$data); // bind array at once
        if (!mysqli_stmt_execute($stmt)){
            throw new mysqli_sql_exception("Update data error."); 
            die;
        }

        $sql = "UPDATE sodetail SET supstatus= 'ชำระเงินครบแล้ว' WHERE socode = ? and not exists( select 1 from installment where socode = ? and status = 'ยังไม่ได้จ่าย')"; 
        $data = [$socode, $socode]; // put your data into array
        $stmt = mysqli_prepare($conn,$sql); // prepare
        mysqli_stmt_bind_param($stmt,'ss', ...$data); // bind array at once
        if (!mysqli_stmt_execute($stmt)){
            throw new mysqli_sql_exception("Update data error."); 
            die;
        }


        $query = mysqli_query($conn, "select * from receipt where recode = '$recode'"); 
        if(!!$stmt->errno){
            throw new mysqli_sql_exception("Insert data fialed."); 
            die;
        }
        $stmt = mysqli_prepare($conn, "UPDATE `options` SET maxrecode = maxrecode+1 WHERE year = '$year'")->execute();
        //$conn->query("UPDATE `option` SET recode = $rncode");  

        $conn->commit();
        //mysqli_commit($conn);
        http_response_code(200);
        echo json_encode(array('status' => '1', 'message' => "ชำระ รหัส $recode สำเร็จ", 'code' => $recode));
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
 