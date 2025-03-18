<?php

require_once('../core/Model.php');

class KsiazkaModel extends Model
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getKsiazki()
    {
        $query =
            "SELECT ksiazki.tytul, ksiazki.autor, kategorie.nazwa AS kategoria 
             FROM ksiazki
             JOIN kategorie ON ksiazki.kategoria_id = kategorie.id";
        return $this->db->query($query);
    }
}