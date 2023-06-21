<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../');
    exit;
}
include_once('conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OC Money Group</title>

    <?php
    include_once('../config.php');
    include_once('import_css.php');
    include_once('css.php');
    include_once ROOT_CSS . '/func.php';
    ?>
</head>

<body class="sidebar-mini sidebar-collapse layout-fixed" >
    <div class="wrapper" width="100%">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo PATH; ?>/backend/img/LOGO LOGIN.png" alt="AdminLTELogo" width="100">
        </div>

        <?php include_once ROOT_CSS . '/menu_head.php'; ?>
        <?php include_once ROOT_CSS . '/menu_left.php'; ?>

        <div class="content-wrapper">
            <div class="container-fluid px-4 pt-2 pb-0">
                <ul class="nav nav-tabs" id="dashBoardTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="payment-data-tab" data-toggle="tab" data-target="#payment-data" type="button" role="tab" aria-controls="payment-data" aria-selected="true">
                            <i class="fas fa-comments-dollar"></i>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="delivery-data-tab" data-toggle="tab" data-target="#delivery-data" type="button" role="tab" aria-controls="delivery-data" aria-selected="false">
                            <i class="fas fa-shipping-fast"></i>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-chart-pie"></i></button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="col-12 overlay--loading" style="display: none;">
                        <div class="load-box position-absolute"style="left: 0;  right: 0; text-align: center;">
                            <img class="mt-5" src="img/loading.svg" alt="" > 
                        </div>
                    </div>
                    <div class="tab-pane fade show active" id="payment-data" role="tabpanel" aria-labelledby="payment-data-tab">
                        <section class="content">
                            <div class="section-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 10px;">
                                <h4 class="text-left m-0 pay-title" style="font-size: clamp(1.1rem, 1.6vw, 1.5rem);">รายชื่อส่งงวด ประจำวันที่ <?= date("Y-m-d"); ?></h4>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest" style="width:200px;">
                                    <input type="text" name="pay_date" class="form-control datetimepicker-input" data-target="#reservationdate" data-toggle="datetimepicker" />
                                    <div class="input-group-append">
                                        <a href="javascript:void(0)" class="input-group-text" onclick="onGetDataPayment()">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="section-body">  <!-- style="max-height: 78vh; scrollbar-gutter: stable; overflow: auto;" -->
                                <div class="containers px-md-5 card-payment"></div>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="delivery-data" role="tabpanel" aria-labelledby="delivery-data-tab">
                        <section class="content">
                            <div class="section-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 10px;">
                                <h4 class="text-left m-0 pay-title" style="font-size: clamp(1.1rem, 1.6vw, 1.5rem);">รายชื่อส่งของวันนี้ ประจำวันที่ <?= date("Y-m-d"); ?></h4>
                                <!-- <div class="input-group date" id="deliverydate" data-target-input="nearest" style="width:200px;">
                                    <input type="text" name="deldate" class="form-control datetimepicker-input" data-target="#deliverydate" data-toggle="datetimepicker" />
                                    <div class="input-group-append">
                                        <a href="javascript:void(0)" class="input-group-text" onclick="onGetDataDelivery()">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </div>
                                </div> -->
                            </div> 
                            <hr /> 
                            <div class="section-body">  <!-- style="max-height: 78vh; scrollbar-gutter: stable; overflow: auto;" -->
                                <div class="containers px-md-5 card-delivery"></div>
                            </div>
                        </section>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><br>
                        <section class="content">
                        <font color="red">กำลังปรับปรุง</font>
                        <div class="section-header d-flex flex-wrap align-items-center justify-content-between" style="gap: 10px;">
                                <h4 class="text-left m-0 pay-title" style="font-size: clamp(1.1rem, 1.6vw, 1.5rem);">ยอดรวมทั้งหมด ประจำวันที่ <?= date("Y-m-d"); ?></h4>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest" style="width:200px;">
                                    <input type="text" name="pay_date" class="form-control datetimepicker-input" data-target="#reservationdate" data-toggle="datetimepicker" />
                                    <div class="input-group-append">
                                        <a href="javascript:void(0)" class="input-group-text" onclick="onGetDataPayment()">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-lg-4 col-4">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <span>1,720,000.46</span>
                                            <p class="b">รายรับทั้งหมด</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-coins"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-4 col-4">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <span>500,000.01</span>
                                            <p class="b">รายจ่ายทั้งหมด</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-minus"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-4 col-4">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <span>1,220,000.45</span>
                                            <p class="b">สรุปยอด</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-plus"></i>
                                        </div>
                                        <a href="#" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>
                        </section>
                    </div>
                </div>

            </div> 
        </div>
        
    </div>
    <?php include_once('home/modal/modal_payment.php');?>
    <?php include_once('receipt/modal/modal_attachlist.php'); ?>
    <?php include_once('receipt/modal/modal_attachment.php'); ?>

    <?php
    include_once ROOT_CSS . '/import_js.php';
    

    include_once('js.php');
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
 

        });
    </script>
</body>

</html>

<?php

// function getProvince()
// {
//     echo '<option value="" selected>-- เลือกจังหวัด --</option>
//     <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
//     <option value="กระบี่">กระบี่ </option>
//     <option value="กาญจนบุรี">กาญจนบุรี </option>
//     <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
//     <option value="กำแพงเพชร">กำแพงเพชร </option>
//     <option value="ขอนแก่น">ขอนแก่น</option>
//     <option value="จันทบุรี">จันทบุรี</option>
//     <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
//     <option value="ชัยนาท">ชัยนาท </option>
//     <option value="ชัยภูมิ">ชัยภูมิ </option>
//     <option value="ชุมพร">ชุมพร </option>
//     <option value="ชลบุรี">ชลบุรี </option>
//     <option value="เชียงใหม่">เชียงใหม่ </option>
//     <option value="เชียงราย">เชียงราย </option>
//     <option value="ตรัง">ตรัง </option>
//     <option value="ตราด">ตราด </option>
//     <option value="ตาก">ตาก </option>
//     <option value="นครนายก">นครนายก </option>
//     <option value="นครปฐม">นครปฐม </option>
//     <option value="นครพนม">นครพนม </option>
//     <option value="นครราชสีมา">นครราชสีมา </option>
//     <option value="นครศรีธรรมราช">นครศรีธรรมราช </option>
//     <option value="นครสวรรค์">นครสวรรค์ </option>
//     <option value="นราธิวาส">นราธิวาส </option>
//     <option value="น่าน">น่าน </option>
//     <option value="นนทบุรี">นนทบุรี </option>
//     <option value="บึงกาฬ">บึงกาฬ</option>
//     <option value="บุรีรัมย์">บุรีรัมย์</option>
//     <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>
//     <option value="ปทุมธานี">ปทุมธานี </option>
//     <option value="ปราจีนบุรี">ปราจีนบุรี </option>
//     <option value="ปัตตานี">ปัตตานี </option>
//     <option value="พะเยา">พะเยา </option>
//     <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>
//     <option value="พังงา">พังงา </option>
//     <option value="พิจิตร">พิจิตร </option>
//     <option value="พิษณุโลก">พิษณุโลก </option>
//     <option value="เพชรบุรี">เพชรบุรี </option>
//     <option value="เพชรบูรณ์">เพชรบูรณ์ </option>
//     <option value="แพร่">แพร่ </option>
//     <option value="พัทลุง">พัทลุง </option>
//     <option value="ภูเก็ต">ภูเก็ต </option>
//     <option value="มหาสารคาม">มหาสารคาม </option>
//     <option value="มุกดาหาร">มุกดาหาร </option>
//     <option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>
//     <option value="ยโสธร">ยโสธร </option>
//     <option value="ยะลา">ยะลา </option>
//     <option value="ร้อยเอ็ด">ร้อยเอ็ด </option>
//     <option value="ระนอง">ระนอง </option>
//     <option value="ระยอง">ระยอง </option>
//     <option value="ราชบุรี">ราชบุรี</option>
//     <option value="ลพบุรี">ลพบุรี </option>
//     <option value="ลำปาง">ลำปาง </option>
//     <option value="ลำพูน">ลำพูน </option>
//     <option value="เลย">เลย </option>
//     <option value="ศรีสะเกษ">ศรีสะเกษ</option>
//     <option value="สกลนคร">สกลนคร</option>
//     <option value="สงขลา">สงขลา </option>
//     <option value="สมุทรสาคร">สมุทรสาคร </option>
//     <option value="สมุทรปราการ">สมุทรปราการ </option>
//     <option value="สมุทรสงคราม">สมุทรสงคราม </option>
//     <option value="สระแก้ว">สระแก้ว </option>
//     <option value="สระบุรี">สระบุรี </option>
//     <option value="สิงห์บุรี">สิงห์บุรี </option>
//     <option value="สุโขทัย">สุโขทัย </option>
//     <option value="สุพรรณบุรี">สุพรรณบุรี </option>
//     <option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>
//     <option value="สุรินทร์">สุรินทร์ </option>
//     <option value="สตูล">สตูล </option>
//     <option value="หนองคาย">หนองคาย </option>
//     <option value="หนองบัวลำภู">หนองบัวลำภู </option>
//     <option value="อำนาจเจริญ">อำนาจเจริญ </option>
//     <option value="อุดรธานี">อุดรธานี </option>
//     <option value="อุตรดิตถ์">อุตรดิตถ์ </option>
//     <option value="อุทัยธานี">อุทัยธานี </option>
//     <option value="อุบลราชธานี">อุบลราชธานี</option>
//     <option value="อ่างทอง">อ่างทอง </option>';
// }
?>