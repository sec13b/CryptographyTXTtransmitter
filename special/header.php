<?php
session_start();

$uname = "";

if (!isset($_SESSION['user_id'])) {
    //header('Location: signin.php');
    $uname = "Гость";
    echo ('
    <div class="header" style="display: inline-block;">
        <div id="logo-text">
        <h2 style="font-family: "Courier New", Courier, monospace; display: block;">TXT ACROSS NETWORKS</h2>
        </div>
        <div id="social_field">
            <button><a href="signup">Регистрация</a></button>
            <button><a href="signin">Войти</a></button>
        </div>
    </div>
    ');
} else {
    $uname = $_SESSION['user_name'];
    echo ('
    <p>
    <button><a href="new">NEW TXT</a></button>
    <p>
    ');
}

?>

<html>

<head>
</head>

<body>
    
    <div id="greeting"><?php echo ('Здравствуйте, ');
                        echo $uname; ?></div>
    <hr style="width: 100%; text-align: center;">
</body>

</html>
