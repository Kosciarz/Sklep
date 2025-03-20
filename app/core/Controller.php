<?php

class Controller
{
    protected Model $model_;

    public function __construct(Model $model) {
        $this->model_ = $model;
    }
}