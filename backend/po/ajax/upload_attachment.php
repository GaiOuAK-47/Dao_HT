<?php
header('Content-Type: application/json');
date_default_timezone_set('Asia/Bangkok');
include('../../conn.php');

session_start();
if (!isset($_SESSION['loggedin'])) {
    http_response_code(400);
    echo json_encode(array('status' => '0', 'message' => 'Session not found.'));
    die;
}
$path = dirname(__FILE__, 3);
$pathUpload = "//uploads//";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "add") { 
 
    extract($_POST, EXTR_OVERWRITE, "_");
    $FILE_REQUIRED = array("application/pdf", "image/jpg", "image/png", "image/jpeg");    
    $pofile = str_replace("/", "", $pocode);
    $pathDocument = $pofile . "//";
    $filepath = $path . $pathUpload . $pathDocument;

    if (!file_exists($path . $pathUpload)) {
        mkdir($path . $pathUpload, 0777);
    }
    if (!file_exists($filepath)) {
        mkdir($filepath, 0777);
    }
    $document = array();
    if (!empty($_FILES["file"])) {
        $fileData = json_decode($_POST["fileData"], true);
        $file = $_FILES["file"];
        for ($i = 0; $i < count($file["name"]); $i++) {
            $file_temp = $file["tmp_name"][$i];
            $f = $file["name"][$i];
            $t = $file["type"][$i];
            if( !in_array($t, $FILE_REQUIRED) ){
                throw new Exception("File attach incorrect.");
                die;
            }            
            $ext = pathinfo($f, PATHINFO_EXTENSION);
            $file_name = sprintf("$pofile-%02s.$ext", $i + 1);
            if (file_exists($filepath . $file_name)) continue;

            if (move_uploaded_file($file_temp, $filepath . $file_name)) {
                if (file_exists($filepath . $file_name) != 1)  continue;
                $att_name = $attname[$i];
                array_push($document, array("url" => $pathUpload . $pathDocument . $file_name, "attname" => $att_name, "attno" => $i + 1));
            }
        }
    }
    $conn->begin_transaction();
    try {
        foreach ($document as $i => $v) { 
            $url = $v["url"];
            $attname = $v["attname"];
            $attno = $i + 1;
            $sql = "INSERT INTO poattachment(pocode,attno,attname,url) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql); // prepare
            $stmt->bind_param('siss', $pocode, $attno, $attname, $url); // bind array at once
            if (!$stmt->execute()) throw new Exception("Insert data error.");
        }
        $query = mysqli_query($conn,"select 1 from poattachment where pocode = '$pocode' limit 1");
        if(!!!$query)  throw new mysqli_sql_exception("insert document fail.");

        $conn->commit();  
        http_response_code(200);
        echo json_encode(array('status' => '1', 'message' => "อัพโหลดไฟล์สำหรับ PO $pocode สำเร็จ"));
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
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "upd") { 
      
    extract($_POST, EXTR_OVERWRITE, "_");
    $FILE_REQUIRED = array("application/pdf", "image/jpg", "image/png", "image/jpeg");    
    $pofile = str_replace("/", "", $pocode);
    $pathDocument = $pofile . "//";
    $filepath = $path . $pathUpload . $pathDocument;

    if (!file_exists($path . $pathUpload)) {
        mkdir($path . $pathUpload, 0777);
    }
    if (!file_exists($filepath)) {
        mkdir($filepath, 0777);
    }
    $conn->begin_transaction();
    try {
        $file_deleted = json_decode($fileDelete, true);
        if (!empty($file_deleted)) {
            foreach ($file_deleted as $i => $v) {
                $c = $v["code"]; 
                $p = $v["url"];
                if (file_exists($path .  $p)) {
                    unlink($path . $p);
                }
                
                $sql  = "DELETE FROM poattachment WHERE code = ?";
                $stmt = $conn->prepare($sql); // prepare
                $stmt->bind_param('s', $c); // bind array at once
                if (!$stmt->execute()) throw new Exception("Update data error.");
            }
        }

        $file_data = json_decode($fileData, true);
        if (!empty($file_data)) {
            foreach ($file_data as $i => $v) {
                $file_code = $v["code"];
                $file_attname = $v["attname"];
                $file_name = $v["file_name"];
                
                $file_oldName = $v["fname"];
                $file_url = $v["url"];                 
                if(!isset($file_name) && !empty($_FILES["file$file_code"])){
                    $file_attach = $_FILES["file$file_code"]; 
                    $file_temp = $file_attach["tmp_name"];
                    $file_name = $file_attach["name"];
                    $file_type = $file_attach["type"];
                    $ext = pathinfo($file_name, PATHINFO_EXTENSION);

                    if( !in_array($file_type, $FILE_REQUIRED) ){
                        throw new Exception("File attach incorrect.");
                        die;
                    } 

                    if (file_exists($path . $file_url)) unlink($path . $file_url);
                    
                    $file_url = $pathUpload .  $pofile . "//" . $file_oldName . '.'. $ext;
                    if (!move_uploaded_file($file_temp, $path . $file_url)) {
                        throw new Exception("File exists.");
                        exit;
                    }                    
                }
                $sql = "UPDATE poattachment SET attname = ?, url = ?  WHERE code = ?"; // sql 
                $stmt = $conn->prepare($sql); // prepare
                $stmt->bind_param('sss', $file_attname, $file_url, $file_code); // bind array at once
                if (!$stmt->execute()) throw new Exception("Insert data error.");
            }
        }

        $document = array();
        if (!empty($_FILES["file"])) {
            $fileData = json_decode($_POST["fileData"], true);
            $file = $_FILES["file"];
            $sql = "select max(attno) m from poattachment where pocode = '$pocode' ";
            $query = mysqli_query($conn, $sql);
            $res = $query->fetch_assoc();
            $max_attno = $res ? (int)($res["m"]) + 1 : 1;

            for ($i = 0; $i < count($file["name"]); $i++) {
                $file_temp = $file["tmp_name"][$i];
                $f = $file["name"][$i];
                $t = $file["type"][$i];
                if( !in_array($t, $FILE_REQUIRED) ){
                    throw new Exception("File attach incorrect.");
                    die;
                }            
                $ext = pathinfo($f, PATHINFO_EXTENSION);
                $file_name = sprintf("$pofile-%02s.$ext", $i + $max_attno);

                if (!move_uploaded_file($file_temp, $filepath . $file_name)) {
                    throw new Exception("File exists.");
                    exit;
                }

                if (!file_exists($filepath . $file_name)) continue;
                $att_name = $attname[$i];
                array_push($document, array("url" => $pathUpload . $pathDocument . $file_name, "attname" => $att_name, "attno" => $i + $max_attno));
    
            }
        } 

        foreach ($document as $i => $v) { 
            $url = $v["url"];
            $attname = $v["attname"];
            $attno = $v["attno"];
            $sql = "INSERT INTO poattachment(pocode,attno,attname,url) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql); // prepare
            $stmt->bind_param('siss', $pocode, $attno, $attname, $url); // bind array at once
            if (!$stmt->execute()) throw new Exception("Insert data error.");
        }
        $query = mysqli_query($conn,"select 1 from poattachment where pocode = '$pocode' limit 1");
        if(!!!$query)  throw new mysqli_sql_exception("insert document fail.");

        $conn->commit();  
        http_response_code(200);
        echo json_encode(array('status' => '1', 'message' => "อัพเดทไฟล์สำหรับ PO $pocode สำเร็จ"));
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
} elseif ($_SERVER["REQUEST_METHOD"] == "GET"){
    try {
        $pocode = $_GET["c"];
        $sql = "SELECT * from poattachment a where pocode = '$pocode';"; 
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