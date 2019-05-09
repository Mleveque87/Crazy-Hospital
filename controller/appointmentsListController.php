<?php
$appointments = new appointments();
$isDelete = false;
if (!empty ($_GET['idDelete'])){
    $appointments->id = htmlspecialchars($_GET['idDelete']);
    if ($appointments->deleteAppointment()){
        $isDelete = true;
    }
}
$appointmentsList = $appointments->listAppointments();
?>