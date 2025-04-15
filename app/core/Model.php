<?php

class Model
{
    protected mysqli $db;
    public array $data;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
        $this->data = array();
    }

    public function setData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }
}