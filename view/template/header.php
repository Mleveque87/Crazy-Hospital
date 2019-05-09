<?php ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="PDO Partie 2 Hospital"/>
        <meta name="author" content="Leveque Matthieu"/>
        <title>PDO Partie 2 Hospital</title>
        <!-- main core CSS -->
        <link href="assets/css/main.css" rel="stylesheet"/>
        <!-- Bootstrap core CSS -->
        <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    </head>
    <body>
        <header>
            <div class="banniereHeader" id="banniereHeader">
                <img src="assets/img/banniere.jpg" alt="banniere"/>
            </div>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="#">
                    <img src="assets/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    Crazy Hospital
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="add-patient.php">Ajouter un patient</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="add-appointments.php">Ajouter un rendez-vous</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="list-patients.php?page=1">Liste des patients</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="list-appointments.php">Liste des rendez-vous</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

