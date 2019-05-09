<?php
include '../model/patients.php';
include '../model/appointments.php';
include '../controller/profilController.php';

?>
<?php include('template/header.php') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <table class="table table-striped table-hover mt-5 mb-5">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Prénoms</th>
                        <th>Date de naissance</th>
                        <th>Téléphone</th>
                        <th>Mail</th>
                        <th>Modifier</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        if ($isPatient) {
                            ?>
                            <td><?= $patients->id ?></td>
                            <td><?= $patients->lastname ?></td>
                            <td><?= $patients->firstname ?></td>
                            <td><?= $patients->birthdate ?></td>
                            <td><?= $patients->phone ?></td>
                            <td><?= $patients->mail ?></td>
                            <td><a href="update-patient.php?id=<?= $patients->id ?>">Modifier</a>
                                <?php
                            } else {
                                ?>
                                <div class="bg-gradient-warning">Le patient n'a pas été trouvé!</div>
                                <?php
                            }
                            ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <table class="table table-striped table-hover table-sm mt-5">
                <thead class="thead-dark">
                    <tr>
                        <th>Rendez-vous</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointmentsListById as $appointments) { ?>
                        <tr>
                            <td><?= $appointments->date . ' ' . $appointments->hour ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('template/footer.php') ?>