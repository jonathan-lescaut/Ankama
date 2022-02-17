<?php
include '../header.php';


// si des données existe en POST je lance mon insersion en BDD
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $image = "uploads/" . $_FILES["img"]["name"];;
        $price = $_POST['price'];
        $description = $_POST['description'];
        $cate = $_POST['idCategorie'];
        $statut = $_POST['statut'];


        $req = $pdo->prepare("INSERT INTO `products`(`name`, `image`, `price`, `description`, `idCategory`, `statut`) VALUES (?,?,?,?,?,?)");
        $req->execute(array($name, $image, $price, $description, $cate, $statut));
        
    }

    //----------------SYSTEME D'UPLOAD D'IMAGES----------------------/
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["img"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// On vérifie si le fichier image est une image réelle ou une fausse image
if(isset($_POST["submit"])) {
 $check = getimagesize($_FILES["img"]["tmp_name"]);
 if($check !== false) {
 echo "File is an image - " . $check["mime"] . ".";
 $uploadOk = 1;
 } else {
 echo "File is not an image.";
 $uploadOk = 0;
 }
}
// On vérifie si le fichier existe déjà
if (file_exists($target_file)) {
 echo "Désolé, ce fichier existe déjà.";
 $uploadOk = 0;
 }
// On vérifie la taille de l'image
if ($_FILES["img"]["size"] > 500000) {
 echo "Désolé, ce fichier dépasse la limite de taille autorisée.";
 $uploadOk = 0;
 }
// On vérifie le type de fichier
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
 echo "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
 $uploadOk = 0;
}
// On vérifie si $uploadOk est à 0 à cause d'une erreur
if ($uploadOk == 0) {
 echo "Désolé, votre fichier n'a pas été uploader";
 // Si tout est ok on essaye d'uploader le fichier
 } else {
 if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
 echo "Le fichier ". basename( $_FILES["img"]["name"]). " a bien été uploader."
;
 } else {
 echo "Sorry, there was an error uploading your file.";
 }
 }
//---------------------FIN SYSTEME D'UPLOAD D'IMAGES------------------------------/

header('Location:../admin.php');