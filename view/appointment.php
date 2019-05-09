<?php
include '../model/patients.php';
include '../model/appointments.php';
include '../controller/appointmentsDetail.php';
?>
<?php include('template/header.php') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 text-center mt-5">
            <h1> Informations du patient:</h1>
            <p><strong>Nom:</strong>: <?= $appointments->lastname ?></p>
            <p><strong>Prénom:</strong> <?= $appointments->firstname ?></p>
            <p><strong>Date de Naissance:</strong> <?= $appointments->birthdate ?></p>
            <p><strong>Téléphone:</strong> <?= $appointments->phone ?></p>
            <p><strong>Mail:</strong> <?= $appointments->mail ?></p>
        </div>
        <div class="col-md-6 text-center mt-5">
            <h1>Informations du rendez-vous:</h1>
            <p><strong>Date:</strong> <?= $appointments->date ?></p>
            <p><strong>Heure:</strong> <?= $appointments->hour ?></p> 
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-12 mb-5">
            <a class="nav-link" href="update-Appointment.php?id=<?= $appointments->id ?>">Modifier ce rendez-vous</a>
        </div>
    </div>
</div>
<?php include('template/footer.php') ?>