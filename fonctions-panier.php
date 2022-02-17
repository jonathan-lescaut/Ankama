<?php
function creationDuPanier()
{
   if(!isset($_SESSION['panier']))
   {
      $_SESSION['panier'] = array();
      $_SESSION['panier']['titre'] = array();
      $_SESSION['panier']['id_produit'] = array();
      $_SESSION['panier']['quantite'] = array();
      $_SESSION['panier']['prix'] = array();
      $_SESSION['panier']['image'] = array();

   }
}
//------------------------------------
function ajouterProduitDansPanier($titre, $id_produit, $quantite, $prix, $image)
{
    creationDuPanier(); 

     $position_produit = array_search($id_produit,  $_SESSION['panier']['id_produit']);
     if($position_produit !== false)
     {
         // laisser la possibilité à l'utilisateur de prendre deux produits au même id.
         // pas de colonne quantité mis en place pour l'instant
         $_SESSION['panier']['titre'][] = $titre;
         $_SESSION['panier']['id_produit'][] = $id_produit;
         $_SESSION['panier']['quantite'][] = $quantite;
         $_SESSION['panier']['prix'][] = $prix;
         $_SESSION['panier']['image'][] = $image;
         // ------------------------------------------------------------------------------
     }else {
        $_SESSION['panier']['titre'][] = $titre;
        $_SESSION['panier']['id_produit'][] = $id_produit;
        $_SESSION['panier']['quantite'][] = $quantite;
        $_SESSION['panier']['prix'][] = $prix;
        $_SESSION['panier']['image'][] = $image;
        
     }
    
}
//------------------------------------
function montantTotal()
{
   $total=0;
   for($i = 0; $i < count($_SESSION['panier']['id_produit']); $i++)
   {
      $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
   }
   return round($total,2); 
}
//------------------------------------
function retirerProduitDuPanier($id_produit_a_supprimer)
{
    $position_produit = array_search($id_produit_a_supprimer,  $_SESSION['panier']['id_produit']);
    if ($position_produit !== false)
    {
        array_splice($_SESSION['panier']['titre'], $position_produit, 1);
        array_splice($_SESSION['panier']['id_produit'], $position_produit, 1);
        array_splice($_SESSION['panier']['quantite'], $position_produit, 1);
        array_splice($_SESSION['panier']['prix'], $position_produit, 1);
        array_splice($_SESSION['panier']['image'], $position_produit, 1);

    }
}
//------------------------------------