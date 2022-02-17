<?php include 'header.php'; ?>


<form action="" method="POST">
	<div class="container formInscription">
		<div class="d-flex justify-content-center h-100">
			<div class="card">
				<div class="card-body">
					<form>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="email" class="form-control" placeholder="email" name="email">

						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-gamepad"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="pseudo" name="pseudo">

						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-map-marker"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="adresse" name="adresse">

						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-map-marker"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="ville" name="ville">

						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" class="form-control" placeholder="pass" name="pass">
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" class="form-control" placeholder="password" name="pass2">
						</div>
						<div class="form-group">
							<input type="submit" value="S'inscrire" class="btn float-right login_btn">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</form>

<?php

// Hachage du mot de passe
if (isset($_POST['pass'])) {
	if ($_POST['pass'] === $_POST['pass2']) {
		$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
		$email = $_POST['email'];
		$pseudo = $_POST['pseudo'];
		$adresse = $_POST['adresse'];
		$ville = $_POST['ville'];


		// Insertion
		$req = $pdo->prepare('INSERT INTO users(pseudo, pass, email, adresse, ville, date_inscription) VALUES(:pseudo, :pass, :email, :adresse, :ville, CURDATE())');
		$req->execute(array(
			'pseudo' => $pseudo,
			'pass' => $pass_hache,
			'email' => $email,
			'adresse' => $adresse,
			'ville' => $ville
		));?>

		<li data-target="blog" data-target-activation="click" class="tile icon_add_favourite">
        <div>
            <h2>Vous êtes inscrit</h2>
                <script type="text/JavaScript">
                    setTimeout("location.href = 'connexion.php';", 1500);
                </script>
        </div>
        </li>
	<?php } else {
		echo "les mots de passes ne sont pas identiques";
	}
}

include 'footer.php';
