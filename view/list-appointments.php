<?php
include '../model/appointments.php';
include '../model/patients.php';
include '../controller/appointmentsListController.php';
?>
<?php include('template/header.php') ?>
<div class="row">
    <div class="col-md-12 text-center">
        <?php
        if (isset($_GET['idDelete'])) {
            if ($isDelete) {
                ?>
                <p class="text-success">Le rendez-vous a bien été supprimé</p>
            <?php } else { ?>
                <p class="text-danger">Une erreur est survenue. Le rendez-vous n'a pas été supprimé</p>
                <?php
            }
        }
        ?>
        <table class="table table-striped table-hover table-sm mt-5">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Date / Heure</th>
                    <th>Nom du patient</th>
                    <th>informations rendez-vous</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointmentsList as $appointments) { ?>
                    <tr>
                        <td><?= $appointments->id ?></td>
                        <td><?= $appointments->date . ' ' . $appointments->hour ?></td>
                        <td><?= $appointments->lastname . ' ' . $appointments->firstname ?></td>
                        <td><a href="appointment.php?id=<?= $appointments->id ?>">détail</a></td>
                        <td><a href="update-Appointement.php?id=<?= $appointments->id ?>">Modifier</a></td>
                        <td><a href="list-appointments.php?idDelete=<?= $appointments->id ?>" type="button" id="delete" name="delete" class="btn btn-danger">Supprimer</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row text-center">
    <div class="col-md-12 mb-5">
        <a class="nav-link" href="add-appointments.php">Ajouter un rendez-vous</a>
    </div>
</div>
<?php include('template/footer.php') ?>