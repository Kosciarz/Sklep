<?php

class Controller
{
    protected mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function model(string $model)
    {
        require_once('../models/' . $model . '.php');
        return new $model($this->db);
    }

    public function view(string $view, array $data = []): void
    {
        extract($data);
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}