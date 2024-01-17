<?php
require_once 'Database.php';

class EditBlogProcess extends Database
{
    /**
     * @throws Exception
     */
    public function processFormDataBlog($formData): void
    {
        $this->connect();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation'])) {
            switch ($_POST['operation']) {
                case "Ajouter":
                    $this->addBlog($formData);
                    break;
                case "Supprimer":
                    $this->deleteBlog();
                    break;
                case "Modifier":
                    // Traitement générique pour la modification
                    $this->updateOrEnvoyer($formData);
                    break;
                case "Afficher":
                    $this->Show_Blog();
                    break;
                default:
                    echo "";
                    break;
            }
        }
    }




    public function addBlog($formData): void
    {
        // Utilisez ces valeurs dans votre requête SQL
        $req_add = $this->connection->prepare("INSERT INTO blog(Titre, Contenu, Date, Id_Theme) VALUES (?, ?, NOW(), ?)");
        $req_add->execute(array(
            $formData['Titre'],
            $formData['Contenu'],
            !empty($formData['Id_Theme']) ? $formData['Id_Theme'] : null
        ));
    }




    private function updateOrEnvoyer($formData): void
    {
        if (isset($_POST['envoyer'])) {
            // Logique pour le bouton "Modifier"
            $this->updateBlog($formData);
        } else {
            echo "ne fait rien c'est pour l'autre bouton afficher";
            // Logique pour le bouton "Envoyez"
            // ...
        }
    }


    public function updateBlog($formData): void
    {
        $choixId = $_POST['Choix_id'];

        // Vérifier si l'ID existe dans la base de données
        $query = $this->connection->prepare("SELECT * FROM blog WHERE Id_Blog = ?");
        $query->execute([$choixId]);

        // Si l'ID existe, effectuer la mise à jour
        if ($query->rowCount() > 0) {
            $updateFields = [];
            $updateValues = [];

            // Construire dynamiquement les parties SET de la requête SQL
            foreach ($formData as $key => $value) {
                if (!empty($value) || $value === '0') {
                    // Ajouter le champ à la liste des champs à mettre à jour
                    $updateFields[] = "$key=?";
                    // Ajouter la valeur à la liste des valeurs à mettre à jour
                    $updateValues[] = $value;
                }
            }

            // Vérifier s'il y a des champs à mettre à jour
            if (!empty($updateFields)) {
                // Construire la requête SQL avec les parties SET dynamiquement générées
                $updateFieldsString = implode(', ', $updateFields);
                $req_update = $this->connection->prepare("UPDATE blog SET $updateFieldsString WHERE Id_Blog=?");

                // Ajouter l'ID à la fin des valeurs
                $updateValues[] = $choixId;

                // Afficher les valeurs mises à jour et la requête SQL complète
                echo "Valeurs mises à jour : " . implode(', ', $updateValues) . "<br />";
                echo "Requête SQL : " . $req_update->queryString . "<br />";

                if ($req_update->execute($updateValues)) {
                    echo "Blog mis à jour avec succès.";
                } else {
                    $errorInfo = $req_update->errorInfo();
                    echo "Erreur lors de la mise à jour du blog : " . $errorInfo[2];
                }
            } else {
                echo "Aucun champ à mettre à jour.";
            }
        } else {
            echo "L'ID $choixId n'existe pas dans la base de données.";
        }
    }






    public function deleteBlog(): void
    {
        if (isset($_POST['Choix_id'])) {
            $choixId = $_POST['Choix_id'];

            // Effectuez une requête pour vérifier si l'ID existe dans la base de données
            $query = "SELECT * FROM blog WHERE Id_Blog = :choixId";
            $statement = $this->connection->prepare($query);
            $statement->bindParam(':choixId', $choixId, PDO::PARAM_INT);
            $statement->execute();

            // Vérifiez si des résultats ont été obtenus
            if ($statement->rowCount() > 0) {
                // L'ID existe, vous pouvez maintenant exécuter la logique de suppression
                $this->performDelete($choixId);
            } else {
                // L'ID n'existe pas dans la base de données
                echo "La suppression a échoué, L'ID n'éxiste pas";
            }
        } else {
            echo "L'ID n'a pas été spécifié.";
        }
    }

    private function performDelete($choixId): void
    {
        // Logique de suppression ici (exécuter la requête DELETE)
        $req_delete = $this->connection->prepare("DELETE FROM blog WHERE Id_Blog = ?");
        $req_delete->execute([$choixId]);

        echo "Projet supprimé avec succès.";
    }



    public function Show_Blog(): void
    {
        $req_show = $this->connection->prepare("SELECT * FROM blog");
        $req_show->setFetchMode(PDO::FETCH_ASSOC);
        $req_show->execute();
        $tab = $req_show->fetchAll();

        for ($i = 0; $i < count($tab); $i++) {
            echo  htmlspecialchars($tab[$i]['Id_Blog'], ENT_QUOTES, 'UTF-8') . " "
                . htmlspecialchars($tab[$i]["Titre"], ENT_QUOTES, 'UTF-8') . " "
                . htmlspecialchars($tab[$i]["Contenu"], ENT_QUOTES, 'UTF-8') . " "
                . htmlspecialchars($tab[$i]["Date"], ENT_QUOTES, 'UTF-8') . " ";

            // Vérifiez si la clé "Id_theme" existe avant de l'afficher
            if (isset($tab[$i]["Id_Theme"])) {
                echo htmlspecialchars($tab[$i]["Id_Theme"], ENT_QUOTES, 'UTF-8') . " ";
            }

            echo "<br />";
        }
    }






}
