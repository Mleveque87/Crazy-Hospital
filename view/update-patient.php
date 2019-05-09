<?php
include '../model/patients.php';
include '../controller/updatePatientController.php';
?>
<?php include('template/header.php') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <form name="form" method="POST" action="update-patient.php?id=<?= $patients->id ?>" enctype="multipart/form-data">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
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
                                <td><input type="text" class="form-control" title="<?= $patients->lastname ?>" value="<?= $patients->lastname ?>" name="lastName" placeholder="<?= $patients->lastname ?>"/>
                                    <?= showError('lastName') ?></td>
                                <td><input type="text" class="form-control" title="<?= $patients->firstname ?>" value="<?= $patients->firstname ?>" name="firstName" placeholder="<?= $patients->firstname ?>"/>
                                    <?= showError('firstName') ?></td>
                                <td><input type="date" class="form-control" title="<?= $patients->birthdate ?>" value="<?= $patients->birthdate ?>" name="birthDate" placeholder="<?= $patients->birthdate ?>"/>
                                    <?= showError('birthDate') ?></td>
                                <td><input type="tel" class="form-control" title="<?= $patients->phone ?>" type="tel" data-country="FR" value="<?= $patients->phone ?>" name="phone" placeholder="<?= $patients->phone ?>"/>
                                    <?= showError('phone') ?></td>
                                <td><input type="email" class="form-control" title="<?= $patients->mail ?>" value="<?= $patients->mail ?>" name="email" placeholder="<?= $patients->mail ?>"/>
                                    <?= showError('email') ?></td>
                                <td><button type="submit" class="btn btn-primary" value="valider" name="submit">Valider</button></td>
                                <?php
                            } else {
                                ?>
                        <div class="danger">Le patient n'a pas été trouvé!</div>
                        <?php
                    }
                    ?>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include('template/footer.php') ?>
