<?php

class patients {

    public $lastName = '';
    public $firstName = '';
    public $birthDate = '00/00/0000';
    Public $mail = '';
    public $phone = 0000000000;
    private $db;
    public $id = 0;
    public $patientsPerPage = 5;

    /**
     * Methode construct permettant la connection à la DB.
     */
    public function __construct() {
        try {
            // On se connecte à MySQL
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'levequem', 'dexter02');
        } catch (Exception $e) {
            // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * methode pour ajouter un patient à la DB
     * @return type
     */
    public function addPatient() {
        $query = $this->db->prepare('INSERT INTO `patients`(`lastname`, `firstname`, `birthdate`, `phone`, `mail`) VALUES (:lastname, :firstname , :birthdate , :phone , :mail)');
        $query->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $query->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $query->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $query->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $query->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $query->execute();
    }

    /**
     * methode pour afficher la liste des patients
     * @return type
     */
    public function listPatients() {
        $result = array();
        $query = 'SELECT `id`,`lastname`,`firstname`,DATE_FORMAT(`birthdate`,\'%d/%m/%Y\') AS `birthdate`,`phone`,`mail` FROM `patients` ORDER BY `lastname` ASC';
        $queryResult = $this->db->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * Methode pour afficher le profil du patient en fonction de l'id.
     * @return type
     */
    public function profilPatient() {
        $return = FALSE;
        $isOk = FALSE;
        $query = 'SELECT `id`,`lastname`,`firstname`, DATE_FORMAT(`birthdate`,\'%d/%m/%Y\') AS `birthdate`,`phone`,`mail` FROM `patients` WHERE `id`= :id';
        $queryResult = $this->db->prepare($query);
        //on associe notre marqueur nominatif :id a notre attribu id grâce au $this.
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        //si la requete c'est bien executé alors on rempli $returnArray avec un objet         
        if ($queryResult->execute()) {
            $return = $queryResult->fetch(PDO::FETCH_OBJ);
        }
        //si $return est un objet alors on hydrate       
        if (is_object($return)) {
            $this->lastname = $return->lastname;
            $this->firstname = $return->firstname;
            $this->birthdate = $return->birthdate;
            $this->phone = $return->phone;
            $this->id = $return->id;
            $this->mail = $return->mail;
            $isOk = TRUE;
        }
        return $isOk;
    }

    //methode pour modifier le profil d'un patient
    public function updatePatient() {
        $query = $this->db->prepare('UPDATE `patients` SET `lastname` =:lastname, `firstname` =:firstname, `birthdate` =:birthdate , `phone` =:phone, `mail` =:mail WHERE `id`= :id');
        $query->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $query->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $query->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $query->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $query->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $query->execute();
    }

    //méthode pour supprimer un patient et ses RDV
    public function deletePatientAndAppointments() {
        $result = array();
        $query = $this->db->prepare('DELETE FROM `patients` WHERE `id`=:id');
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($query->execute()) {
            $result = $query->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }

    //méthode pour recherche un patient
    public function patientSearch() {
        $result = array();
        $search = htmlspecialchars($_POST['search']);
        $search = strtolower($search);
        $query = $this->db->query('SELECT * FROM `patients` WHERE `firstname` LIKE "%' . $search . '%" OR `lastname` LIKE "%' . $search . '%"');
        if (is_object($query)) {
            $result = $query->fetchAll(PDO::FETCH_OBJ);
        } else {
            $message = "Vous devez entrer votre requete dans la barre de recherche";
        }
        return $result;
    }

    //méthode pour la pagination
    public function paginationPatients() {
        $query = 'SELECT COUNT(`id`) FROM `patients`';
        $patientsTotaleReq = $this->db->query($query)->fetchColumn();
        $patientsTotale = ceil($patientsTotaleReq / $this->patientsPerPage);
        return $patientsTotale;
    }

    public function getPatientsForPaging() {
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `phone`, `mail` 
                  FROM `patients`
                  ORDER BY `id` ASC LIMIT :page, ' . $this->patientsPerPage;
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':page', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        if (is_object($result)) {
            $this->id = $result->id;
        }
        return $result;
    }

}
