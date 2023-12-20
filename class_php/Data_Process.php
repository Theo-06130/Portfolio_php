<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'Database.php';

class Data_Process extends Database
{

    /**
     * @throws Exception
     */
    public function processFormData($formData)
    {
        $this->connect();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation'])) {
            switch ($_POST['operation']) {
                case "Ajouter":
                    $this->addProject($formData);
                    break;
                case "Supprimer":
                    echo "Supprimer";
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

    private function Show_Project(){
        $req_show = $this->conn->prepare("SELECT * FROM projet");
        $req_show -> setFetchMode(PDO::FETCH_ASSOC);
        $req_show -> execute();
        $tab= $req_show->fetchALL();
        for ($i=0;$i<count($tab);$i++){
            echo $tab[$i]['Id_Projet']." ".$tab[$i]["Nom"]." ".$tab[$i]["Description"]." ".$tab[$i]["Langage"]." ".$tab[$i]["Collaborateur"]." ".$tab[$i]["Date_Start"]." ".$tab[$i]["Date_End"]." ".$tab[$i]["Id_theme"]."<br />";
        }
    }
}
