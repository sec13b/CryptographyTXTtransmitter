<html>

</html>

<?php
$uname = "";
if (!isset($_SESSION['user_id'])) {
    echo 'Войдите в свой аккаунт, чтобы читать сообщения';
} else {
    if (isset($_POST['upd-txt']))
    // $hashed_subject = hash('sha256', $_GET['subject']);
        $hashed_user_name = '';
        $hashed_user_name = hash('sha256', $_SESSION['user_name']);
        $txts = glob('private/messages/' . $hashed_user_name . '*.txt');
        if(count($txts) > 0){
            var_dump($txts);
            echo '
            <form action="" method="POST">
                <button type="submit" name="download-txts" value="download-txts">Скачать первый файл</button>
            </form> 
            ';
        }else{
            echo 'У вас нет новых сообщений';
        }
        
        echo('
        <div class="search-button">
        <form action="" method="POST">
        <button type="submit" name="upd-txt" value="upd-txt">Обновить почтовый ящик</button>
        </form>
        </div>');
        if(isset($_POST['download-txts'])){
            $filename = $_SESSION['user_name'] . rand(0, 123456) . '.txt';
            $file = $txts[0];

            header('Content-type: application/octet-stream');
            header("Content-Type: " . mime_content_type($file));
            header("Content-Disposition: attachment; filename=" . $filename);
            while (ob_get_level()) {
                ob_end_clean();
            }
            readfile($file);
            unlink($file);
            exit();
            //header('Location: index');

            //update_page();
            // $txts = glob('private/messages/' . $hashed_user_name . '*.txt');
            // if (count($txts) > 0) {
            //     var_dump($txts);
            //     echo '
            //     <form action="" method="POST">
            //         <button type="submit" name="download-txts" value="download-txts">Скачать первый файл</button>
            //     </form> 
            //     ';
            
            // }
            
        }
}
?>