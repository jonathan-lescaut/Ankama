
    <?php

// remise a zéro -------------------------------------------------------------

// partie en cours
        if (isset($_GET['reset'])) {
            $_SESSION['counterW'] = 0;
            $_SESSION['counterL'] = 0;
            $_SESSION['egalite'] = 0;
            $win = 'rejouerPartie';
            $imgGamer = 'regles';
    
        }
// la totalité des compteurs
        if (isset($_GET['resetTotal'])) {
            $_SESSION['counterW'] = 0;
            $_SESSION['counterL'] = 0;
            $_SESSION['egalite'] = 0;
            $_SESSION['gameW'] = 0;
            $_SESSION['gameL'] = 0;
            $win = 'jouer';
            $imgGamer = 'regles';
        }
//-----------------------------------------------------------------------------



// Cestion des confrontation entre l'utilisateur et l'ordinateur -------------------------------------------------------------

if (isset($_GET['game'])) {
    $game = $_GET['game'];
    $text = 'Tu as choisi ';
    $boot = rand(1, 3);

    if ($boot === 1 &&  $game === 'la pierre') {
        $commentaire = $text . $game.' Egalité';
        $imgGamer = 'pierre';
        $win = 'e';
    }
    if ($boot === 2 &&  $game === 'la pierre') {
        $commentaire = $text . $game . ' et tu perds contre la feuille';
        $imgGamer = 'pierre';
        $win = 'l';
    }
    if ($boot === 3 &&  $game === 'la pierre') {
        $commentaire = $text . $game .' et tu gagne contre les ciseaux';
        $imgGamer = 'pierre';
        $win = 'w';
    }
    if ($boot === 1 &&  $game === 'la feuille') {
        $commentaire = $text . $game . ' et tu gagne contre la pierre';
        $imgGamer = 'feuille';
        $win = 'w';
        
    }
    if ($boot === 2 &&  $game === 'la feuille') {
        $commentaire = $text . $game .' Egalité';
        $imgGamer = 'feuille';
        $win = 'e';
    }
    if ($boot === 3 &&  $game === 'la feuille') {
        $commentaire = $text . $game .' et tu perds contre les ciseaux';
        $imgGamer = 'feuille';
        $win = 'l';
    }
    if ($boot === 1 &&  $game === 'les ciseaux') {
        $commentaire = $text . $game .' qui perdent contre la pierre';
        $imgGamer = 'ciseaux';
        $win = 'l';
    }
    if ($boot === 2 &&  $game === 'les ciseaux') {
        $commentaire = $text . $game. ' et tu gagne contre la feuille';
        $imgGamer = 'ciseaux';
        $win = 'w';
    }
    if ($boot === 3 &&  $game === 'les ciseaux') {
        $commentaire = $text . $game .' Egalité';
        $imgGamer = 'ciseaux';
        $win = 'e';
    }
    // écran de départ
    if ($game === '------' ) {
        $commentaire = ' <div>Commencer la partie !</div><div>pierre feuille ou ciseaux</div>';
        $imgGamer = 'regles';
        $win = 'jouer';
    }
}
// écran de départ suite a un reset
if (empty($_GET)|| isset($_GET['reset']) || isset($_GET['resetTotal'])) {
    $commentaire = ' <div>Commencez la partie !</div><div>pierre feuille ou ciseaux</div>';
    $imgGamer = 'regles';
    $win = 'jouer';
}
//-----------------------------------------------------------------------------


// Incrémentation des compteurs-----------------------------------------------------
if ($win === 'jouer') {
    $_SESSION['counterW']= 0;
    $_SESSION['counterL']= 0;
    $_SESSION['egalite']= 0;
    $_SESSION['gameW'] = 0;
    $_SESSION['gameL'] = 0;
}


if(isset($_GET['game']) ){

    if (isset($win)) {
        if ($win === 'w') {
                $_SESSION['counterW']++;
        }if ($win === 'l') {
                $_SESSION['counterL']++;
        }if ($win === 'e') {
                $_SESSION['egalite']++;
        }
    }
}

//-----------------------------------------------------------------------------

// Fin de la partie -----------------------------------------------------

//score défini pour la victoire
$scoreVictoire = 3;
$egalite = 0;

//commentaires de fin de partie


if ($_SESSION['counterW'] === 0 && $_SESSION['counterL'] === 0) {
    $debut = "<div class='alert'>Chi Fou Mi ! </div>";
}
if ($_SESSION['counterW'] === 1 && $_SESSION['counterL'] === 0) {
    $debut = "<div class='alert'>Chi Fou Mi ! </div>";
}
if ($_SESSION['counterW'] === 0 && $_SESSION['counterL'] === 1) {
    $debut = "<div class='alert'>Chi Fou Mi ! </div>";
}
if ($_SESSION['counterW'] === 1 && $_SESSION['counterL'] === 1) {
    $debut = "<div class='alert'>Chi Fou Mi ! </div>";
}
    if (isset($_SESSION['counterW'])) {
        if ($egalite === 0) {
            if ($_SESSION['counterW'] >= $scoreVictoire) {
                $_SESSION['counterW'] = 0;
                $_SESSION['counterL'] = 0;
                $_SESSION['egalite'] = 0;

                $victoire  = "<div class='alert'>Bravo tu as gagné contre l'ordinateur </div>";
                $_SESSION['gameW']++;
            
            }
            if ($_SESSION['counterL'] >= $scoreVictoire) {
                $_SESSION['counterW'] = 0;
                $_SESSION['counterL'] = 0;
                $_SESSION['egalite'] = 0;
                $defaite = "<div class='alert'>GAME OVER :( </div>";
                if (isset($_SESSION['gameL'])) {
                    $_SESSION['gameL']++;
                }
            
            }
        }
    }

//commentaire en cours de partie

if (isset($_SESSION['counterW']) && isset($_SESSION['counterL']) ) {

    if ($_SESSION['counterW'] === 2 && $_SESSION['counterL'] < 2) {
        $vicProche = "<div class='alert'>La victoire approche<div>";
    }
    if ($_SESSION['counterL'] === 2 && $_SESSION['counterW'] < 2) {
        $defProche = "<div class='alert'>L'ordinateur est sur le point de gagner !<div>";
    }
    if ($_SESSION['counterL'] === 2 && $_SESSION['counterW'] === 2) {
        $egal = "<div class='alert'>Egalité parfaite ! le prochain tour est décisif !<div>";
    }
}
//-----------------------------------------------------------------------------------------------

// gestion apparition des images ------------------------------------------------------------
if ($win === 'w' && $imgGamer === 'ciseaux') {
    $imgGamer = $imgGamer . '.png';
    $imgBoot= 'feuille.png';
}
if ($win ==='w' && $imgGamer ==='pierre') {
    $imgGamer = $imgGamer . '.png';
    $imgBoot= 'ciseaux.png';
}
if ($win === 'w' && $imgGamer === 'feuille') {
    $imgGamer = $imgGamer . '.png';
    $imgBoot= 'pierre.png';
}
if ($win ==='l' && $imgGamer ==='ciseaux') {
    $imgGamer = $imgGamer . '.png';
    $imgBoot= 'pierre.png';
}
if ($win === 'l' && $imgGamer ==='feuille') {
    $imgGamer = $imgGamer . '.png';
    $imgBoot= 'ciseaux.png';
}
if ($win === 'l' && $imgGamer === 'pierre') {
    $imgGamer = $imgGamer . '.png';
    $imgBoot= 'feuille.png';
}
if ($win === 'e' ) {
    $imgGamer = $imgGamer . '.png';
    $imgBoot = $imgGamer;
}
// image au lancement du fichier pfc.php
if ($win === 'jouer' ) {
    $imgBoot = 'regles.jpeg';
    $imgGamer = 'regles.jpeg';

}
//-----------------------------------------------------------------------------------------------

