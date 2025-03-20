<?php

session_start();

require_once __DIR__ . '/../core/Controller.php';

class BookController extends Controller
{
    private BookModel $book_model_;

    public function __construct(mysqli $db)
    {
        parent::__construct($db);
        $this->book_model_ = $this->model('BookModel');
    }

    public function index(): void
    {
        $books = $this->book_model_->getAllBooks();
        $this->view('biblioteka', ['books' => $books]);
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST"
            && isset($_POST['tytul'])
            && isset($_POST['autor'])
            && isset($_POST['kategoria']) && $_POST['kategoria'] != "null") {

            $this->book_model_->addNewBook($_POST['tytul'], $_POST['autor'], $_POST['kategoria']);
            header('Location: ' . __DIR__ . '/../views/biblioteka.php');
            exit();
        }
    }

    public function search()
    {
        $search_parameter = $_POST['tytul'] ?? $_POST['autor'] ?? $_POST['kategoria'] ?? '';
        $books = $this->book_model_->searchBook($search_parameter) ?? [];

        $this->view('biblioteka', ['books' => $books]);
    }

    public function delete()
    {

    }

}