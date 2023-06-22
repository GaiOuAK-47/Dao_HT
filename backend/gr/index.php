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
    <title> ใบรับสินค้า Goods Receipt</title>

    <?php 
    include_once('css.php');
    include_once('../../config.php');
    include_once('../import_css.php');
    include_once ROOT_CSS . '/func.php'; 
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
                    <div class="row">
                        <div class="col-sm-12">
                            <span id="iconGR1" class="m-0"><i  class="nav-icon fas fa-truck-loading"></i>
                                ใบรับสินค้า Goods Receipt</span>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <form id="formGR" data-ajax="false" target="_blank" method="post">
                                <div data-role="fieldcontain">

                                    <div class="btn" id="btnAddGR" aria-label="Basic example">
                                        <button id="btngr1"
                                            style="color:white;background : #2874A6; font-size:20px;text-shadow:2px 2px 4px #000000;"
                                            type="button" class="btn" data-toggle="modal" data-target="#modal_add"><i
                                                class="fa 	fas fa-plus" aria-hidden="true"></i>
                                            เพิ่ม GR</button>
                                        <button 
                                            style="color:white;background : #148F77; font-size:20px;text-shadow:2px 2px 4px #000000;"
                                            type="button" id="btnRefresh" class="btn">
                                            <i class="fas fa-sync-alt" aria-hidden="true"></i> Refresh</button>
                                    </div>
                                    <div class="btn" id="btnBack" style="display:none;" aria-label="Basic example">
                                        <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            ย้อนกลับ</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row" >
                        <div class="col-lg-12 col-12">
                            <div>
                                <table name="tableGR" id="tableGR" style="overflow-x: scroll;"
                                    class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                                    <thead class="sticky-top table-defalut bg-dark" id="theadGR">
                                        <tr>
                                            <th>เลขที่ GR</th>
                                            <th>วันที่รับ</th>
                                            <th>เลขที่ PO</th>
                                            <th>รหัสพัสดุ</th>
                                            <th style="text-align:left">รายการสินค้า</th>
                                            <th style="text-align:center">ผู้ขาย</th>
                                            <th style="text-align:center">สถานะ</th>

                                        </tr>
                                    </thead>
                                    <tbody id="tableGR1"class="text-nowrap" style="background:#ECF2FF;">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <?php include_once('modal/modal_add.php');?>
        <?php include_once('modal/modal_edit.php');?>
        <?php include_once('modal/modal_supplier.php');?>
        <?php include_once('modal/modal_po.php');?>
        <?php include_once('modal/modal_unit.php');?>
    </div>

    <?php
    include_once ROOT_CSS . '/import_js.php';
    

    include_once('js.php'); 
    ?>

</body>

</html>