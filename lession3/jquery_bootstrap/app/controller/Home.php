<?php
namespace Lessoion3\Jquery_bootstrap\App\Controller;

use Lessoion3\Jquery_bootstrap\App\Core\Controller;

class Home extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Student');
    }

    public function index()
    {
        $aData = [
            'Student' => $this->postModel->getAll(),
        ];
        $this->view('table/home', $aData);
    }

    public function delete($_sParm)
    {
        $iResult = $this->postModel->delete($_sParm);
        if ($iResult) {
            echo json_encode(['event' => true]);
        }
        echo json_encode(['event' => false]);
    }

    public function insert()
    {
        $iResult = $this->postModel->insert();
        if ($iResult) {
            header('Location: index.php?data=home');
        }
    }
}