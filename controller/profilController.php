<?php
$isPatient = false;
$patients = new patients();
if (!empty($_GET['id'])) {
    $patients->id = htmlspecialchars($_GET['id']);
    $isPatient = $patients->profilPatient($_GET['id']);
}
$appointments = new appointments();
$appointments->idPatient = $patients->id;
$appointmentsListById = $appointments->getListAppointmentByIdpatient();
?>