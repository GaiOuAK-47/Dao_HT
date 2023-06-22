<?php
	header('Content-Type: application/json');
    include_once('../../conn.php');
    date_default_timezone_set('Asia/Bangkok');
    
    $StrSQL = "INSERT INTO customer (`cuscode`, `cusname`, `idno`, `road`, `subdistrict`, `district` ";
    $StrSQL .= ",`province`, `zipcode`, `tel`, `fax`, `taxnumber`, `email`, `status`,`s_date`,`s_time`, s_user) ";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$_POST["add_cuscode"]."','".$_POST["add_cusname"]."','".$_POST["add_idno"]."','".$_POST["add_road"]."' ";
    $StrSQL .= ",'".$_POST["add_subdistrict"]."','".$_POST["add_district"]."','".$_POST["add_province"]."','".$_POST["add_zipcode"]."' ";
    $StrSQL .= ",'".$_POST["add_tel"]."','".$_POST["add_fax"]."','".$_POST["add_taxnumber"]."','".$_POST["add_email"]."','Y','".date("Y-m-d")."','".date("H:i:s")."','".$_POST["id"]."' ";
    $StrSQL .= ")";
    $query = mysqli_query($conn,$StrSQL);

    if($query) 
    {
            $strSQL = "UPDATE cuscode SET ";
            $strSQL .= "number=number+1 ";        
            $strSQL .= " order by id desc LIMIT 1 ";
            
            $query = mysqli_query($conn,$strSQL);
    }
    // if($query) {
    //     $strSQL = "UPDATE cuscode SET ";
    //     $strSQL .= "number= number+1 ";
    //     $strSQL .= "WHERE pretext= '".substr($_POST["add_supcode"],0,1)."' ";
    //     $query = mysqli_query($conn,$strSQL);
    // }

    // echo $StrSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มลูกค้า '.$_POST["add_cusname"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>