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


//刪除資料
$sSQL = "DELETE FROM student WHERE student_id=3";

if ($oConn->query($sSQL) === true) {
  echo "刪除成功";
} else {
  echo "刪除失敗: " . $oConn->error;
}

$oConn->close();