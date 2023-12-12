<?php

require_once 'Database.php';

class Data_Process extends Database
{
    public function processFormData($formData)
    {
        $this->connect();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation'])) {
            switch ($_POST['operation']) {
                case "Ajouter":
                    echo "Ajouter";
                    $this->addProject($formData);
                    break;
                case "Supprimer":
                    echo "Supprimer";
                    break;
                case "Modifier":
                    echo "Modifier";
                    break;
                case "Afficher":
                    echo "Afficher";
                    break;
                default:
                    echo "";
                    break;
            }
        }
    }

    private function addProject($formData)
    {
        // Utilisez ces valeurs dans votre requête SQL
        $req_add = $this->conn->prepare("INSERT INTO projet(Nom,Description,langage,Collaborateur,Date_start,Date_End,Id_Theme) VALUES (?,?,?,?,?,?,?)");
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
}
