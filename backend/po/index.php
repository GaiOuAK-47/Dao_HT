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
    <title>ใบสั่งซื้อสินค้า Purchase Order</title>

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
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <span class="m-0">
                                <i class="nav-icon fas fa-shopping-cart"></i> ใบสั่งซื้อสินค้า (Purchase Order )</span>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="btn" id="btnAddPO" aria-label="Basic example">

                                <button id="btnPO1" type="button" class="btn" data-toggle="modal"
                                    data-target="#modal_add"
                                    style="color:white;background : #2874A6; font-size:20px;text-shadow:2px 2px 4px #000000;"><i
                                        class="fas fa-plus" aria-hidden="true"></i> เพิ่ม PO</button>
                                <button  type="button" id="btnRefresh" class="btn"
                                    style="color:white;background : #148F77; font-size:20px;text-shadow:2px 2px 4px #000000;"><i
                                        class="fas fa-sync-alt" aria-hidden="true"></i> Refresh</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row text-nowrap">
                        <div class="col-lg-12 col-12">
                            <div>
                                <table name="tablePO" id="tablePO"
                                    class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                                    <thead class="sticky-top table-defalut bg-dark">
                                        <tr>
                                            <th>เลขที่ PO</th>
                                            <th>วันที่ออก PO</th>
                                            <th>รหัสพัสดุ</th>
                                            <th style="text-align:left">รายการสินค้า</th>
                                            <th style="text-align:center">ผู้ขาย</th>
                                            <th style="text-align:center">สถานะ</th>

                                        </tr>
                                    </thead>
                                    <tbody class="text-nowrap" style="background:#ECF2FF;">

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
        <?php include_once('modal/modal_stock.php');?>
        <?php include_once('modal/modal_unit.php');?>
        <?php include_once('modal/modal_attachlist.php');?>
        <?php include_once('modal/modal_attachment.php');?>
    </div>

    <?php
    include_once ROOT_CSS . '/import_js.php';
    

    include_once('js.php'); 
    ?>

</body>

</html>