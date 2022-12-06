<?php

namespace Lessoion3\Jquery_bootstrap\App\Models;

use Lessoion3\Jquery_bootstrap\App\Core\Mysqlcore;

class Student
{
    private $oMySQL;

    public function __construct()
    {
        $this->oMySQL = new Mysqlcore();
    }
    public function getAll()
    {
        $sSQL    = 'SELECT student_id, student_name, student_birth, student_sex FROM student';
        $oResult = $this->oMySQL->query($sSQL);
        $aResult = $this->oMySQL->fetch_all();
        return $aResult;
    }

    public function delete($_iStudentId)
    {
        $sSQL = "DELETE FROM student WHERE student_id=".$_iStudentId;
        $iResult = $this->oMySQL->query($sSQL);
        return $iResult;
    }

    public function insert()
    {
        $sSQL = "INSERT INTO student (student_name, student_birth, student_sex) VALUES ('Peter', '1996-12-21', '男')";
        $iResult = $this->oMySQL->query($sSQL);
        return $iResult;
    }
}
