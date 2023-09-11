<?php

session_start();
ob_start();

require_once 'configs/Chemins.class.php';
require_once Chemins::CONFIGS.'mysql_config.class.php';
require_once Chemins::MODELES.'gestion_boutique.class.php';
require_once Chemins::CONFIGS.'variables_globales.class.php';
require Chemins::VUES_PERMANENTES . 'v_entete.inc.php';
require_once Chemins::CONTROLEURS.'ControleurCategories.class.php';
require_once Chemins::CONTROLEURS.'ControleurPannier.class.php';


//$controleurCategories = new controleurCategories();
//$controleurCategories->afficher();

$cas = (!isset($_REQUEST['cas'])) ? 'afficherAccueil' : $_REQUEST['cas'];
$categorie = (!isset($_REQUEST['categorie'])) ? 'afficherAccueil' : $_REQUEST['categorie'];





if (!isset($_REQUEST['controleur']))
{
    require_once(Chemins::VUES . "v_boutiqueAccueil.inc.php");
}    
else {
    $action = $_REQUEST['action'];

    $classeControleur = 'Controleur' . $_REQUEST['controleur']; //ex : ControleurProduits
    $fichierControleur = $classeControleur . ".class.php"; //ex : ControleurProduits.class.php
    require_once(Chemins::CONTROLEURS . $fichierControleur);

    $objetControleur = new $classeControleur(); //ex : $objetControleur = new ControleurProduits();
    $objetControleur->$action(); //ex : $objetControleur->afficher();
    //version avec classe statique
    // $classeStatiqueControleur = 'Controleur' . $_REQUEST['controleur'];
    // $classeStatiqueControleur::$action();
}








require Chemins::VUES_PERMANENTES . 'v_pied.inc.php';