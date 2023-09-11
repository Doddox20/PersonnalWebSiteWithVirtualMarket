<?php

class controleurAdmin {

    public function __construct() {
        // si on séparait les modèles, le constructeur donnerait son chemin
        // require_once Chemins::MODELES.'gestion_categories.class.php'; 
    }

    public function verifierConnexion() {
    if (GestionBoutique::isAdminOK($_POST['login'], $_POST['passe']))
            {
            $_SESSION['login_admin'] = $_POST['login'];
            if (isset($_POST['connexion_auto'])) 
            setcookie('login_admin', $_POST['login'], time() + 7*24*3600, null, null, false, true);
            VariablesGlobales::$lesCategories = GestionBoutique::getLesCategories();
            VariablesGlobales::$lesFournisseurs = GestionBoutique::getLesFournisseurs();
            VariablesGlobales::$lesProduits = GestionBoutique::getLesProduits();
            require Chemins::VUES .'v_index_admin.inc.php';
            }
            else if(GestionBoutique::isClientOK($_POST['login'], $_POST['passe']))
            {
            $_SESSION['login_client'] = $_POST['login'];
            if (isset($_POST['connexion_auto'])) 
            setcookie('login_client', $_POST['login'], time() + 7*24*3600, null, null, false, true);
            GestionBoutique::initialiser();
            require Chemins::VUES .'v_BienConnecte.inc.php';


            }
            else 
            require Chemins::VUES . 'v_acces_interdit.inc.php';
    }
    
    public function afficherConnexion() {
    if (isset($_SESSION['login_admin']))
            require Chemins::VUES_ADMIN . 'v_connexion.inc.php';
            else
            require Chemins::VUES_ADMIN . 'v_connexion.inc.php';
    }
    
    public function seDeconnecter() {
    $_SESSION = array();
            session_destroy();
            header("Location:index.php");
            setcookie('login_admin', ''); //suppression du cookie en vidant simplement la chaîne
    }
    public function afficherPageCo() {
        require Chemins::VUES . 'v_connexion.inc.php';
        }
    public function afficherPageCv() {
        require Chemins::VUES . 'v_cv.inc.php';
        }
    public function afficherPageCom() {
        require Chemins::VUES . 'v_competence.inc.php';
        }
    public function afficherInscription() {
        require Chemins::VUES . 'v_inscription.inc.php';
    }
    public function ajouterProduit() {
            GestionBoutique::ajouterProduit($_POST['nomProduit'],$_POST['prix'],$_POST['qte'],$_POST['fournisseur'],$_POST['categorie'],$_FILES['image']['name']);
            if(isset($_FILES['image'])) {
                $file_name = $_FILES['image']['name'];
                $file_tmp = $_FILES['image']['tmp_name'];
                $file_dest = 'public/img/'.$file_name;
                if(move_uploaded_file($file_tmp, $file_dest)) {
                    
                }
            }
            else{
                var_dump($_FILES);
            }
            require Chemins::VUES . 'v_produitAjouter.inc.php';
        }
    public function supprimerProduit() {
            GestionBoutique::supprimerProduit($_POST['produit']);
            require Chemins::VUES . 'v_produitAjouter.inc.php';
    }
    public function modifierProduit() {
            GestionBoutique::ModifierProduit($_POST['produit'],$_POST['prix'],$_POST['qte']);
            require Chemins::VUES . 'v_produitAjouter.inc.php';

    }


    public function afficherAdminIndex() {
        VariablesGlobales::$lesCategories = GestionBoutique::getLesCategories();
        VariablesGlobales::$lesFournisseurs = GestionBoutique::getLesFournisseurs();
        VariablesGlobales::$lesProduits = GestionBoutique::getLesProduits();
        if (isset($_SESSION['login_admin']))
                require Chemins::VUES .'v_index_admin.inc.php';
                else
                require Chemins::VUES .'v_acces_interdit.inc.php';
        }

        // public function chercherCPVille() {
        //         $recherche = strtolower($_GET["q"]);
 
        //         if (!$recherche) return
                
        //         GestionBoutique::chercherCPVille($recherche);
                        
 

 

        // }

      
 
        
    



    

}
?>
