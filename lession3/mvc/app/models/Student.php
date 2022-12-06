<?php

namespace Lessoion3\Mvc\App\Models;

use Lessoion3\Mvc\App\Core\Mysqlcore;

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
}
