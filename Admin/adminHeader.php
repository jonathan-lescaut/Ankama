<?php  include '../connexionPDO.php';
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
        <!-- styles-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <!-- font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
        <!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="cssAdmin/style.css">
    <title>Ankama</title>
</head>
<body>
    <!-- navigation -->
    <nav>
        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-4">
                   
                </div>
                <div class="col-md-4">
                    <img class="imgLogo" src="../img/logo.png" alt="logo">
                </div>
                <div class="col-md-4">
                    <div class="row-md-6 lienNav"><?php 

                    if (isset($_SESSION['pseudo'])) {
                        if ($_SESSION['statutUser'] === 'admin') {?>
                            <div><a href="../index.php">Retour au site</a><div>
                            <div class="bonjour">Bonjour,<?=" ". $_SESSION['pseudo'] ?></div>
                        <?php }
                        if ($_SESSION['statutUser'] === NULL) {?>
                            <div class="bonjour">Bonjour,<?=" ". $_SESSION['pseudo'] ?></div>
                        <?php }
                    }else{?>
                        <a href="connexion.php">Connexion</a></div>

                    <?php } ?>
                    
                    <div class="row-md-6 formNav"></div>
                </div>
            </div>
        </div>
    </nav>

    <!-- fin de navigation -->
    <body>


<?php if (isset($_SESSION['id']) AND $_SESSION['statutUser'] === 'admin')
{?>

<ul class="ulAdmin">
    <li class="nav-item navHAdmin">
        <h2>Mon administration</h2>
    </li>
    <li class="nav-item navHAdmin">
        <a class="" href="product.php">Les produits</a>
    </li>
    <li class="nav-item navHAdmin">
        <a class="" href="category.php">Catégories</a>
    </li>
    <li class="nav-item navHAdmin">
        <a class="" href="user.php">Utilisateurs</a>
    </li>
</ul>

<div class="navBarAdmin">
	
<?php }else {
    header('Location:connexion.php');
}?>
