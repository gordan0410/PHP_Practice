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
    password VARCHAR(10) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
        return $this->oMySQL->query($sSQL);
    }

    public function createData($_sName ,$_sUsername, $_sPassword)
    {
        $sSQL = "INSERT user(name,username, password) Values('$_sName','$_sUsername', '$_sPassword')";
        $this->oMySQL->query($sSQL);
        return $this->oMySQL->lastId();
    }

    public function getData($_sUsername)
    {
        $sSQL = "SELECT name, username, password FROM user WHERE username=$_sUsername";
        $this->oMySQL->query($sSQL);
        return $this->oMySQL->getSingle();
    }

    public function updateData($_sUsername, $_sName, $_sPassword)
    {
        $sSQL = "UPDATE user SET name='$_sName', $_sPassword WHERE username=$_sUsername";
        $this->oMySQL->query($sSQL);
        return $this->oMySQL->lastId();
    }

    public function deleteData($_sUsername)
    {
        $sSQL = "DELETE FROM student WHERE username=$_sUsername";
        return $this->oMySQL->query($sSQL);
    }
    
}