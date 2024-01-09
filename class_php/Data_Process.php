<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'Database.php';

class Data_Process extends Database
{

    /**
     * @throws Exception
     */
    public function processFormData($formData): void
    {
        $this->connect();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation'])) {
            switch ($_POST['operation']) {
                case "Ajouter":
                    $this->addProject($formData);
                    break;
                case "Supprimer":
                    $this->deleteProject();
                    break;
                case "Modifier":
                    echo "Modifier";
                    break;
                case "Afficher":
                    $this->Show_Project();
                    break;
                default:
                    echo "";
                    break;
            }
        }
    }

    private function addProject($formData): void
    {
        // Utilisez ces valeurs dans votre requête SQL
        $req_add = $this->connection->prepare("INSERT INTO projet(Nom,Description,langage,Collaborateur,Date_start,Date_End,Id_Theme) VALUES (?,?,?,?,?,?,?)");
        $req_add->execute(array(
            $formData['nom'],
            $formData['description'],
            $formData['langage'],
            $formData['collaborateur'],
            $formData['date_start'],
            $formData['date_end'],
            $formData['id_theme']
        ));
    }


    private function deleteProject(): void
    {
        if (isset($_POST['Choix_id'])) {
            $choixId = $_POST['Choix_id'];

            // Effectuez une requête pour vérifier si l'ID existe dans la base de données
            $query = "SELECT * FROM projet WHERE Id_Projet = :choixId";
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
        $req_delete = $this->connection->prepare("DELETE FROM projet WHERE Id_Projet = ?");
        $req_delete->execute([$choixId]);

        echo "Projet supprimé avec succès.";
    }



    private function Show_Project(): void
    {
        $req_show = $this->connection->prepare("SELECT * FROM projet");
        $req_show -> setFetchMode(PDO::FETCH_ASSOC);
        $req_show -> execute();
        $tab= $req_show->fetchALL();
        for ($i=0;$i<count($tab);$i++){
            echo $tab[$i]['Id_Projet']." ".$tab[$i]["Nom"]." ".$tab[$i]["Description"]." ".$tab[$i]["Langage"]." ".$tab[$i]["Collaborateur"]." ".$tab[$i]["Date_Start"]." ".$tab[$i]["Date_End"]." ".$tab[$i]["Id_theme"]."<br />";
        }
    }
}
