<?php

class appointments {

    public $id = 0;
    public $dateHour = '0000/00/00 00:00:00';
    public $idPatients = 0;
    private $db;

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

    public function addAppointments() {
        $query = $this->db->prepare('INSERT INTO `appointments`(`dateHour`, `idPatients`) VALUES (:dateHour, :idPatients)');
        $query->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $query->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $query->execute();
    }
    
    /**
     * Cette méthode sert à verifier que le rendez vous n'est pas déja pris
     * @return type
     */
    public function checkFreeAppointment() {
        $result = FALSE;
        $query = 'SELECT COUNT(`id`) AS `takenAppointment` FROM `appointments` WHERE `dateHour`=:dateHour AND `idPatients`=:idPatients';
        $freeAppointment = $this->db->prepare($query);
        $freeAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $freeAppointment->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        if ($freeAppointment->execute()) {
            $resultObject = $freeAppointment->fetch(PDO::FETCH_OBJ);
            $result = $resultObject->takenAppointment;
        }
        return $result;
    }

    public function listAppointments() {
        $result = array();
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`, DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`, `appointments`.`id`, `patients`.`lastname`, `patients`.`firstname` FROM `appointments` LEFT JOIN `patients` ON `appointments`.`idPatients` = `patients`.`id` ORDER BY `patients`.`lastname`';
        $queryResult = $this->db->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    Public function getAppointmentById() {
        $return = FALSE;
        $isOk = FALSE;
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`, 
                         DATE_FORMAT(`appointments`.`dateHour`, "%Y-%m-%d") AS `dateUS`, 
                         DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`,
                         `appointments`.`id`,
                         `patients`.`lastname`,
                         `patients`.`firstname`,
                         `appointments`.`idPatients`,
                         `patients`.`mail`,
                         `patients`.`phone`,
                         `patients`.`birthdate`
                  FROM `appointments`
                  INNER JOIN `patients`
                  ON `appointments`.`idPatients` = `patients`.`id`
                  WHERE `appointments`.`id` = :idAppointment';
        $queryResult = $this->db->prepare($query);
        //on associe notre marqueur nominatif :id a notre attribu id grâce au $this.
        $queryResult->bindValue(':idAppointment', $this->id, PDO::PARAM_INT);
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
            $this->idPatients = $return->idPatients;
            $this->mail = $return->mail;
            $this->date = $return->date;
            $this->dateUS = $return->dateUS;
            $this->hour = $return->hour;
            $isOk = TRUE;
        }
        return $isOk;
    }

    public function updateAppointment() {
        $query = $this->db->prepare('UPDATE `appointments` SET `dateHour` =:dateHour, `idPatients`=:idPatients WHERE `id`= :idAppointement');
        $query->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $query->bindValue(':idAppointement', $this->id, PDO::PARAM_INT);
        $query->bindValue(':idPatients', $this->idPatients, PDO::PARAM_INT);
        return $query->execute();
    }
    
        //méthode pour avoir la liste des rdv du patient
    public function getListAppointmentByIdpatient() {
        $result = array();
        $query = 'SELECT `id`, DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`, 
                         DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`,
                         `idPatients` FROM `appointments`
                         WHERE `appointments`.`idPatients` = :idPatient';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':idPatient', $this->idPatient, PDO::PARAM_INT); 
        $queryResult->execute();
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }
    
    //méthode pour supprimer un RDV
    public function deleteAppointment(){
        $query='DELETE FROM `appointments` WHERE `id` = :id';
         $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT); 
        $result= $queryResult->execute();  
        return $result;
    }
}

?>