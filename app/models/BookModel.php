<?php

require_once __DIR__ . '/../core/Model.php';

class BookModel extends Model
{
    public function getAllBooks(): array
    {
        $query = "SELECT ksiazki.tytul, ksiazki.autor, kategorie.nazwa
                  FROM ksiazki
                  JOIN kategorie ON ksiazki.kategoria_id = kategorie.ID";

        return $this->db->query($query)->fetch_all();
    }

    public function addNewBook($title, $author, $genre): void
    {
        $genre_query = "INSERT INTO kategorie (nazwa) 
                        VALUES (?) ON DUPLICATE KEY UPDATE nazwa=nazwa";
        $genre_stmt = $this->db->prepare($genre_query);
        $genre_stmt->bind_param("s", $genre);
        $genre_stmt->execute();
        $genre_stmt->close();

        $check_query = "SELECT id FROM kategorie WHERE nazwa = ?";
        $check_stmt = $this->db->prepare($check_query);
        $check_stmt->bind_param("s", $genre);
        $check_stmt->execute();
        $check_stmt->bind_result($kategoria_id);
        $check_stmt->fetch();
        $check_stmt->close();

        $insert_query = "INSERT INTO ksiazki (tytul, autor, kategoria_id) VALUES (?, ?, ?)";
        $insert_stmt = $this->db->prepare($insert_query);
        $insert_stmt->bind_param("ssi", $title, $author, $kategoria_id);
        $insert_stmt->execute();
        $insert_stmt->close();
    }

    public function searchBook($search_parameter): array
    {
        $query = "SELECT ksiazki.tytul, ksiazki.autor, kategorie.nazwa
                  FROM ksiazki
                  JOIN kategorie ON ksiazki.kategoria_id = kategorie.ID
                  WHERE ksiazki.tytul LIKE ? OR ksiazki.autor LIKE ? OR kategorie.nazwa LIKE ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sss", $search_parameter, $search_parameter, $search_parameter);
        $stmt->execute();
        return $stmt->get_result()->fetch_all();
    }

    public function deleteBook($title, $author): void
    {
        $query = "DELETE FROM ksiazki
                  WHERE tytul = ? AND autor = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $title, $author);
        $stmt->execute();
        $stmt->close();
    }
}