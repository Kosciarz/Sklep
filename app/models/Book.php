<?php

require_once __DIR__ . '/../core/Model.php';

class Book extends Model
{
    public function getAll(): array
    {
        $query = "SELECT ksiazki.tytul, ksiazki.autor, kategorie.nazwa
                  FROM ksiazki
                  JOIN kategorie ON ksiazki.kategoria_id = kategorie.ID";

        $result = $this->db->query($query);
        if (!$result) {
            die ("Database error: " . $this->db->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function add($title, $author, $category_id): void
    {
        $insert_query = "INSERT INTO ksiazki (tytul, autor, kategoria_id) VALUES (?, ?, ?)";
        $insert_stmt = $this->db->prepare($insert_query);
        $insert_stmt->bind_param("ssi", $title, $author, $category_id);
        $insert_stmt->execute();
        $insert_stmt->close();
    }

    public function find($search_parameter): array
    {
        $query = "SELECT ksiazki.tytul, ksiazki.autor, kategorie.nazwa
                  FROM ksiazki
                  JOIN kategorie ON ksiazki.kategoria_id = kategorie.ID
                  WHERE ksiazki.tytul LIKE ? OR ksiazki.autor LIKE ? OR kategorie.nazwa LIKE ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $search_parameter, $search_parameter, $search_parameter);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function delete($title, $author): void
    {
        $query = "DELETE FROM ksiazki WHERE tytul = ? AND autor = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $title, $author);
        $stmt->execute();
        $stmt->close();
    }
}