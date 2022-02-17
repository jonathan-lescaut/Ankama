<?php
include 'adminHeader.php';

if (isset($_GET['update'])) {
    $idproduct = $_GET['update'];
    $req = $pdo->prepare("SELECT `name`, `image`, `price`, `description`, `idCategory`, statut FROM `products` WHERE `Id_PRODUCTS` = $idproduct");
    $req->execute();
    $result = $req->fetch();

    $sth1 = $pdo->prepare("SELECT `Id_CATEGORIES`, `name` FROM `categories`");
    $sth1->execute();
    $resultat1 = $sth1->fetchAll();?>


    <?php
    if (isset($_POST['image'])) {
        $reqName = $_POST['name'];
        $reqImage = $_POST['image'];
        $reqPrice = $_POST['price'];
        $reqDescription =  $_POST['description'];
        $reqCategory =  $_POST['idCategorie'];
        $reqStatut =  $_POST['statut'];

        //On prépare la requête et on l'exécute
        $sth = $pdo->prepare("UPDATE `products` SET `name`=:name,`image`=:image,`price`=:price,`description`=:description,`idCategory`=:categorie, `statut`=:statut  WHERE `Id_PRODUCTS` = $idproduct");
        $sth->execute(array(
            ':name' => $reqName,
            ':image' => $reqImage,
            ':price' => $reqPrice,
            ':description' => $reqDescription,
            ':categorie' => $reqCategory,
            ':statut' => $reqStatut

    
        ));
        header('Location:product.php');
    } ?>
    <!-- formulaire rempli produit -->
<form action="update.php?update=<?= $idproduct ?>" method="post">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>name</label>
            <input value="<?= $result['name'] ?>" type="text" class="form-control" name="name">
        </div>
        <div class="form-group col-md-6">
            <label>image</label>
            <input type="text" value="<?= $result['image'] ?>" class="form-control" name="image">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>price</label>
            <input type="text" value="<?= $result['price'] ?>" class="form-control" name="price">
        </div>
        <div class="form-group col-md-6">
            <label>description</label>
            <input type="text" value="<?= $result['description'] ?>" class="form-control" name="description">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Categorie</label>
                <select name="idCategorie" >
                    <option disabled> --Choisissez une catégorie--</option>
                        <?php foreach ($resultat1 as $key => $value) { ?>
                    <option value =<?=$value['Id_CATEGORIES']?>><?= $value['name']?></option>
                        <?php } ?>
                </select>
        </div>
        <div class="form-group col-md-6">
            <label>Statut</label>
            <input type="text" value="<?= $result['statut'] ?>" class="form-control" name="statut">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
    

<?php
}

if (isset($_GET['updateCategory'])) {
    $idcategory = $_GET['updateCategory'];
    $req = $pdo->prepare("SELECT `name` FROM `categories` WHERE `Id_CATEGORIES` = $idcategory");
    $req->execute();
    $result = $req->fetch(); ?>

<!-- formulaire rempli catégories -->
    <form action="update.php?updateCategory=<?=$idcategory?>" method="post">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>name</label>
                <input type="text" value="<?= $result['name'] ?>" class="form-control" name="name">
            </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>


    <?php

    if ($_POST) {
        $reqName = $_POST['name'];
        // var_dump($_POST['name']);
        // die();
    
        //On prépare la requête et on l'exécute
        $sth = $pdo->prepare("UPDATE `categories` SET `name`=:name WHERE `Id_CATEGORIES` = $idcategory");
        $sth->execute(array(
            ':name' => $reqName,
        ));
        header('Location:category.php');
    }

}

//Update User ==================================================================================================================


if (isset($_GET['updateUser'])) {
    $idUser = $_GET['updateUser'];
    $req = $pdo->prepare("SELECT * FROM `users` WHERE `Id_USERS` = $idUser");
    $req->execute();
    $result4 = $req->fetch(); ?>

<!-- formulaire rempli catégories -->
    <form action="update.php?updateUser=<?=$idUser?>" method="post">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Pseudo</label>
                <input type="text" value="<?= $result4['pseudo'] ?>" class="form-control" name="pseudo">
            </div>
            <div class="form-group col-md-2">
                <label>Email</label>
                <input type="text" value="<?= $result4['email'] ?>" class="form-control" name="email">
            </div>
            <div class="form-group col-md-2">
                <label>Adresse</label>
                <input type="text" value="<?= $result4['adresse'] ?>" class="form-control" name="adresse">
            </div>
            <div class="form-group col-md-2">
                <label>Ville</label>
                <input type="text" value="<?= $result4['ville'] ?>" class="form-control" name="ville">
            </div>
            <div class="form-group col-md-4">
                <label>Statut</label>
                <input type="text" value="<?= $result4['statutUser'] ?>" class="form-control" name="statut">
            </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>


    <?php

    if (isset($_POST['pseudo'])) {
        $reqPseudo = $_POST['pseudo'];
        $reqEmail = $_POST['email'];
        $reqAdresse = $_POST['adresse'];
        $reqVille = $_POST['ville'];
        $reqStatut = $_POST['statut'];
        
        //On prépare la requête et on l'exécute
        $sth = $pdo->prepare("UPDATE `users` SET `pseudo`=:pseudo, `email`=:email,`adresse`=:adresse,`ville`=:ville,`statutUser`=:statut WHERE `Id_USERS` = $idUser");
        $sth->execute(array(
            ':pseudo' => $reqPseudo ,
            ':email' => $reqEmail,
            ':adresse' => $reqAdresse,
            ':ville' => $reqVille,
            ':statut' => $reqStatut,

        ));
        header('Location:user.php');
    }

}

include 'adminFooter.php';






