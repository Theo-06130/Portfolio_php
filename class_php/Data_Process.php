<?php
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
                    // Traitement générique pour la modification
                    $this->updateOrEnvoyer($formData);
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

    private function updateOrEnvoyer($formData): void
    {
        if (isset($_POST['envoyer'])) {

            // Logique pour le bouton "Modifier"
            $this->updateProject($formData);
        } else {
            echo "ne fait rien c'est pour l'autre bouton afficher";
            // Logique pour le bouton "Envoyez"
            // ...
        }
    }



    public function addProject($formData): void
    {
        // Utilisez ces valeurs dans votre requête SQL
        $req_add = $this->connection->prepare("INSERT INTO projet(Nom, Description, Langage, Collaborateur, Date_start, Date_End, Id_Theme) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $req_add->execute(array(
            $formData['nom'],
            $formData['description'],
            $formData['langage'],
            $formData['collaborateur'],
            $formData['date_start'],
            $formData['date_end'],
            !empty($formData['id_theme']) ? $formData['id_theme'] : null // Assurez-vous que la valeur est valide ou NULL
        ));

        // Redirection après l'ajout
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }



    public function updateProject($formData): void
    {
        $choixId = $_POST['Choix_id'];

        // Vérifier si l'ID existe dans la base de données
        $query = $this->connection->prepare("SELECT * FROM projet WHERE Id_Projet = ?");
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

            // Construire la requête SQL avec les parties SET dynamiquement générées
            $updateFieldsString = implode(', ', $updateFields);
            $req_update = $this->connection->prepare("UPDATE projet SET $updateFieldsString WHERE Id_Projet=?");
            $updateValues[] = $choixId; // Ajouter l'ID à la fin des valeurs

            $req_update->execute($updateValues);

            echo "Projet mis à jour avec succès.";
        } else {
            echo "L'ID $choixId n'existe pas dans la base de données.";
        }
    }




    public function deleteProject(): void
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



    public function Show_Project(): void
    {
        $req_show = $this->connection->prepare("SELECT * FROM projet");
        $req_show->setFetchMode(PDO::FETCH_ASSOC);
        $req_show->execute();
        $tab = $req_show->fetchAll();

        for ($i = 0; $i < count($tab); $i++) {
            echo  htmlspecialchars($tab[$i]['Id_Projet'], ENT_QUOTES, 'UTF-8') . " "
                . htmlspecialchars($tab[$i]["Nom"], ENT_QUOTES, 'UTF-8') . " "
                . htmlspecialchars($tab[$i]["Description"], ENT_QUOTES, 'UTF-8') . " "
                . htmlspecialchars($tab[$i]["Langage"], ENT_QUOTES, 'UTF-8') . " "
                . htmlspecialchars($tab[$i]["Collaborateur"], ENT_QUOTES, 'UTF-8') . " "
                . htmlspecialchars($tab[$i]["Date_Start"], ENT_QUOTES, 'UTF-8') . " "
                . htmlspecialchars($tab[$i]["Date_End"], ENT_QUOTES, 'UTF-8') . " "
                . htmlspecialchars($tab[$i]["Id_theme"], ENT_QUOTES, 'UTF-8') . "<br />";
        }
    }





}
