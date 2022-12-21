<?php

namespace Web\App\Models;

use Web\App\Core\Mysqlcore;

class User
{
    private $oMySQL;

    public function __construct()
    {
        $this->oMySQL = new Mysqlcore();
    }

    public function createTable()
    {
        $sSQL = "CREATE TABLE IF NOT EXISTS user (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(10)  NOT NULL,
    username VARCHAR(10) NOT NULL,
    password VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
        return $this->oMySQL->query($sSQL);
    }

    public function createData($_sName ,$_sUsername, $_sPassword, $_sToken)
    {
        $sSQL = "INSERT user(name, username, password, token) Values('$_sName','$_sUsername', '$_sPassword', '$_sToken')";
        $this->oMySQL->query($sSQL);
        return $this->oMySQL->lastId();
    }

    public function getDataByID($_iID)
    {
        $sSQL = "SELECT name, username, password, token FROM user WHERE id=$_iID";
        $this->oMySQL->query($sSQL);
        return $this->oMySQL->getSingle();
    }

    public function getDataByUserName($_sUsername)
    {
        $sSQL = "SELECT name, username, password, token FROM user WHERE username='$_sUsername'";
        $this->oMySQL->query($sSQL);
        return $this->oMySQL->getSingle();
    }

    public function checkUserExist($_sUsername)
    {
        $sSQL = "SELECT name, username, password, token FROM user WHERE username='$_sUsername'";
        $this->oMySQL->query($sSQL);
        return $this->oMySQL->getRowCount();
    }

    public function getDataByToken($_sToken)
    {
        $sSQL = "SELECT id,name, username, password FROM user WHERE token='$_sToken'";
        $this->oMySQL->query($sSQL);
        return $this->oMySQL->getSingle();
    }

    public function editUserName($_iID, $_sName)
    {
        $sSQL = "UPDATE user SET name='$_sName' WHERE id=$_iID";       
        return $this->oMySQL->query($sSQL);
    }


    public function editPassword($_iID, $_sNewPassword)
    {
        $sSQL = "UPDATE user SET password='$_sNewPassword' WHERE id=$_iID";
        return  $this->oMySQL->query($sSQL);
    }

    public function deleteData($_sUsername)
    {
        $sSQL = "DELETE FROM student WHERE username='$_sUsername'";
        return $this->oMySQL->query($sSQL);
    }
    
}