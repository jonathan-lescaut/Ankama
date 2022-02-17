<?php
include 'adminHeader.php';

// On dertermine sur quelle page on se trouve
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
}else {
    $currentPage = 1;
}

// on determine le nombre de produits total

$sth4 = $pdo->prepare("SELECT COUNT(*) AS nb_products FROM products");
$sth4->execute();
// on recupere le nombre de produit
$resultat4 = $sth4->fetch();
$nbProducts = (int) $resultat4['0'];

// on determine le nombre d'article par page
$parPage = 10;

// on calcule le nombre de page total (arrondi supérieur)

$pages = (int) ceil($nbProducts / $parPage);

// calcul du premier article de la page

$premier = ($currentPage * $parPage) - $parPage;


// jointures pour selectionner les catégories
                $sth3 = $pdo->prepare("SELECT categories.name AS categorieName, `Id_PRODUCTS`, products.name AS productName, `image`, `price`, `description`, Id_CATEGORIES, statut
                FROM products
                INNER JOIN categories ON idCategory = categories.Id_CATEGORIES LIMIT :premier, :parPage");

                $sth3->bindValue(':premier', $premier, PDO::PARAM_INT);
                $sth3->bindValue(':parPage', $parPage, PDO::PARAM_INT);

                $sth3->execute();
                $resultat3 = $sth3->fetchAll(PDO::FETCH_ASSOC);

?>

<h1 class="titreAdmin">Liste des produits</h1>

<section class="listeProduct">
    <table>
        <thead>
            <tr>
                <th class="tabProduct">Nom</th>
                <th class="tabProduct">image</th>
                <th class="tabProduct">Prix</th>
                <th class="tabProduct">Description</th>
                <th class="tabProduct">Catégorie</th>
                <th class="tabProduct">Statut</th>
            </tr>
        </thead>
        <tbody>

       <?php foreach ($resultat3 as $key => $value) { ?>
            <tr>

                <td><?= $value['productName'] ?></td>
                <td ><img src="<?= '../' .$value['image'] ?>" alt="image" width=50 height=25></td>
                <td><?= $value['price'] ?></td>
                <td class="tabProductDesc"><?= $value['description'] ?></td>
                <td><?= $value['categorieName'] ?></td>
                <td><?= $value['statut'] ?></td>
                <td><a class="btn btn-warning" href="update.php?update=<?= $value['Id_PRODUCTS'] ?>">Modifier</a></td>
                <td><a class="btn btn-danger" href="../delete.php?delete=<?= $value['Id_PRODUCTS'] ?>">Supprimer</a></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
    <div>
        <ul class="pagination">
            <li class="page-item  <?= ($currentPage === 1) ? "disabled" : "" ?>">
                <a href="./product.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
            </li>
    
            <?php for ($page = 1; $page <= $pages ; $page++):?> 
                    <li class="page-item  <?= ($currentPage === $page) ? "active" : "" ?>">
                        <a href="./product.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                    </li>
            <?php endfor ?>
    
            <li class="page-item <?= ($currentPage === $pages) ? "disabled" : "" ?>">
                <a href="./product.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
            </li>
        </ul>
    </div>

</section>

<h1 class="titreAdmin">Ajouter un produit</h1>
<section class="formAjoutP">
    <!-- Formulaire d'insersion produit -->
    <form action="../form/formProduct.php" method="post" enctype="multipart/form-data">
        <div class="form-row formAjout">
            <div class="form-group col-md-12">
                <label>Nom</label>
                <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group col-md-12">
                <label>Image</label>
                <input type="file" class="form-control" name="img" id="image">
            </div>
        </div>
        <div class="form-row formAjout">
            <div class="form-group col-md-12">
                <label>Le prix</label>
                <input type="text" class="form-control" name="price">
            </div>
            <div class="form-group col-md-12">
                <label>Description</label>
                <textarea class="form-control" name="description" rows="5" cols="33"></textarea>
            </div>
        </div>
        <div class="form-row formAjout">
            <div class="form-group col-md-12 formCate">
                <label>Catégorie</label>
                <select name="idCategorie">
                    <option disabled> --Choisissez une catégorie--</option>
                    <?php foreach ($resultat1 as $key => $value) { ?>
                    <option value=<?=$value['Id_CATEGORIES']?>><?= $value['name']?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-12">
                <label>Statut</label>
                <input type="text" class="form-control" name="statut">
            </div>
        </div>
        <input type="submit" name="submit" value="Envoyer" class="btn btn-primary">
    </form>
</section>

<?php include 'adminFooter.php';


