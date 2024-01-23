<?php

use JetBrains\PhpStorm\NoReturn;

require_once 'Database.php'; // récupération info connexion bdd

class Data_Process extends Database
{


    /**
     * @throws Exception
     */
    public function processFormData($formData): void      //fonction qui lance la bonne fonction en fonction du mode choisi
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
                                                // Choix du mode de modif (bêta)
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

    private function updateOrEnvoyer($formData): void            // fonction modif ou affichage dans input (bêta)
    {
        if (isset($_POST['envoyer'])) {                         //si bouton envoyer alors lancement fonction modif
            $this->updateProject($formData);
        } else {                                                    // début possibilité affichage dans input ( en cours)
            echo "ne fait rien c'est pour l'autre bouton afficher";
            // Logique pour le bouton "Envoyez"
            // ...
        }
    }



    #[NoReturn] public function addProject($formData): void
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
            echo $tab[$i]['Id_Projet'] . " "
                . $tab[$i]["Nom"] . " "
                . $tab[$i]["Description"] . " "
                . $tab[$i]["Langage"] . " "
                . $tab[$i]["Collaborateur"] . " "
                . $tab[$i]["Date_Start"] . " "
                . $tab[$i]["Date_End"] . " "
                . $tab[$i]["Id_theme"] . "<br />";
        }

    }





}
