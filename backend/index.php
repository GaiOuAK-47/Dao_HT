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
    <title>เฮือนช้างเผือก</title>

    <?php
    include_once('../config.php');
    include_once('import_css.php');
    include_once('css.php');
    include_once ROOT_CSS . '/func.php';
    ?>
</head>

<body>
    <div class="wrapper" width="100%">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo PATH; ?>/backend/img/DHTLOGO.png" alt="AdminLTELogo"
                width="50%">
        </div>

        <?php include_once ROOT_CSS . '/menu_head.php'; ?>
    </div>
    <?php
    include_once ROOT_CSS . '/import_js.php';
    ?>
    <script type="text/javascript">
    $(document).ready(function() {});
    </script>
</body>

</html>