<?php
session_start();
ob_start();
require_once 'configs/Chemins.class.php';
require Chemins::MODELES . 'gestion_boutique.class.php';
require_once Chemins::CONFIGS.'mysql_config.class.php';
require_once Chemins::CONFIGS.'variables_globales.class.php';
require Chemins::VUES_PERMANENTES . 'v_entete.inc.php';


//$controleurCategories = new controleurCategories();
//$controleurCategories->afficher();

 $cas = (!isset($_REQUEST['cas'])) ? 'afficherAccueil' : $_REQUEST['cas'];
 $menus = (!isset($_REQUEST['menus'])) ? 'afficherAccueil' : $_REQUEST['menus'];

 if (isset($_COOKIE['login_admin']))
  $_SESSION['login_admin'] = $_COOKIE['login_admin'];

if (!isset($_REQUEST['controleur']))
{
    require_once(Chemins::VUES . "v_accueil.inc.php");
}    
else {
    $action = $_REQUEST['action'];

    $classeControleur = 'Controleur' . $_REQUEST['controleur']; //ex : ControleurProduits
    $fichierControleur = $classeControleur . ".class.php"; //ex : ControleurProduits.class.php
    require_once(Chemins::CONTROLEURS . $fichierControleur);

    $objetControleur = new $classeControleur();
    $objetControleur->$action();

}




//Aiguillage vers le bon corps de page
// switch ($cas) {
//     case 'afficherAccueil': {
//             require Chemins::VUES . 'v_accueil.inc.php';
//             break;
//         }
//     case 'afficherMenus': {
//             if (file_exists(Chemins::VUES . 'v_' . $menus . '.inc.php')) {
//                 require Chemins::VUES . 'v_' . $menus . '.inc.php';
                
//             } else {
//                 require Chemins::VUES . 'v_erreur404.inc.php';
//             }
// //            


//             break;
//         }
//         case 'verifierConnexion': {
//             if (GestionBoutique::isAdminOK($_POST['login'], $_POST['passe']))
//              {
//             $_SESSION['login_client'] = $_POST['login'];
//             //  if (isset($_POST['connexion_auto'])) 
//             //     setcookie('login_client', $_POST['login'], time() + 7*24*3600, null, null, false, true);
 
//              require Chemins::VUES_ADMIN. 'v_index_admin.inc.php';
//              }
//              else 
//              require Chemins::VUES_ADMIN . 'v_acces_interdit.inc.php';
  
//              break;
//          }
        
        
        
//     default : {
// //            require Chemins::VUES . 'v_erreur404.inc.php';
//             break;
//         }
// }







require Chemins::VUES_PERMANENTES . 'v_pied.inc.php';







