<?php
include 'header.php';
include_once("fonctions-panier.php");


// var_dump($_SESSION);

//--- VIDER PANIER ---//
if(isset($_GET['action']) && $_GET['action'] == "vider")
{
    unset($_SESSION['panier']);
}
//--- RETIRER PRODUIT ---//

if (isset($_GET['retirer'])) {
    retirerProduitDuPanier($_GET['retirer']);
}

if (isset($_GET['id_produit'])) {
    $product = $_GET['id_produit'];
    $sth4 = $pdo->prepare("SELECT categories.name AS categorieName, `Id_PRODUCTS`, products.name AS productName, `image`, `price`, `description`, Id_CATEGORIES, statut
    FROM products
    INNER JOIN categories ON idCategory = categories.Id_CATEGORIES WHERE `Id_PRODUCTS` = '$product'");

            $sth4->execute();
            $resultat4 = $sth4->fetchAll();
            foreach ($resultat4 as $key => $value) { 
                ajouterProduitDansPanier($value['productName'], $value['Id_PRODUCTS'], '1', $value['price'], $value['image']);
            }
}?>
<section class="panier">
    <table>
        <thead>
            <tr>
                <th class="titrePanier" colspan="4">Panier</th>

            </tr>
        </thead>
        <tbody>
            <?php 
        if (isset($_SESSION['panier'])) {

        for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++) { ?>
            <tr>
                <td><img src="<?= $_SESSION['panier']['image'][$i] ?>" alt="image" width=180 height=130></td>
                <td><?= $_SESSION['panier']['titre'][$i]?></td>
                <td><?= $_SESSION['panier']['prix'][$i]?></td>
                <td class="btnRetirer"><a href="panier.php?retirer=<?=$_SESSION['panier']['id_produit'][$i]?>">Retirer</a></td>
            </tr>
            <?php } ?>
            <tr class="total">
                <td colspan='2'>Total</td>
                <td colspan='2'> <?= montantTotal();?> Euros</td>
            </tr>
            <tr>
                <td  class="btnVider" colspan='5'><a href='?action=vider'>Vider mon panier</a></td>
            </tr>
            
            <?php } ?>
        </tbody>

    </table>
</section>

<?php include 'footer.php';
