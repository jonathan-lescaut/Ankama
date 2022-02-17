<?php
include '../header.php';


// si des données existe en POST['nameCategory'] je lance mon insersion en BDD
if (isset($_POST['nameCategory'])) {
    $nameCategory = $_POST['nameCategory'];

    $req = $pdo->prepare("INSERT INTO `categories`(`name`) VALUES (?)");
    $req->execute(array($nameCategory));
    header('Location:../admin.php');
}
?>