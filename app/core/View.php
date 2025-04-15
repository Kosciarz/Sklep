<?php

require_once __DIR__ . '/../core/Model.php';
require_once __DIR__ . '/../core/Controller.php';

class View
{
    protected Model $model_;

    public function __construct($model)
    {
        $this->model_ = $model;
    }

    public function render($template_file): void
    {
        extract($this->model_->data);
        require_once __DIR__ . "/../templates/$template_file.php";
    }
}