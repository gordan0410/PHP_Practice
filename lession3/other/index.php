<?php
//debug
ini_set("display_errors", "1");
error_reporting(E_ALL);
require '../../vendor/autoload.php';

use Lessoion3\Other\Mysqli\Core;

$oMySQL = new Core('mysql', 'root', 'admin', 'myDB');

echo '<br>-------------取資料----------<br>';
$sSQL = 'SELECT student_id, student_name, student_birth, student_sex FROM student';
$oResult = $oMySQL->query($sSQL);
$aResult = $oMySQL->fetch();
var_export($aResult);