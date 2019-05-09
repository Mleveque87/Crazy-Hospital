<?php
include '../model/patients.php';
include '../controller/formController.php';
?>
<?php include('template/header.php') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center mt-5 mb-5">
            <form name="form" method="POST" action="add-patient.php" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="lastname">Nom</label>
                        <input type="text" class="form-control" value="<?= isset($lastName) ? $lastName : '' ?>" name="lastName" placeholder="Votre Nom"/>
                        <?= showError('lastName') ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="firstname">Prénom</label>
                        <input type="text" class="form-control" value="<?= isset($firstName) ? $firstName : '' ?>" name="firstName" placeholder="Votre prénom"/>
                        <?= showError('firstName') ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="birthdate">Date de Naissance</label>
                        <input type="date" class="form-control" value="<?= isset($birthDate) ? $birthDate : '' ?>" name="birthDate" placeholder="Votre date de naissance"/>
                        <?= showError('birthDate') ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" value="<?= isset($email) ? $email : '' ?>" name="email" placeholder="Votre adresse email"/>
                        <?= showError('email') ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="phone">Téléphone</label>
                        <input type="tel" class="form-control" type="tel" data-country="FR" value="<?= isset($phone) ? $phone : '' ?>" name="phone" placeholder="Votre numéro de téléphone"/>
                        <?= showError('phone') ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" value="valider" name="submit">Valider</button>
            </form>
        </div>
    </div>
</div>
<?php include('template/footer.php') ?>