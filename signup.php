<?php
require('very_useful_numbers.php');
$rand_number = rand(123456789, 98765432100);
?>

<?php
session_start();
include('private/cfg.php');
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $query = $connection->prepare("SELECT * FROM users WHERE username=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    //$query->execute();
    if ($query->rowCount() > 0) {
        echo '<p class="error">Этот ник уже занят!</p>';
    }
    if($query->rowCount() == 0) {
        $query = $connection->prepare("INSERT INTO users(username,password) VALUES (:username,:password_hash)");
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
        $query->execute();
        if ($query) {
            echo '<p class="success">Регистрация прошла успешно!</p>';
            echo 'Регистрация прошла успешно. Сейчас вы будете перенаправлены на главную страницу...';
            header('Location: signin');
        } else {
            echo '<p class="error">Неверные данные!</p>';
        }
    }
}
?>

<h1>Регистрация</h1>

<form method="post" action="" name="signup-form">
    <div class="form-element">
        <label>Придумайте логин</label>
        <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Придумайте пароль</label>
        <input type="password" name="password" required />
    </div>
    <!-- <div class="form-element">
        <label>Набор цифр, нужных для шифрования</label>
        <div id="gen-nums">
            <h3><?php echo $rand_number;
                echo (' -- Это ваш секретный ключ. Запишите его.'); ?></h3>
        </div>
    </div> -->
    <button type="submit" name="register" value="register">Зарегистрироваться</button>
</form>
<p><a href="signin">У меня уже есть аккаунт</a></p>