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
// 建立資料表
$sTableName = "student";
$sSQL = 'CREATE TABLE `student` (
    `student_id` int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `student_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `student_birth` date NOT NULL,
    `student_sex` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;';

if ($oConn->query($sSQL) === true) {
    echo "建立資料表(student)成功";
} else {
    echo "建立資料表失敗: " . $oConn->error;
}
$oConn->close();
