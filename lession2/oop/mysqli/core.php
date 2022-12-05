<?php

class Core
{
    private $sServername;
    private $sUsername;
    private $sPassword;
    private $sDatabaseName;
    private $oConn;
    private $oResult;

    public function __construct($_sServername, $_sUsername, $_sPassword, $_sDatabaseName)
    {
        $this->sServername   = $_sServername;
        $this->sUsername     = $_sUsername;
        $this->sPassword     = $_sPassword;
        $this->sDatabaseName = $_sDatabaseName;
    }

    public function __destruct()
    {
        $this->oConn->close();
    }

    public function connenct()
    {
        $oConn = new mysqli($this->sServername, $this->sUsername, $this->sPassword, $this->sDatabaseName);
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

    public function lastId()
    {
        return $this->oConn->insert_id;
    }

    public function fetch()
    {
        return $this->oResult->fetch_array();
    }
}
