<?php

namespace Web\App\Core;

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
        if (isset($this->oConn)){
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

    public function checkError()
    {
        if ($this->oResult !== true) {
            echo $this->oConn->error;
        }
    }

    public function query($_sSQL)
    {
        $this->connenct();
        $this->oResult = $this->oConn->query($_sSQL);
        $this->checkError($this->oResult);
        return $this->oResult;
    }

    public function queryWithoutErroCheck($_sSQL)
    {
        $this->connenct();
        $this->oResult = $this->oConn->query($_sSQL);
        return $this->oResult;
    }

    public function lastId()
    {
        return $this->oConn->insert_id;
    }

    public function getSingle()
    {
        return $this->oResult->fetch_assoc();
    }

    public function getAll()
    {
        $aResult = [];
        while ($aRow = $this->oResult->fetch_assoc()) {
            $aResult[] = $aRow;
        }
        return $aResult;
    }

    public function getRowCount()
    {
        return $this->oResult->num_rows;
    }
}