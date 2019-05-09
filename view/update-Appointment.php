<?php
include '../model/patients.php';
include '../model/appointments.php';
include '../controller/appointmentsDetail.php';
?>
<?php include('template/header.php') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 text-center py-4">
            <h1> Informations du patient:</h1>
                <p><strong>Nom:</strong> <?= $appointments->lastname ?></p>
                <p><strong>Prénom:</strong> <?= $appointments->firstname ?></p>
                <p><strong>Date de Naissance:</strong> <?= $appointments->birthdate ?></p>
                <p><strong>Téléphone:</strong> <?= $appointments->phone ?></p>
                <p><strong>Mail:</strong> <?= $appointments->mail ?></p>
        </div>
        <div class="col-md-6 text-center py-4">
            <h1>Informations du rendez-vous:</h1>
            <form name="form" method="POST" action="update-Appointment.php?id=<?= $appointments->id ?>" enctype="multipart/form-data">
                <label for="idPatients">Nom du patient</label>
                <select name="idPatients" class="form-control">
                    <?php foreach ($patientsList as $patient) { ?>
                        <!-- Si l'id du rdv existe et que l'id du patient est égale à l'id patient du rdv alors je rajoute l'attribut selected  -->
                        <option value="<?= $patient->id ?>" <?= isset($appointments->idPatients) && ($patient->id == $appointments->idPatients) ? 'selected' : '' ?>><?= $patient->lastname . ' ' . $patient->firstname ?></option>
                    <?php } ?>
                </select>
                <?= showError('idPatients') ?>
                <p><strong>Date:</strong><input type="date" class="form-control" title="<?= $appointments->dateUS ?>" value="<?= $appointments->dateUS ?>" name="date" placeholder="<?= $appointments->date ?>"/>
                    <?= showError('date') ?></p>
                <p><strong>Heure:</strong><input type="time" class="form-control" title="<?= $appointments->hour ?>" value="<?= $appointments->hour ?>" name="hour" placeholder="<?= $appointments->hour ?>"/>
                    <?= showError('hour') ?></p>
                <button type="submit" class="btn btn-primary mt-3" value="valider" name="submit">Valider</button>
            </form>
        </div>
    </div>
</div>
<?php include('template/footer.php') ?>