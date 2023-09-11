<?php

class ControleurProduits {

    public function __construct() {
        // si on séparait les modèles, le constructeur donnerait son chemin
        // require_once Chemins::MODELES.'gestion_Produits.class.php'; 
    }

    public function afficher() {
        VariablesGlobales::$libelleCategorie = $_REQUEST['categorie'];
        VariablesGlobales::$lesProduits = GestionBoutique::getLesProduitsByCategorie(VariablesGlobales::$libelleCategorie);
        require Chemins::VUES . 'v_poduits.inc.php';
    }
    
}

?>