<?php
$appointments = new appointments();
if (!empty ($_GET['id'])){
    $appointments->id = htmlspecialchars($_GET['id']);
}

$appointments->updateAppointment();

$patients = new patients();
$patientsList = $patients->listPatients();

function showError($key) {
    global $errors; //Récupère la variable $errors dans la portée globale
    return !empty($errors[$key]) ? '<div class="bg-danger">' . $errors[$key] . '</div>' : '';
}

// création des variables REGEX
$regexDate = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
$regexTime = '/(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';

if (isset($_POST['submit'])) {
    //VERIFICATION date
    //vérification si le post date existe
    if (isset($_POST['date'])) {
        //vérification si le post date est différent de vide
        if (!empty($_POST['date'])) {
            //vérification du post date avec la regex
            if (preg_match($regexDate, $_POST['date'])) {
                //si oui je créer la variable $date avec la protection htmlspecialchars pour empecher la saisie de balises HTML ainsi que les caractères non autorisé par l'encodage
                $date = htmlspecialchars((string) $_POST['date']);
            } else {
                //si pas de correspondance avecla regex, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
                $errors['date'] = "La date saisie n'est pas valide";
            }
        } else {
            //si vide, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
            $errors['date'] = "La date ne peut être vide";
        }
    }
    if (isset($_POST['hour'])) {
        //VERIFICATION hour
        //vérification si le post hour existe
        if (isset($_POST['hour'])) {
            //vérification si le post hour est différent de vide
            if (!empty($_POST['hour'])) {
                //vérification du post lastName avec la regex
                if (preg_match($regexTime, $_POST['hour'])) {
                    //si oui je créer la variable $hour avec la protection htmlspecialchars pour empecher la saisie de balises HTML ainsi que les caractères non autorisé par l'encodage
                    $time = htmlspecialchars((string) $_POST['hour']);
                } else {
                    //si pas de correspondance avecla regex, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
                    $errors['hour'] = "L'heure n'est pas valide";
                }
            } else {
                //si vide, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
                $errors['hour'] = "L'heure ne peut être vide";
            }
        }
    }
    
    if (isset($_POST['idPatients']) && $_POST['idPatients'] != 0) {
        $idPatients = htmlspecialchars((int) $_POST['idPatients']);
    } else {
        $errors['idPatients'] = "Veuillez selectionner le patient";
    }

    if (empty($errors)) {
        $appointments = new appointments();
        $appointments->id = $_GET['id'];
        $appointments->dateHour = $date . ' ' . $time;
        $appointments->idPatients = $idPatients;
        $appointments->updateAppointment();
        header('location:list-appointments.php?');
    }
}
$appointmentDetail = $appointments->getAppointmentById();
?>
