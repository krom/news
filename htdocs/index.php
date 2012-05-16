<?php
/**
 * Created by JetBrains PhpStorm.
 * User: krom
 * Date: 16.05.12
 * Time: 19:22
 * To change this template use File | Settings | File Templates.
 */

include('inc.php');
?>
<h2>Новости</h2>
<?
echo file_get_contents(DB_FILE);
?>
<hr>
<a href="add.php">Добавить</a>