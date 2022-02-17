<?php include 'connexionPDO.php';
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- icon -->
  <script src="https://kit.fontawesome.com/7e0395d74b.js" crossorigin="anonymous"></script>
  <!-- Bootsrap 4 CDN-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
  <!--styles-->
  <link rel="stylesheet" href="css/style.css">
  <title>Ankama</title>
</head>

<body>
  <!-- navigation -->
  <header>
    <nav id="accueil" class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="logo" class="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="boutique.php">Boutique</a>
          <a class="nav-item nav-link" href="panier.php">Mon panier</a>
          <?php if (!empty($_SESSION)) { ?>
          <a class="nav-item nav-link" href="compte.php">Mon compte</a>
          <?php }?>

          <?php if (isset($_SESSION['statutUser'])) { ?>
            <?php if ($_SESSION['statutUser'] === 'admin') { ?>
              <a class="nav-item nav-link" href="Admin/adminHeader.php">Administration</a>
            <?php } ?>
          <?php } ?>


          <?php if (!empty($_SESSION)) { ?>
            <a class="nav-item nav-link" href="deconnexion.php">Déconnexion</a>
          <?php } else { ?>
            <a class="nav-item nav-link" href="connexion.php">Connexion</a>
            <a class="nav-item nav-link" href="inscription.php">Inscription</a>
          <?php } ?>
        </div>
      </div>
    </nav>
  </header>

  <!-- <nav>
    <div class="container-fluid">
      <div class="row ">
        <div class="col-md-4">
          <div class="row-md-6 lienNav"><a href="boutique.php">Boutique</a></div>

          <?php
          $ma_chaine = $_SERVER['PHP_SELF'];
          $trouve_moi  = 'boutique.php';
          $position = strpos($ma_chaine, $trouve_moi);
          if ($position === false) { ?>
            <div class="row-md-6 formNav">
              <a href="index.php">Accueil</a>
            </div>
          <?php } else { ?>
            <div class="row-md-3 formNav">
              <a href="panier.php">Panier</a>
            </div>
        </div>
        <div class="row-md-3 formNav">
          <a href="index.php">Accueil</a>
        </div>
      </div>
    <?php } ?>

    </div>
    <div class="col-md-4">
      <img class="imgLogo" src="img/logo.png" alt="logo">
    </div>
    <div class="col-md-4">
      <div class="row-md-6 lienNav"><?php

                                    if (isset($_SESSION['pseudo'])) {
                                      if ($_SESSION['statutUser'] === 'admin') { ?>
            <div><a href="Admin/adminHeader.php">Administration</a>
              <div>
                <div class="bonjour">Bonjour,<?= " " . $_SESSION['pseudo'] ?></div>
              <?php }
                                      if ($_SESSION['statutUser'] === NULL) { ?>
                <div class="bonjour">Bonjour,<?= " " . $_SESSION['pseudo'] ?></div>
              <?php }
                                    } else { ?>
              <a href="connexion.php">Connexion</a>
              </div>

            <?php } ?>

            <div class="row-md-6 formNav"><?php if (isset($_SESSION['pseudo'])) {
                                            echo '<a href="deconnexion.php">Déconnexion</a>';
                                          } else {
                                            echo '<a href="inscription.php">Inscription</a>';
                                          } ?></div>
            </div>
      </div>
    </div> -->
  </nav>

  <!-- fin de navigation -->