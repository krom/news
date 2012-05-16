<?php
session_start();
if (isset($_GET['logout'])) {
    unset($_SESSION['user']);
}


//var_dump($_SESSION);
/**
 * Created by JetBrains PhpStorm.
 * User: krom
 * Date: 16.05.12
 * Time: 19:30
 * To change this template use File | Settings | File Templates.
 */
include ('inc.php');
if (isset($_SESSION['user'])) {

if (isset($_POST['add'])) {
    $text = $_POST['text'];

    if (trim($text) == '') {
        echo 'Надо ввести текст новости';
    } else {

        $file = fopen(DB_FILE, 'a+t');
        fwrite($file, "<br>\n".date('d.m.Y').': '.$text.' by '.$_SESSION['user']);
        fclose($file);
        header('Location: index.php');
    }
}
?>

<form action="add.php" method="post">
    <textarea name='text'>Текст новости</textarea>
    <br>
    <input type="submit" name="add" value="Добавить">
</form>
<hr>
    <a href="add.php?logout=1">Выйти</a>
<?
} else {

    if (isset($_POST['dologin'])) {
        $users = file(PWD_FILE);
        foreach($users as $line) {
            list($login, $password) = explode(':', $line);
            if ($login == $_REQUEST['login'] &&
                $password == $_REQUEST['pass']) {
                // Нашли пользователя
                $_SESSION['user'] = $login;
                header('Location: add.php');
                break;
            }
        }
        if (!isset($_SESSION['user'])) {
            echo 'Доступ закрыт';
        }
    } else {
    ?>
    <form action="add.php" method="post">
    <input type="text" name="login"><br>
    <input type="password" name='pass'><br>
        <input type="submit" name="dologin">
    </form>
    <?
}}
?>