<?php
namespace Lessoion3\Jquery_bootstrap\App\Core;

use Exception;

class Core
{
    private $sControllerName;
    private $sFunctionName;
    private $sParm;

    public function __construct()
    {
        if (empty($_GET['data'])) {
            throw new Exception('Domain error');
        }
        $sData = $_GET['data'];
        $aData = explode('/', $sData);
        if (empty($aData[0])) {
            throw new Exception('Controller error');
        }
        if (empty($aData[1])) {
            $aData[1] = 'index';
        }
        if (empty($aData[2])) {
            $aData[2] = '';
        }
        $sControllerName = $aData[0];
        $sFunctionName = $aData[1];
        $sParm = $aData[2];

        $sPath = 'Lessoion3\\Jquery_bootstrap\\App\\Controller\\' . ucfirst(strtolower($sControllerName));

        $oController = new $sPath();
        return $oController->$sFunctionName($sParm);
    }
}
