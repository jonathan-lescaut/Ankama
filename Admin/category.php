<?php include 'adminHeader.php';


                // req de tout mes catégories pour aller dans mon tableau
                $sth1 = $pdo->prepare("SELECT `Id_CATEGORIES`, `name` FROM `categories`");
                $sth1->execute();
                $resultat1 = $sth1->fetchAll();
?>

<h1>Catégories</h1>

<table class="formCate">
</thead>
    <tbody>

        <!-- Affichage de toute les catégories -->
        <?php foreach ($resultat1 as $key => $value) { ?>
        <tr class="liste">
            <td><?= $value['name'] ?></td>
            <td><a class="btn btn-warning" href="update.php?updateCategory=<?= $value['Id_CATEGORIES'] ?>">Modifier</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<section class="formAjoutC">
    <h1>Ajouter</h1>

    <!-- Formulaire d'insersion catégorie -->
    <form action="../form/formCategory.php" method="post">
        <div class="form-row formAjout">
            <div class="form-group col-md-12">
                <label>Nom de la catégorie</label>
                <input type="text" class="form-control" name="nameCategory">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</section>

<?php include 'adminFooter.php';
