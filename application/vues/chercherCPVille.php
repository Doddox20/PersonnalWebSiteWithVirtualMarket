<?php 
 require_once 'connexionBase.php';
// Récupération du codepostal posté 
 
 $recherche = strtolower($_GET["q"]);
 
 if (!$recherche) return;
 
// Recherche du CP dans la base
$requete="select distinct CP,Ville from codespostaux where CP like'$recherche%' or ville like '$recherche%' order by 
CP";
$pdoStResults=$pdoCnxBase->prepare($requete);
$pdoStResults->execute();
//parcours et affichage des resultats
while ($ligne = $pdoStResults->fetch(PDO::FETCH_OBJ) ){
 $cp=$ligne->CP;
 $ville=$ligne->Ville;
 echo "$cp - $ville|$cp|$ville\n";
}
 
// Fermeture de la base
$pdoStResults->closeCursor();
 
?>