<?php
$patients = new patients();

if (isset($_GET['delete'])) {
    $deletePatient = new patients();
    $deletePatient->id = $_GET['delete'];
    $deletePatients = $deletePatient->deletePatientAndAppointments();
    HEADER('location:list-patients.php');
}
if (isset($_POST['search'])){
//pour sécuriser le formulaire contre les failles html
 $search = htmlspecialchars($_POST['search']);
 $search = trim($search); //pour supprimer les espaces dans la requête de l'internaute
 $search = strip_tags($search); //pour supprimer les balises html dans la requête
 $patientsList = $patients->patientSearch();
} else {
    $patientsList = $patients->listPatients();
}

$page = $patients->paginationPatients();
if (!empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $page){
    $_GET['page'] = intval($_GET['page']);
    $patients->id = (($_GET['page'] - 1) * 5);
    $patientsList = $patients->getPatientsForPaging();
} else {
    $patientsList = $patients->listPatients();
}

?>

