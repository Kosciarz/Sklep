<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Book.php';

class BookController extends Controller
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function index(): void
    {
        $this->model_->setData('books', $this->model_->getAll());
    }

    public function add(): void
    {
        if (empty($_POST['tytul']) || empty($_POST['autor']) || $_POST['kategoria'] == "null") {
            $error = "All fields required";
            $this->model_->setData('error', $error);
            return;
        }

        $this->model_->add($_POST['tytul'], $_POST['autor'], intval($_POST['kategoria']));
        $this->index();
    }

    public function search(): void
    {
        $search_parameter = $_POST['tytul'] ?? $_POST['autor'] ?? $_POST['kategoria'] ?? "";
        $books = $this->model_->find($search_parameter) ?? [];
        $this->model_->setData('books', $books);
    }

    public function delete(): void
    {
        $this->model_->delete($_POST['tytul'], $_POST['autor']);
        $this->index();
    }
}