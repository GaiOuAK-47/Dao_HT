<?php
define('ROOT_CSS',str_replace("\\",'/',dirname(__FILE__)));
define('PATH_CSS', ROOT_CSS == $_SERVER['DOCUMENT_ROOT']
    ?'' :substr(ROOT_CSS,strlen($_SERVER['DOCUMENT_ROOT']))
);
?>
<link rel="icon" href="<?php echo PATH; ?>/backend/img/LOGO LOGIN.png"">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet"
    href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet"
    href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet"
    href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css">

<link rel="stylesheet"
    href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
    href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet"
    href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet"
    href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<link rel="stylesheet" href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/plugins/select2/css/select2.min.css">

<link rel="stylesheet" href="<?php echo PATH; ?>/backend/AdminLTE-3.2.0/plugins/bs-stepper/css/bs-stepper.min.css">

<style>
    body.swal2-toast-shown .swal2-container { 
        width: auto !important;
        min-width: 350px; 
    }
    .swal2-toast {
        max-width: 100%;
        min-width: 350px; 
        
        display: flex !important;
        align-items: center !important;
        /* border-radius: .25rem; */
        /* background-color: rgba(255,255,255,.85); */
    }
    .swal2-popup.swal2-toast {
        padding: 1rem;
        font-size: 1rem;
    }
    .swal2-popup.swal2-toast>* {
        grid-column: 2;
    }
    .swal2-popup.swal2-toast .swal2-title {
        margin: .5em 1em;
        padding: 0;
        font-size: 1em;
        text-align: initial;
    }
    .modal .table td, .modal .table th {
        padding: 0.35rem; 
    }
    .content-group {
        position: relative;
        width: 100%;
        border: 2px solid #dedede;
        padding: 14px 8px;
        margin-bottom: 24px;
    }

    .content-group:before {
        content: attr(title);
        position: absolute;
        top: -15px;
        left: 24px;
        background-color: white;
        padding: 3px 4px;
        font-size: 0.9rem;
        font-weight: 500;
        letter-spacing: 0.7px;
    }
</style>