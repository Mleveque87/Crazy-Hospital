<?php 
include '../model/appointments.php';
include '../model/patients.php';
include '../controller/appointementFormController.php';
?>
<?php include('template/header.php') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center mt-5 mb-5">
            <?= showError('checkAppointments') ?>
            <form name="form" method="POST" action="add-appointments.php" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="date">Date du rendez-vous</label>
                        <input type="date" class="form-control" value="<?= isset($date) ? $date : '' ?>" name="date" placeholder="Date du rendez-vous">
                        <?= showError('date') ?>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="time">Heure du rendez-vous</label>
                        <input type="time" class="form-control" value="<?= isset($time) ? $time : '' ?>" name="time" placeholder="Heure du rendez-vous" min="08:00" max="20:00">
                        <?= showError('time') ?>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="idPatients">Nom du patient</label>
                        <select name="idPatients" class="form-control">
                            <option value="0">Choisix du patient</option>
                            <?php foreach ($patientsList as $patient){?>
                            <option value="<?=$patient->id?>"><?=$patient->lastname.' '.$patient->firstname?></option>
                            <?php } ?>
                        </select>
                        <?= showError('idPatients') ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" value="valider" name="submit">Valider</button>
            </form>
        </div>
    </div>
</div>
<?php include('template/footer.php') ?>