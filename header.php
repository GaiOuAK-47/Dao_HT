<?php
include_once('config.php'); 
?>
<!-- Navigation -->

<head>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand " style="font-size:26px;" href="<?php echo PATH; ?>">เฮือนช้างเผือก</a>
        </div>
    </nav>
</head>

<body style="background-image: url('<?php echo PATH; ?>/img/BG.jpg')">
    <div class="login ">
        <h1> <img src="img/DHTLOGO.png" width="50%;"></h1>
        <form action="login_result.php" method="post">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>