<?php include 'header.php';


if (isset($_POST['pseudo'])) {
	
	$pseudo = $_POST['pseudo'];
	//  Récupération de l'utilisateur et de son pass hashé
	$req = $pdo->prepare('SELECT Id_USERS, pass, statutUser FROM users WHERE pseudo = :pseudo');
	$req->execute(array(
		'pseudo' => $pseudo
	));
	$resultat = $req->fetch();
	
	// Comparaison du pass envoyé via le formulaire avec la base
	$isPasswordCorrect = password_verify($_POST['pass'], $resultat['pass']);
	
	if (!$resultat) {
		echo 'Mauvais identifiant ou mot de passe !';
	} else {
		if ($isPasswordCorrect) {
			$_SESSION['id'] = $resultat['Id_USERS'];
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['statutUser'] = $resultat['statutUser'];
			header('location: index.php');
		} else {
			echo 'Mauvais identifiant ou mot de passe !';
		}
	}
} ?>



<form action="" method="post">
	<div class="container formConnexion">
		<div class="d-flex justify-content-center h-100">
			<div class="card">
			
				<div class="card-body">
					<form>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="votre pseudo" name="pseudo">

						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" class="form-control" placeholder="password" name="pass">
						</div>
						<div class="form-group">
							<input type="submit" value="Login" class="btn float-right login_btn">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</form>

<?php include 'footer.php';?>