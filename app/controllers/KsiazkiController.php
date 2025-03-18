<?php

require_once('../core/Controller.php');

class KsiazkiController extends Controller
{
    public function index()
    {
        $ksiazkaModel = $this->model('KsiazkaModel');
        $ksiazki = $ksiazkaModel->getKsiazki();
        $this->view('../views/biblioteka', ['ksiazki' => $ksiazki]);
    }
}