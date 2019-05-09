<?php

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
$lastNameReg = '/^[\w\-]{3,30}$/'; //^[a-zA-Z]{3,30}$/';
$firstNameReg = '/^[\w\-]{3,30}$/';
$emailReg = '/^[^\s@]+@[^\s@]+\.[^\s@]{2,3}$/'; //^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
$phoneReg = '/^[0-9][0-9\/]{0,13}[0-9][0-9\/]{3}/';

//Si je click sur valider et récupére le post submit
if (isset($_POST['submit'])) {
    //VERIFICATION LASTNAME
    //vérification si le post lastName existe
    if (isset($_POST['lastName'])) {
        //vérification si le post lastName est différent de vide
        if (!empty($_POST['lastName'])) {
            //vérification du post lastName avec la regex
            if (preg_match($lastNameReg, $_POST['lastName'])) {
                //si oui je créer la variable $lastName avec la protection htmlspecialchars pour empecher la saisie de balises HTML ainsi que les caractères non autorisé par l'encodage
                $lastName = htmlspecialchars((string) $_POST['lastName']);
            } else {
                //si pas de correspondance avecla regex, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
                $errors['lastName'] = "Le nom ne doit contenir que des lettres majuscule et minuscule entre 3 et 30 caractères";
            }
        } else {
            //si vide, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
            $errors['lastName'] = "Le nom ne peut être vide";
        }
    }
    //VERIFICATION FIRSTNAME
    //vérification si le post lastName existe
    if (isset($_POST['firstName'])) {
        //verification si le post firstName est différent de vide
        if (!empty($_POST['firstName'])) {
            //vérification du post firstName avec la regex
            if (preg_match($firstNameReg, $_POST['firstName'])) {
                //si oui je créer la variable $firstName avec la protection htmlspecialchars pour empecher la saisie de balises HTML ainsi que les caractères non autorisé par l'encodage
                $firstName = htmlspecialchars((string) $_POST['firstName']);
            } else {
                //si pas de correspondance avecla regex, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
                $errors['firstName'] = "Le prénom ne doit contenir que des lettres majuscule et minuscule entre 3 et 30 caractères";
            }
        } else {
            //si vide, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
            $errors['firstName'] = "Le prénom ne peut être vide";
        }
    }
    //VERIFICATION BIRTHDATE
    //vérification si le post birthDate existe
    if (isset($_POST['birthDate'])) {
        //verification si le post birthDate est différent de vide 
        if (!empty($_POST['birthDate'])) {
            //si oui je créer la variable $birthDate avec la protection htmlspecialchars pour empecher la saisie de balises HTML ainsi que les caractères non autorisé par l'encodage
            $birthDate = htmlspecialchars((string) $_POST['birthDate']);
        } else {
            //si vide, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
            $errors['birthDate'] = "La date de naissance ne peut être vide";
        }
    }
    //VERIFICATION EMAIL
    //vérification si le post email existe
    if (isset($_POST['email'])) {
        //verification si le post email est différent de vide       
        if (!empty($_POST['email'])) {
            //vérification du post avec la regex
            if (preg_match($emailReg, $_POST['email'])) {
                //si oui je créer la variable £email avec la protection htmlspecialchars pour empecher la saisie de balises HTML ainsi que les caractères non autorisé par l'encodage
                $email = htmlspecialchars((string) $_POST['email']);
            } else {
                //si pas de correspondance avecla regex, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
                $errors['email'] = "Veuillez saisir une adresse mail valide. Ex: xxxxx@xxxxx.xx";
            }
        } else {
            //si vide, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
            $errors['email'] = "L'adresss Email ne peut être vide";
        }
    }
    //VERIFICATION PHONE
    //vérification si le post phone existe 
    if (isset($_POST['phone'])) {
        //verification si le post phonr est différent de vide 
        if (!empty($_POST['phone'])) {
            //vérification du post avec la regex
            if (preg_match($phoneReg, $_POST['phone'])) {
                //si oui je créer la variable £email avec la protection htmlspecialchars pour empecher la saisie de balises HTML ainsi que les caractères non autorisé par l'encodage
                $phone = htmlspecialchars((string) $_POST['phone']);
            } else {
                //si pas de correspondance avecla regex, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
                $errors['phone'] = "Veuillez saisir un numéro de téléphone à 10 numéros.";
            }
        } else {
            //si vide, j'indique une erreur dans mon tableau d'erreurs et affiche le message correspondant
            $errors['phone'] = "Le numéro de téléphone ne peut être vide";
        }
    }
    //Si aucune erreur dans mon tableau d'erreur alors j'instencie mon objet patients. 
    //$newPatient devient une instance de la classe patients.
    //la methode magique construct est appelée automatiquement 
    //grace au mot clé new.
    if (empty($errors)) {
        $newPatient = new patients;
        $newPatient->lastname = $lastName;
        $newPatient->firstname = $firstName;
        $newPatient->birthdate = $birthDate;
        $newPatient->phone = $phone;
        $newPatient->mail = $email;
        $newPatient->addPatient();
        header('location:list-patients.php');
    }
}
?>