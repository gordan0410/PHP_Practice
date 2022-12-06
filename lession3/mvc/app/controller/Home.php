<?php
namespace Lessoion3\Mvc\App\Controller;

use Lessoion3\Mvc\App\Core\Controller;

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
}