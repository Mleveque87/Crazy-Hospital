<?php
include '../model/patients.php';
include '../controller/patientListController.php'
?>
<?php include('template/header.php') ?>
<div class="row">
    <div class="col-md-12 text-center">
        <form class="mt-3" action="list-patients.php" method="POST">
            <input type="search" name="search">
            <input class="btn btn-outline-primary" type="submit" name="submit" value ="Rechercher">
        </form>
        <table class="table table-striped table-hover table-sm mt-5">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Fiche du patient</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patientsList as $patient) { ?>
                    <tr>
                        <td><?= $patient->id ?></td>
                        <td><?= $patient->lastname ?></td>
                        <td><?= $patient->firstname ?></td>
                        <td><a href="profil-patient.php?id=<?= $patient->id ?>">détail</a></td>
                        <td><a href="list-patients.php?delete=<?= $patient->id ?>" type="button" class="btn btn-danger">Supprimer</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <nav aria-label="...">
            <ul class="pagination pagination-sm justify-content-center">
                <?php
                for ($i = 1; $i <= $page; $i++) :
                    isset($_GET['page']) ? $_GET['page'] : $_GET['page'] = 1;
                    if ($_GET['page'] != $i) :
                        ?>
                        <li class="page-item"><a class="page-link text-danger" href="list-patients.php?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php
                    else :
                        ?>
                        <li class="page-item disabled page-link text-dark"> <?= $i ?></li>
                    <?php
                    endif;
                endfor;
                ?>
            </ul>
        </nav>
    </div>
</div>
<div class="row text-center">
    <div class="col-md-12 mb-5">
        <a class="nav-link" href="add-patient.php">Ajouter un patient</a>
    </div>
</div>
<?php include('template/footer.php') ?>