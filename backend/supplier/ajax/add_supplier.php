<?php
	header('Content-Type: application/json');
    include_once('../../conn.php');
    date_default_timezone_set('Asia/Bangkok');
    
    $StrSQL = "INSERT INTO supplier (`supcode`, `supname`, `idno`, `road`, `subdistrict`, `district` ";
    $StrSQL .= ",`province`, `zipcode`, `tel`, `fax`, `taxnumber`, `email`, `status`) ";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$_POST["add_supcode"]."','".$_POST["add_supname"]."','".$_POST["add_idno"]."','".$_POST["add_road"]."' ";
    $StrSQL .= ",'".$_POST["add_subdistrict"]."','".$_POST["add_district"]."','".$_POST["add_province"]."','".$_POST["add_zipcode"]."' ";
    $StrSQL .= ",'".$_POST["add_tel"]."','".$_POST["add_fax"]."','".$_POST["add_taxnumber"]."','".$_POST["add_email"]."','Y' ";
    $StrSQL .= ")";
    $query = mysqli_query($conn,$StrSQL);

    if($query) {
        $strSQL = "UPDATE supcode SET ";
        $strSQL .= "number= number+1 ";
        $strSQL .= "WHERE pretext= '".substr($_POST["add_supcode"],0,1)."' ";
        $query = mysqli_query($conn,$strSQL);
    }

    // echo $StrSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มผู้ขาย '.$_POST["add_supname"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>