<?php
session_start();
include('private/cfg.php');
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $connection->prepare("SELECT * FROM users WHERE username=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo '<p class="error">Неверные пароль или имя пользователя!</p>';
    } else {
        if (password_verify($password, $result['password'])) {
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['user_name'] = $username;
            echo '<p class="success">Поздравляем, вы прошли авторизацию!</p><p><a href="index">На главную</a></p>';
        } else {
            echo '<p class="error" style="color: red;"> Неверные пароль или имя пользователя!</p>';
        }
    }
}

?>

<h1>Вход в систему</h1>
<form method="post" action="" name="signin-form">
    <div class="form-element">
        <label>Логин</label>
        <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
    </div>
    <div class="form-element">
        <label>Пароль</label>
        <input type="password" name="password" required />
    </div>
    <button type="submit" name="login" value="login">Войти</button>
<p><a href="signup">Ещё нет аккаунта? Зарегистрируйтесь!</a></p>
</form>