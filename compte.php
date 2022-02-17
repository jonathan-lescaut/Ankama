<?php
include 'header.php';

//Update User ==================================================================================================================


if (isset( $_SESSION['id'])) {
    $idUser =  $_SESSION['id'];
    $req = $pdo->prepare("SELECT * FROM `users` WHERE `Id_USERS` = $idUser");
    $req->execute();
    $result4 = $req->fetch(); 


if (isset($_POST['pseudo'])) {
    $reqPseudo = $_POST['pseudo'];
    $reqEmail = $_POST['email'];
    $reqAdresse = $_POST['adresse'];
    $reqVille = $_POST['ville'];
    
    //On prépare la requête et on l'exécute
    $sth = $pdo->prepare("UPDATE `users` SET `pseudo`=:pseudo, `email`=:email,`adresse`=:adresse,`ville`=:ville WHERE `Id_USERS` = $idUser");
    $sth->execute(array(
        ':pseudo' => $reqPseudo ,
        ':email' => $reqEmail,
        ':adresse' => $reqAdresse,
        ':ville' => $reqVille,
        
    ));
    header('Location:compte.php');
    }
    
} ?>
<!-- formulaire rempli catégories -->
<h2 class="titreBoutique2">Mes informations</h2>
    <form action="cpmpte.php" method="post">
        <div class="form-row">
                <label>Pseudo</label>
                <input type="text" value="<?= $result4['pseudo'] ?>" class="form-control formCompte" name="pseudo">
                <label>Email</label>
                <input type="text" value="<?= $result4['email'] ?>" class="form-control formCompte" name="email">
                <label>Adresse</label>
                <input type="text" value="<?= $result4['adresse'] ?>" class="form-control formCompte" name="adresse">
                <label>Ville</label>
                <input type="text" value="<?= $result4['ville'] ?>" class="form-control formCompte" name="ville">
        <button type="submit" class="btn btn-primary formCompte">Envoyer</button>
    </form>