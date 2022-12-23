<?php
namespace Web\App\Core;

use Exception;

abstract class Controller
{
    public function model($_sModel)
    {
        $sModel = "Web\\App\\Models\\" . $_sModel;
        return new $sModel();
    }
    public function view($_sView, array $_sParm = [])
    {
        // 如果檔案存在就引入它
        if (file_exists('../app/view/' . $_sView . '.php')) {
            require_once '../app/view/' . $_sView . '.php';
        } else {
            throw new Exception('View does not exist');
        }
    }
}
