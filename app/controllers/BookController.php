<?php

session_start();

require_once __DIR__ . '/../core/Controller.php';

class BookController extends Controller
{
    public function index()
    {
        $bookModel = $this->model('BookModel');
        $books = $bookModel->getAllBooks();

        $_SESSION['books'] = $books;
        $this->view('biblioteka');
    }

    public function add()
    {
        $bookModel = $this->model('BookModel');

        if ($_SERVER['REQUEST_METHOD'] == "POST"
            && isset($_POST['tytul'])
            && isset($_POST['autor'])
            && isset($_POST['kategoria']) && $_POST['kategoria'] != "null") {

            $bookModel->addNewBook($_POST['tytul'], $_POST['autor'], $_POST['kategoria']);
        }
    }

    public function search()
    {

    }

    public function delete()
    {

    }

}