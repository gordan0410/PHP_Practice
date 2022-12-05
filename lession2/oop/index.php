<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

include_once "./mysqli/core.php";

$oMySQL = new Core('mysql', 'root', 'admin', 'myDB');

echo '<br>-------------取資料----------<br>';
$sSQL = 'SELECT student_id, student_name, student_birth, student_sex FROM student';
$oResult = $oMySQL->query($sSQL);
$aResult = $oMySQL->fetch();
var_export($aResult);


echo '<br>-------------寫入資料----------<br>';
$sSQL = "INSERT INTO student (student_name, student_birth, student_sex) VALUES ('Alice', '1994-04-21', '女')";
$oResult = $oMySQL->query($sSQL);
$iLastId = $oMySQL->lastId();
var_export($oResult);
echo '<br>';
var_export('last_id:' . $iLastId);

echo '<br>-------------更新資料----------<br>';
$sSQL = "UPDATE student SET student_name='Mandy', student_birth='1985-02-11' WHERE student_id=5";
$oResult = $oMySQL->query($sSQL);
var_export($oResult);

echo '<br>-------------刪除資料----------<br>';
$sSQL = "DELETE FROM student WHERE student_id=".$iLastId;
$oResult = $oMySQL->query($sSQL);
var_export($oResult);