<?php
require_once 'Database.php';

class EditBlogProcess extends Database
{
    public function createBlog($Titre, $Contenu, $Date, $Id_Theme): void
    {
        $query = $this->connection->prepare("INSERT INTO blog (Titre, Contenu, Date, Id_Theme) VALUES (?, ?, ?, ?)");
        $query->execute([$Titre, $Contenu, $Date, $Id_Theme]);
    }

    public function updateBlog($blogId, $Titre, $Contenu, $Date, $Id_Theme): void
    {
        $query = $this->connection->prepare("UPDATE blog SET Titre = ?, Contenu = ?, Date = ?, Id_Theme = ? WHERE id = ?");
        $query->execute([$Titre, $Contenu, $Date, $Id_Theme, $blogId]);
    }

    public function deleteBlog($blogId): void
    {
        try {
            echo "test";
            $query = $this->connection->prepare("DELETE FROM blog WHERE Id_Blog = ?");
            $query->execute([$blogId]);
            echo "Blog supprimé avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du blog : " . $e->getMessage();
        }
    }


    public function getBlogById($blogId): array
    {
        $query = $this->connection->prepare("SELECT * FROM blog WHERE id = ?");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute([$blogId]);
        return $query->fetch();
    }

    public function getAllBlogs(): false|array
    {
        $query = $this->connection->prepare("SELECT * FROM blog");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

