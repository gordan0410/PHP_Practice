<?php
$sServername   = "mysql";
$sUsername     = "root";
$sPassword     = "admin";
$sDatabasename = "myDB";

// 建立連線
$oConn = new mysqli($sServername, $sUsername, $sPassword, $sDatabasename);

// 檢查連線
if ($oConn->connect_error) {
    die("連線失敗: " . $oConn->connect_error);
}
echo "連線成功";
echo "<br>";

//解決中文亂碼問題
$oConn->query("SET NAMES utf8");

//寫入資料
$sSQL = "INSERT INTO student (student_name, student_birth, student_sex)
VALUES ('John', '1995-05-21', '男')";

if ($oConn->query($sSQL) === true) {
  echo "新增資料成功";
} else {
  echo "錯誤: " . $sSQL . "<br>" . $oConn->error;
}
$oConn->close();
