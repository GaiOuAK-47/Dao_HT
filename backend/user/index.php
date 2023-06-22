<?php
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../../');
        exit;
    }
    include_once('../conn.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการผู้ใช้ (User)</title>

    <?php 
    include('css.php'); 
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

                            <span class="m-0"><i class="fas fa-users"></i> จัดการผู้ใช้งาน (User)</span>
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
                                    <div  id="btnAddSO"  aria-label="Basic example">
                                        <button id="btnUSER" type="button" class="btn"
                                            style="color:white;background :  #2874A6; font-size:20px;text-shadow:2px 2px 4px #000000;"
                                            data-toggle="modal" data-target="#modal_add"><i class="	fas fa-user-plus"
                                                aria-hidden="true"></i>
                                            เพิ่มผู้ใช้</button>
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
                            <table name="tableUser" id="tableUser"
                                class="table table-striped table-valign-middle table-bordered table-hovers text-nowarp">
                                <thead class="sticky-top table-defalut bg-dark">
                                    <tr>
                                        <th width="25%">Username</th>
                                        <th width="25%">ชื่อ</th>
                                        <th width="25%">นามสกุล</th>
                                        <th width="25%" style="text-align:center">ประเภท</th>

                                    </tr>
                                </thead>
                                <tbody class="text-nowrap" style="background:#ECF2FF;">

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </section>

            <?php include_once('modal/modal_add.php');?>
            <?php include_once('modal/modal_edit.php');?>
            <?php include_once('modal/modal_reset.php');?>
        </div>

        <?php 
    
    include_once ROOT_CSS . '/import_js.php';
    

    include_once('js.php'); 
    ?>
</body>

</html>