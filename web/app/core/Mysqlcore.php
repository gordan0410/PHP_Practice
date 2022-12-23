<?php

namespace Web\App\Core;

use Exception;
use mysqli;

class Mysqlcore
{
    private $sHostname;
    private $sUsername;
    private $sPassword;
    private $sDatabaseName;
    private $oConn;
    private $oResult;

    public function __construct()
    {
        $this->sHostname = DB_HOST;
        $this->sUsername = DB_USER;
        $this->sPassword = DB_PASS;
        $this->sDatabaseName = DB_DBNAME;
    }

    public function __destruct()
    {
        if (isset($this->oConn)) {
            $this->oConn->close();
        }
    }

    public function connenct()
    {
        $oConn = new mysqli($this->sHostname, $this->sUsername, $this->sPassword, $this->sDatabaseName);
        if ($oConn->connect_error) {
            die("連線失敗: " . $oConn->connect_error);
        }
        $oConn->query("SET NAMES utf8");
        $this->oConn = $oConn;
    }

    /**
     * checkError 檢查sql是否有錯誤
     *
     * @param  object $_oResult
     * @return void
     */
    public function checkError($_oResult)
    {
        if (is_bool($_oResult)) {
            if ($_oResult !== true) {
                throw new Exception($this->oConn->error);
            }
        }
    }

    /**
     * query 執行sql語法 (sql請勿使用外部輸入值, 避免sql injection)
     *
     * @param  string $_sSQL
     * @return object mysqli_result
     */
    public function query($_sSQL)
    {
        $this->connenct();
        $this->oResult = $this->oConn->query($_sSQL);
        $this->checkError($this->oResult);
        return $this->oResult;
    }

    public function lastId()
    {
        return $this->oConn->insert_id;
    }

    /**
     * getSingle 取query的返回資料
     *
     * @param  object $_oResult mysqli_result 沒帶入則拿最後一筆query的返回資料
     * @return array 返回資料
     */
    public function getSingle($_oResult = null)
    {
        if (isset($_oResult)) {
            return $_oResult->fetch_assoc();
        }
        return $this->oResult->fetch_assoc();
    }

    /**
     * getAll 取query的返回資料(多筆)
     *
     * @param  object $_oResult mysqli_result 沒帶入則拿最後一筆query的返回資料
     * @return array 返回資料(多筆)
     */
    public function getAll($_oResult = null)
    {
        $aResult = [];
        if (isset($_oResult)) {
            while ($aRow = $_oResult->fetch_assoc()) {
                $aResult[] = $aRow;
            }
            return $aResult;
        }

        while ($aRow = $this->oResult->fetch_assoc()) {
            $aResult[] = $aRow;
        }
        return $aResult;
    }

    /**
     * getAffectedRow 取得最後一次query受影響的資料筆數
     *
     * @return int 筆數
     */
    public function getAffectedRow()
    {
        return $this->oConn->affected_rows;
    }

    /**
     * newQueryStmt 建立query statement
     *
     * @param  string $_sSQL 欲格式化的sql語法
     * @return object query statement
     */
    public function newQueryStmt($_sSQL)
    {
        return new MysqlStmt($this->oConn, $_sSQL);
    }

}
