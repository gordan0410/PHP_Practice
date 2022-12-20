<?php
//debug
ini_set("display_errors", "1");
error_reporting(E_ALL);
require '../../vendor/autoload.php';
require_once '../app/config/database.php';

use Web\App\Core\Core;
use Throwable;

try {
    new Core();
} catch (\Throwable $_oThrowable) {
    echo $_oThrowable->getMessage();
}