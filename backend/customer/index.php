<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../../');
        exit;
    }    
    include_once('../conn.php');
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ข้อมูลลูกค้า (Customer)</title>

    <?php 
    include_once('css.php'); 
    include_once('../../config.php');
    include_once('../import_css.php');
    include_once ROOT_CSS .'/func.php';
    ?>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo PATH; ?>/backend/img/LOGO LOGIN.png" alt="AdminLTELogo"
                width="100">
        </div>

        <?php include_once ROOT_CSS . '/menu_head.php'; ?>

        <?php include_once ROOT_CSS . '/menu_left.php'; ?>



        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <span class="m-0"> <i class="nav-icon fas fa-address-book"></i> ข้อมูลลูกค้า
                                (Customer)</span>
                        </div>
                        <div class="col-sm-6">
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <form data-ajax="false" target="_blank" method="post">
                                <div data-role="fieldcontain">
                                    <div class="btn" id="btnAddCustomer" aria-label="Basic example">
                                        <button id="btnCUSTOMER"type="button" class="btn" data-toggle="modal" data-target="#modal_add"
                                            style="color:white;background : #2874A6; font-size:20px;text-shadow:2px 2px 4px #000000;"><i
                                                class="	fas fa-user-plus" aria-hidden="true"></i>เพิ่มลูกค้า</button>
                                        <button type="button" id="btnRefresh" class="btn"
                                            style="color:white;background : #148F77; font-size:20px;text-shadow:2px 2px 4px #000000;"><i
                                                class="fas fa-sync-alt" aria-hidden="true"></i> Refresh</button>
                                    </div>
                                    <div class="btn-group" id="btnBack" style="display:none;" role="group"
                                        aria-label="Basic example">
                                        <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            ย้อนกลับ</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <table name="tableCustomer" id="tableCustomer"
                                class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                                <thead class="sticky-top table-defalut bg-dark">
                                    <tr>
                                        <th>รหัสลูกค้า</th>
                                        <th>ชื่อลูกค้า</th>
                                        <th style="text-align:center">จังหวัด</th>
                                        <th style="text-align:center">ที่อยู่</th>
                                        <th style="text-align:center">สถานะใช้งาน</th>
                                    </tr>
                                </thead>
                                <tbody class="text-nowrap">

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <?php include_once('modal/modal_add.php');?>
        <?php include_once('modal/modal_edit.php');?>

    </div>

    <?php
    include_once ROOT_CSS . '/import_js.php';
    

    include_once('js.php'); 
    ?>

</body>

</html>
<?php

function getProvince(){
    echo '<option value="" selected>-- เลือกจังหวัด --</option>
    <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
    <option value="กระบี่">กระบี่ </option>
    <option value="กาญจนบุรี">กาญจนบุรี </option>
    <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
    <option value="กำแพงเพชร">กำแพงเพชร </option>
    <option value="ขอนแก่น">ขอนแก่น</option>
    <option value="จันทบุรี">จันทบุรี</option>
    <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
    <option value="ชัยนาท">ชัยนาท </option>
    <option value="ชัยภูมิ">ชัยภูมิ </option>
    <option value="ชุมพร">ชุมพร </option>
    <option value="ชลบุรี">ชลบุรี </option>
    <option value="เชียงใหม่">เชียงใหม่ </option>
    <option value="เชียงราย">เชียงราย </option>
    <option value="ตรัง">ตรัง </option>
    <option value="ตราด">ตราด </option>
    <option value="ตาก">ตาก </option>
    <option value="นครนายก">นครนายก </option>
    <option value="นครปฐม">นครปฐม </option>
    <option value="นครพนม">นครพนม </option>
    <option value="นครราชสีมา">นครราชสีมา </option>
    <option value="นครศรีธรรมราช">นครศรีธรรมราช </option>
    <option value="นครสวรรค์">นครสวรรค์ </option>
    <option value="นราธิวาส">นราธิวาส </option>
    <option value="น่าน">น่าน </option>
    <option value="นนทบุรี">นนทบุรี </option>
    <option value="บึงกาฬ">บึงกาฬ</option>
    <option value="บุรีรัมย์">บุรีรัมย์</option>
    <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>
    <option value="ปทุมธานี">ปทุมธานี </option>
    <option value="ปราจีนบุรี">ปราจีนบุรี </option>
    <option value="ปัตตานี">ปัตตานี </option>
    <option value="พะเยา">พะเยา </option>
    <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>
    <option value="พังงา">พังงา </option>
    <option value="พิจิตร">พิจิตร </option>
    <option value="พิษณุโลก">พิษณุโลก </option>
    <option value="เพชรบุรี">เพชรบุรี </option>
    <option value="เพชรบูรณ์">เพชรบูรณ์ </option>
    <option value="แพร่">แพร่ </option>
    <option value="พัทลุง">พัทลุง </option>
    <option value="ภูเก็ต">ภูเก็ต </option>
    <option value="มหาสารคาม">มหาสารคาม </option>
    <option value="มุกดาหาร">มุกดาหาร </option>
    <option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>
    <option value="ยโสธร">ยโสธร </option>
    <option value="ยะลา">ยะลา </option>
    <option value="ร้อยเอ็ด">ร้อยเอ็ด </option>
    <option value="ระนอง">ระนอง </option>
    <option value="ระยอง">ระยอง </option>
    <option value="ราชบุรี">ราชบุรี</option>
    <option value="ลพบุรี">ลพบุรี </option>
    <option value="ลำปาง">ลำปาง </option>
    <option value="ลำพูน">ลำพูน </option>
    <option value="เลย">เลย </option>
    <option value="ศรีสะเกษ">ศรีสะเกษ</option>
    <option value="สกลนคร">สกลนคร</option>
    <option value="สงขลา">สงขลา </option>
    <option value="สมุทรสาคร">สมุทรสาคร </option>
    <option value="สมุทรปราการ">สมุทรปราการ </option>
    <option value="สมุทรสงคราม">สมุทรสงคราม </option>
    <option value="สระแก้ว">สระแก้ว </option>
    <option value="สระบุรี">สระบุรี </option>
    <option value="สิงห์บุรี">สิงห์บุรี </option>
    <option value="สุโขทัย">สุโขทัย </option>
    <option value="สุพรรณบุรี">สุพรรณบุรี </option>
    <option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>
    <option value="สุรินทร์">สุรินทร์ </option>
    <option value="สตูล">สตูล </option>
    <option value="หนองคาย">หนองคาย </option>
    <option value="หนองบัวลำภู">หนองบัวลำภู </option>
    <option value="อำนาจเจริญ">อำนาจเจริญ </option>
    <option value="อุดรธานี">อุดรธานี </option>
    <option value="อุตรดิตถ์">อุตรดิตถ์ </option>
    <option value="อุทัยธานี">อุทัยธานี </option>
    <option value="อุบลราชธานี">อุบลราชธานี</option>
    <option value="อ่างทอง">อ่างทอง </option>';
}
?>