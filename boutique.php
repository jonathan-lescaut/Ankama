<?php include 'header.php';
if (isset($_GET['id_produit'])) {

    echo 'fiche produit';
}


define("TITRE1", "Nos coups de coeur");
define("TITRE2", "Les promos du moment");
define("TITRE3", "Les nouveautés");
define("TITRE4", "Tout nos produits");

// On dertermine sur quelle page on se trouve
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
} else {
    $currentPage = 1;
}

// on determine le nombre de produits total

$sth4 = $pdo->prepare("SELECT COUNT(*) AS nb_products FROM products");
$sth4->execute();
// on recupere le nombre de produit
$resultat4 = $sth4->fetch();
$nbProducts = (int) $resultat4['0'];

// on determine le nombre d'article par page
$parPage = 6;

// on calcule le nombre de page total (arrondi supérieur)

$pages = (int) ceil($nbProducts / $parPage);

// calcul du premier article de la page

$premier = ($currentPage * $parPage) - $parPage;



function listeStatut($titre, $statut)
{
    include 'connexionPDO.php';
    if ($titre === TITRE1) {
        $sth4 = $pdo->prepare("SELECT categories.name AS categorieName, `Id_PRODUCTS`, products.name AS productName, `image`, `price`, `description`, Id_CATEGORIES, statut
            FROM products
            INNER JOIN categories ON idCategory = categories.Id_CATEGORIES WHERE `statut` = '$statut'");
        $sth4->execute();
        $resultat4 = $sth4->fetchAll();
    }
    if ($titre === TITRE2) {
        $sth4 = $pdo->prepare("SELECT categories.name AS categorieName, `Id_PRODUCTS`, products.name AS productName, `image`, `price`, `description`, Id_CATEGORIES, statut
            FROM products
            INNER JOIN categories ON idCategory = categories.Id_CATEGORIES WHERE `statut` = '$statut'");
        $sth4->execute();
        $resultat4 = $sth4->fetchAll();
    }
    if ($titre === TITRE3) {
        $sth4 = $pdo->prepare("SELECT categories.name AS categorieName, `Id_PRODUCTS`, products.name AS productName, `image`, `price`, `description`, Id_CATEGORIES, statut
            FROM products
            INNER JOIN categories ON idCategory = categories.Id_CATEGORIES WHERE `statut` = '$statut'");
        $sth4->execute();
        $resultat4 = $sth4->fetchAll();
    }
?>
    <section class="carousel">
        <ul class="carousel-items">
            <?php foreach ($resultat4 as $key => $value) { ?>
                <li class="carousel-item">
                    <div class="card">
                        <h2 class="card-title"><?= $value['productName'] ?></h2>
                        <img src="<?= $value['image'] ?>" alt="image" width=150 height=100>
                        <div class="card-content prixCard">
                            <?= $value['price'] . ' €' ?>
                        </div>
                        <div class="card-content descriptionCard">
                            <?= $value['description'] ?>
                        </div>
                        <a class="btn btn-primary" href="panier.php?id_produit=<?= $value['Id_PRODUCTS'] ?>">Ajouter</a>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </section>

<?php } ?>

<section class="coupDeCoeur">
    <h2 class="titreBoutique"><?= TITRE1 ?></h2>
    <?php listeStatut(TITRE1, 'coeur'); ?>
</section>
<section class="promo">
    <h2 class="titreBoutique"><?= TITRE2 ?></h2>
    <?php listeStatut(TITRE2, 'promo'); ?>
</section>
<section class="nouveaute">
    <h2 class="titreBoutique"><?= TITRE3 ?></h2>
    <?php listeStatut(TITRE3, 'nouveauté'); ?>
</section>

<!--  pagination product ---------------------------------------------------------------------------------------------------------------------------->

<!-- requete normale -->

<?php
$sth3 = $pdo->prepare("SELECT categories.name AS categorieName, `Id_PRODUCTS`, products.name AS productName, `image`, `price`, `description`, Id_CATEGORIES, statut
           FROM products
           INNER JOIN categories ON idCategory = categories.Id_CATEGORIES LIMIT :premier, :parPage");

$sth3->bindValue(':premier', $premier, PDO::PARAM_INT);
$sth3->bindValue(':parPage', $parPage, PDO::PARAM_INT);

$sth3->execute();
$resultat = $sth3->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- requete par prix croissant-->
<?php
$sth3 = $pdo->prepare("SELECT categories.name AS categorieName, `Id_PRODUCTS`, products.name AS productName, `image`, `price`, `description`, Id_CATEGORIES, statut 
FROM products INNER JOIN categories ON idCategory = categories.Id_CATEGORIES ORDER BY `products`.`price` ASC LIMIT :premier, :parPage");

$sth3->bindValue(':premier', $premier, PDO::PARAM_INT);
$sth3->bindValue(':parPage', $parPage, PDO::PARAM_INT);

$sth3->execute();
$resultatPrixCroissant = $sth3->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- requete par prix décroissant-->
<?php
$sth3 = $pdo->prepare("SELECT categories.name AS categorieName, `Id_PRODUCTS`, products.name AS productName, `image`, `price`, `description`, Id_CATEGORIES, statut 
FROM products INNER JOIN categories ON idCategory = categories.Id_CATEGORIES ORDER BY `products`.`price` DESC LIMIT :premier, :parPage");

$sth3->bindValue(':premier', $premier, PDO::PARAM_INT);
$sth3->bindValue(':parPage', $parPage, PDO::PARAM_INT);

$sth3->execute();
$resultatPrixDecroissant = $sth3->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- requete alphabétique -->
<?php
$sth3 = $pdo->prepare("SELECT categories.name AS categorieName, `Id_PRODUCTS`, products.name AS productName, `image`, `price`, `description`, Id_CATEGORIES, statut
           FROM products
           INNER JOIN categories ON idCategory = categories.Id_CATEGORIES ORDER BY `productName` ASC LIMIT :premier, :parPage");

$sth3->bindValue(':premier', $premier, PDO::PARAM_INT);
$sth3->bindValue(':parPage', $parPage, PDO::PARAM_INT);

$sth3->execute();
$resultatAphabetique = $sth3->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- requete par catégories -->
<?php
$sth3 = $pdo->prepare("SELECT categories.name AS categorieName, `Id_PRODUCTS`, products.name AS productName, `image`, `price`, `description`, Id_CATEGORIES, statut 
FROM products INNER JOIN categories ON idCategory = categories.Id_CATEGORIES ORDER BY `categorieName` ASC LIMIT :premier, :parPage");

$sth3->bindValue(':premier', $premier, PDO::PARAM_INT);
$sth3->bindValue(':parPage', $parPage, PDO::PARAM_INT);

$sth3->execute();
$resultatCategorie = $sth3->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="carousel">
    <h2 class="titreBoutique2">La Boutique</h2>
    <div class="container-fluid formTri">
            <form action="" method="post">
        
                <button type="submit" name="croissant">Prix -</button>
                <button type="submit" name="decroissant">Prix +</button>
                <button type="submit" name="alpha">A B C</button>
                <button type="submit" name="categories">Par catégories</button>
        
            </form>


    </div>

<!-- gestion du tri -->
    <?php
    if (isset($_POST['croissant'])) {
        $resultat = $resultatPrixCroissant;
    }
    if (isset($_POST['decroissant'])) {
        $resultat = $resultatPrixDecroissant;
    }
    if (isset($_POST['alpha'])) {
        $resultat = $resultatAphabetique;
    }
    if (isset($_POST['categories'])) {
        $resultat = $resultatCategorie;
    }
    ?>
    <div class="container-fluid blocCard">


        <div class="row pageBoutique">
            <?php foreach ($resultat as $key => $value) { ?>
                <div class="col-md-4 cardFlex">
                    <div class="card cardBoutique">
                        <div class="col-md-12">
                            <div class="row">
                                <h2 class="card-title"><?= $value['productName'] ?></h2>
                            </div>
                            <div class="row">
                                <img src="<?= $value['image'] ?>" alt="image" width=150 height=100>
                            </div>
                            <div class="row">
                                <div class="card-content prixCard"><?= $value['price'] . ' €' ?></div>
                            </div>
                            <div class="row">
                                <div class="card-content"><?= $value['description'] ?></div>
                            </div>
                            <div class="row">

                                <div class="card-content"><?= $value['categorieName'] ?></div>
                            </div>
                            <div class="row">
                                <a class="btn btn-primary" href="panier.php?id_produit=<?= $value['Id_PRODUCTS'] ?>">Ajouter</a>
                            </div>

                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>

        </tbody>

        <div>
        </div>
        <ul class="pagination">
            <li class="page-item  <?= ($currentPage === 1) ? "disabled" : "" ?>">
                <a href="./boutique.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
            </li>

            <?php for ($page = 1; $page <= $pages; $page++) : ?>
                <li class="page-item  <?= ($currentPage === $page) ? "active" : "" ?>">
                    <a href="./boutique.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                </li>
            <?php endfor ?>

            <li class="page-item <?= ($currentPage === $pages) ? "disabled" : "" ?>">
                <a href="./boutique.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
            </li>
        </ul>
    </div>

</section>




<?php include 'footer.php'; ?>