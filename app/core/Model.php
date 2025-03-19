<?php

class Model
{
    protected mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }
}