<?php include 'adminHeader.php';

// req de tout mes USERs pour aller dans mon tableau
$sth2 = $pdo->prepare("SELECT * FROM `users`");
$sth2->execute();
$resultat2 = $sth2->fetchAll();

?>

<section class="formUser">

    <table>
        <thead>
            <tr>
                <th class="tabUser">Pseudo</th>
                <th class="tabUser">Email</th>
                <th class="tabUser">Adresse</th>
                <th class="tabUser">Ville</th>
                <th class="tabUser">Statut</th>
                <th class="tabUser">date Inscription</th>

            </tr>
        </thead>
        <tbody>

            <?php foreach ($resultat2 as $key => $value) { ?>

            <tr>
                <td><?=$value['pseudo']?></td>
                <td><?=$value['email']?></td>
                <td><?=$value['adresse']?></td>
                <td><?=$value['ville']?></td>
                <td><?=$value['statutUser']?></td>
                <td><?=$value['date_inscription']?></td>
                <td><a  class="btn btn-warning" href="update.php?updateUser=<?= $value['Id_USERS'] ?>">Modifier</a></td>
                <td><a  class="btn btn-danger" href="../delete.php?deleteUser=<?= $value['Id_USERS'] ?>">Supprimer</a></td>


            </tr>
            <?php } ?>
        </tbody>
    </table>
</section>

<?php include 'adminFooter.php';
