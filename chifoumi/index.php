<?php session_start(); ?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Chifoumi</title>
</head>

<body>

    <?php include 'fight.php'; ?>


    <div class="container-fluid">
        <!-- AFFICHAGES DES COMMENTAIRES PENDANT LA PARTIE DE CHIFOUMI -->
        <div class="row"><?php
                            if (isset($debut)) {
                                echo $debut;
                            }
                            if (isset($victoire)) {
                                echo $victoire;
                            }
                            if (isset($defaite)) {
                                echo $defaite;
                            }
                            if (isset($vicProche)) {
                                echo $vicProche;
                            }
                            if (isset($defProche)) {
                                echo $defProche;
                            }
                            if (isset($egal)) {
                                echo $egal;
                            }
                            ?></div>

        <div class="row RowGame blocGame">
            <div class="col-md-2 perso persoU">

                <!-- perso et compteur de victoire de l'utilisateur -->
                <img src="img/toi.png" alt="toi">
            </div>
            <div class="col-md-1 compteurs comptV">Victoires <?php if (isset($_SESSION['counterW'])) {
                                                                    echo $_SESSION['counterW'];
                                                                } ?></div>

            <div class="col-md-6">
                <form action="" method="get">
                    <div class="container-fluid gameChifoumi">
                        <div class="row">
                            <div class="col-md-4 blocPetiteImg">
                                <button class="petiteImg" type="submit" name="game" value="la pierre"><img src="img/pierre.png" alt="pierre" /></button>
                            </div>
                            <div class="col-md-4 blocPetiteImg">
                                <button class="petiteImg" type="submit" name="game" value="la feuille"><img src="img/feuille.png" alt="feuille" /></button>
                            </div>
                            <div class="col-md-4 blocPetiteImg">
                                <button class="petiteImg" type="submit" name="game" value="les ciseaux"><img src="img/ciseaux.png" alt="ciseaux" /></button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 explications">Cliquer sur pierre feuille ou ciseaux</div>
                    </div>


                </form>


            </div>

            <!-- perso et compteur de victoire du boot -->
            <div class="col-md-1 compteurs">Ordinateur <?php if (isset($_SESSION['counterL'])) {
                                                            echo $_SESSION['counterL'];
                                                        } ?></div>
            <div class="col-md-2 perso"><img src="img/boot.png" alt="boot"></div>




        </div>
    </div>

    <!-- Gestion des messages sur les images de p f ciseaux coté utilisateur -->
    <?php if (isset($imgGamer)) { ?>
        <div class="container-fluid battle">
            <div class="row sm">
                <div class='col-md-5 com'><?= $commentaire ?></div>
            </div>
            <div class="row figth">
                <div class="col-md-5 gamer">
                    <div class="row">
                        <div class="col-md-12 blocFight">
                            <img src="img/<?= $imgGamer ?>" alt="img gamer" class="image">
                            <div class='messageLeft'>
                                <?php if ($win === 'w') {
                                    echo 'WIN';
                                } elseif ($win === 'e') {
                                    echo 'Egalité';
                                } elseif ($win === 'jouer') {
                                    echo "<div class='debut'>Vous</div>";
                                } else {
                                    echo 'LOOSE';
                                } ?>

                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-md-2 details">
                    <form action="" method="get">

                        <!-- le compteurs des égalités pendant la partie de chifoumi -->
                        <div class="compteurGame">
                            <div class='comptEgalite'><span>Egalités <?php if (isset($_SESSION['egalite'])) {
                                                                            echo $_SESSION['egalite'];
                                                                        } ?></span></div>
                        </div>
                        <form action="" method="get">

                            <!-- le compteur des parties gagnées et perdu, une partie gagné par default à 3  ($scoreVictoire = 3)-->
                            <div class="blocParties">
                                <div class='truc'>Parties gagnées <?php if (isset($_SESSION['gameW'])) {
                                                                        echo $_SESSION['gameW'];
                                                                    } else {
                                                                        echo '0';
                                                                    } ?></div>
                                <div class='truc'>Parties perdues <?php if (isset($_SESSION['gameL'])) {
                                                                        echo $_SESSION['gameL'];
                                                                    } else {
                                                                        echo '0';
                                                                    } ?></div>

                            </div>
                            <input class='reset' type="submit" value="Repartir à Zéro" name="resetTotal">
                        </form>
                </div>

                <div class="col-md-5 boot">

                    <div class="row">
                        <div class="col-md-12 blocFight">
                            <img src="img/<?= $imgBoot ?>" alt="img boot" class="imageBoot">
                            <!-- gestion des messages sur les image de p f ciseaux coté Boot -->
                            <div class='col-md-12 messageRigth'>
                                <?php if ($win === 'l') {
                                    echo 'WIN';
                                } elseif ($win === 'e') {
                                    echo 'Egalité';
                                } elseif ($win === 'jouer') {
                                    echo "<div class='debut'>Ordinateur</div>";
                                } else {
                                    echo 'LOOSE';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="../index.php" type="button" class="btn btn-secondary">Quitter</a>



    <?php } ?>



</body>

</html>