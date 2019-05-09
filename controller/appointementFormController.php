<?php

$patients = new patients();
$patientsList = $patients->listPatients();

/**
 * 
 * @global type $errors
 * @param type $key
 * @return type
 */
function showError($key) {
    global $errors; //Récupère la variable $errors dans la portée globale
    return !empty($errors[$key]) ? '<div class="bg-danger">' . $errors[$key] . '</div>' : '';
}

// création des variables REGEX
$regexDate = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
$regexTime = '/(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';

$isSuccess = FALSE;

//Si je click sur valider et récupére le post submit
if (isset($_POST['submit'])) {
    if (!empty($_POST['date'])) {
        if (preg_match($regexDate, $_POST['date'])) {
            $date = htmlspecialchars((string) $_POST['date']);
        } else {
            $errors['date'] = "Votre date de rendez-vous est invalide.";
        }
    } else {
        //si vide, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
        $errors['date'] = "La date du rendez-vous ne peut être vide";
    }


    if (!empty($_POST['time'])) {
        if (preg_match($regexTime, $_POST['time'])) {
            $time = htmlspecialchars((string) $_POST['time']);
        } else {
            $errors['time'] = "L'heure du rendez-vous est invalide";
        }
    } else {
        //si vide, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
        $errors['time'] = "L'heure du rendez-vous ne peut être vide";
    }

    if (isset($_POST['idPatients']) && $_POST['idPatients'] != 0) {
        $idPatients = htmlspecialchars((int) $_POST['idPatients']);
    } else {
        $errors['idPatients'] = "Veuillez selectionner le patient";
    }

    if (empty($errors)) {
        $newAppointments = new appointments();
        $newAppointments->dateHour = $date . ' ' . $time;
        $newAppointments->idPatients = $idPatients;
        $chekAppointments = $newAppointments->checkFreeAppointment();
        if ($chekAppointments === '1') {
            $errors['checkAppointments'] = 'Ce rendez vous n\'est plus disponible';
        } else if ($chekAppointments === '0') {
            $isSuccess = $newAppointments->addAppointments();
            header('location:list-appointments.php');
        } else {
            $errors['checkAppointments'] = 'Une erreur est survenue, nous ne pouvons traiter votre demande';
        }
    }
}
