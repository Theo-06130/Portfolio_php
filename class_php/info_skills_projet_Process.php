<?php
require_once 'Database.php';
#[AllowDynamicProperties] class info_skills_projet_Process
{


    public function __construct(Database $database)
    {
        $this->database = $database;
    }
    /**
     * @throws Exception
     */
    public function Show_project(): array
    {
        $query = $this->database->prepare("SELECT * FROM projet ORDER BY Date_End DESC");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        return $query->fetchAll();
        }


    /**
     * @throws Exception
     */
    public function Show_Skills(): false|array
    {
            $query = $this->database->prepare("SELECT * FROM competences ORDER BY Date_Learn DESC ");
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            return $query->fetchAll();

        }
}