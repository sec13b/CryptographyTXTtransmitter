<?php
session_start();
if(isset($_POST['txt-send'])){
    $rec_name = $_POST['rec-name'];
    $subject = $_POST['subject'];
    $txt_input = $_POST['txt-input'];
    $data_array = [
        $rec_name,
        $subject,
        $txt_input,
    ];

    //var_dump($data_array);
    // echo 'TO: ';
    // echo $data_array[0];
    // echo '<br>';
    // echo 'SUBJECT: ';
    // echo $data_array[1];
    // echo '<br>';
    // echo 'TEXT: ';
    // echo $data_array[2];
    // echo '<br>';

    $formated_data_array = [
        $to = 'TO: ' . $data_array[0] . '; ',
        $sub = 'SUBJECT: ' . $data_array[1] . '; ',
        $txt = 'TEXT: ' . $data_array[2] . '; ',
    ];

    //$filename = password_hash($rec_name, PASSWORD_BCRYPT);
    // $filename = __DIR__ . 'rec_name.txt';
    // file_put_contents($filename, $formated_data_array);
    $filename = hash('sha256', $rec_name) . rand(1, 123456789) . '.txt';
    $text = $formated_data_array;
    //записываем текст в файл
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/private/messages/{$filename}", $text);
    echo('<p style="color: green;">Ваше сообщение пользователю ' . $rec_name . ' успешно отправлено!</p>');

}
?>

<html>
<form method="post" action="" name="txt-data">
    <div class="input-form" style="display: inline-block;">
        <input type="text" name="rec-name" placeholder="Кому" style="display: block; margin-top: 10px;" required>
        <input type="text" name="subject" placeholder="Тема" style="display: block; margin-top: 10px;" required>
        <textarea name="txt-input" id="txt-input" cols="30" rows="10" style="margin-top: 10px;" placeholder="Введите сообщение здесь" required></textarea>
    </div>
    <button type="submit" name="txt-send" value="txt-send" style="margin-top: 50px;">SEND</button>
</form>
<a href="index">На главную</a>

</html>