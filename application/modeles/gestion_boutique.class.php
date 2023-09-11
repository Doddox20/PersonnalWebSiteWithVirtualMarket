<?php

//require_once '../../configs/mysql_config.class.php';

class GestionBoutique {

    // <editor-fold defaultstate="collapsed" desc="région Champs statiques"> 
    /**
     * Objet de la classe PDO
     * @var PDO
     */
    private static $pdoCnxBase = null;

    /**
     * Objet de la classe PDOStatement
     * @var PDOStatement
     */
    private static $pdoStResults = null;
    private static $requete = ""; //texte de la requête
    private static $resultat = null; //résultat de la requête

// </editor-fold>  
    // <editor-fold defaultstate="collapsed" desc="région Méthodes statiques"> 
    /**
     * Permet de se connecter à la base de données
     */

    public static function seConnecter() {
        if (!isset(self::$pdoCnxBase)) { //S'il n'y a pas encore eu de connexion
            try {
                self::$pdoCnxBase = new PDO('mysql:host=' . MysqlConfig::SERVEUR . ';dbname=' .
                        MysqlConfig::BASE, MysqlConfig::UTILISATEUR, MysqlConfig::MOT_DE_PASSE);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdoCnxBase->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                self::$pdoCnxBase->query("SET CHARACTER SET utf8");
            } catch (Exception $e) {
                // l’objet pdoCnxBase a généré automatiquement un objet de type Exception
                echo 'Erreur : ' . $e->getMessage() . '<br />'; // méthode de la classe Exception
                echo 'Code : ' . $e->getCode(); // méthode de la classe Exception
            }
        }
    }

    public static function seDeconnecter() {
        self::$pdoCnxBase = null;
        //si on n'appelle pas la méthode, la déconnexion a lieu en fin de script
    }

    /**
     * Retourne la liste des Catégories
     * @return type Tableau d'objets
     */
    public static function getLesCategories() {
        return GestionBoutique::getLesTuplesByTable('categorie');
    }

    public static function getLesProduits() {  
        return GestionBoutique::getLesTuplesByTable('produit');
    }
    public static function getLesFournisseurs() {
        return GestionBoutique::getLesTuplesByTable('fournisseur');
    }

    public static function getLesProduitsByCategorie($libelleCategorie) {
        self::seConnecter();
        self::$requete = "SELECT * FROM produit P,categorie C where P.idCategorie = C.idCategorie AND libelle = :libCateg";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('libCateg', $libelleCategorie);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();
        self::$pdoStResults->closeCursor();
        return self::$resultat;
    }

    public static function getProduitById($idProduit) {
        
        self::seConnecter();
        self::$requete="SELECT  * FROM produit p, categorie c where c.idCategorie = p.idCategorie and p.idProduit = :idProduit";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idProduit', $idProduit);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();
        return self::$resultat;
    }
    

    public static function getNbProduits() {
        self::seConnecter();
        self::$requete = "SELECT COUNT(*) AS nbProduits FROM produit";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();
        self::$pdoStResults->closeCursor();
        return self::$resultat->nbProduits;
    }
    public static function getNbCategories() {
        self::seConnecter();
        self::$requete = "SELECT COUNT(*) AS nbCategories FROM categorie";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();
        self::$pdoStResults->closeCursor();
        return self::$resultat->nbCategories;
    }

    /**
     * Ajoute une ligne dans la table Catégorie 
     * @param type $libelleCateg Libellé de la Catégorie
     */
    public static function ajouterCategorie($libelleCateg) {
        self::seConnecter();
        self::$requete = "insert into categorie(libelle) values(:libelle)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('libelle', $libelleCateg);
        self::$pdoStResults->execute();
    }
    
    /**
     * Ajoute une ligne dans la table Produit
     * @param type $nomProduit,$idCategorie   nom du produit ,id de la Catégorie
     */
    public static function ajouterProduit($LibelleProduit,$PrixHTProduit,$QteStockProduit,$idFournisseur,$idCategorie,$image) {
        self::seConnecter();
        self::$requete = "insert into produit(LibelleProduit,PrixHTProduit,QteStockProduit,idFournisseur,idCategorie,imageProduit) values('$LibelleProduit',$PrixHTProduit,'$QteStockProduit','$idFournisseur','$idCategorie','$image')";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
            }
            
            
    
    public static function supprimerProduit($idProduit) {
        self::seConnecter();
        self::$requete = "CALL _deleteProduitById($idProduit)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();  
    }
    public static function ModifierProduit($LibelleProduit,$PrixHTProduit,$QteStockProduit){
        self::seConnecter();
        self::$requete = "UPDATE produit SET PrixHTProduit = '$PrixHTProduit',QteStockProduit = '$QteStockProduit' WHERE idProduit='$LibelleProduit'";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
    }

    
      private static function  getLesTuplesByTable($Table) {
        self::seConnecter();
        self::$requete = "SELECT * FROM $Table ";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetchAll();
        self::$pdoStResults->closeCursor();
        return self ::$resultat;
      }    
      
      private static function getLesTuplesById($Table,$id) {
          self::seConnecter();
        self::$requete = "SELECT * FROM $Table where id = :idProduit";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
        self::$pdoStResults->bindValue('idProduit', $id);
        self::$pdoStResults->execute();
        self::$resultat = self::$pdoStResults->fetch();
        self::$pdoStResults->closeCursor();
        return self::$resultat;
      }
      /**
        * Vérifie si l'utilisateur est un administrateur présent dans la base
        * @param type $login Login de l'utilisateur
        * @param type $passe Passe de l'utilisateur
        * @return type Booléen
        */
        public static function isAdminOK($login,$passe) {
            self::seConnecter();
            self::$requete = "SELECT * FROM utilisateur where Login_Utilisateur=:login and MDP_Utilisateur=sha1(:passe) and id_Utilisateur not IN (SELECT id_Utilisateur from client )";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
            self::$pdoStResults->bindValue('login', $login);
            self::$pdoStResults->bindValue('passe', $passe);
            self::$pdoStResults->execute();
            self::$resultat = self::$pdoStResults->fetch();
            self::$pdoStResults->closeCursor();
            if ((self::$resultat!=null))
                return true;
            else 
                return false;
             }
             public static function isClientOK($login,$passe) {
                self::seConnecter();
                self::$requete = "SELECT * FROM utilisateur where Login_Utilisateur=:login and MDP_Utilisateur=sha1(:passe)";
                self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
                self::$pdoStResults->bindValue('login', $login);
                self::$pdoStResults->bindValue('passe', $passe);
                self::$pdoStResults->execute();
                self::$resultat = self::$pdoStResults->fetch();
                self::$pdoStResults->closeCursor();
                if ((self::$resultat!=null))
                    return true;
                else 
                    return false;
                 }

                 public static function initialiser() {
                    if (!isset($_SESSION['produits'])) {
                        $_SESSION['produits'] = array();
                    }
                }
            
                public static function vider() {
                    $_SESSION['produits'] = array();
                }
            
                public static function detruire() {
                    unset($_SESSION['produits']);
                }
            
            // </editor-fold>
            // <editor-fold defaultstate="collapsed" desc="région AJOUTS / MODIFS / SUPRESSION">
            
                public static function ajouterPannier($idProduit, $qte) {
                    if (self::contains($idProduit))
                        $_SESSION['produits'][$idProduit] += $qte;
                    else
                        $_SESSION['produits'][$idProduit] = $qte;
                }
            
                public static function modifierQtePannier($idProduit, $qte) {
                    if (self::contains($idProduit))
                        $_SESSION['produits'][$idProduit] = $qte;
                }
            
                public static function retirerPannier($idProduit) {
                    if (self::contains($idProduit))
                        unset($_SESSION['produits'][$idProduit]);
                }
            
            // </editor-fold>
            // <editor-fold defaultstate="collapsed" desc="région FONCTIONS GET">
            
                public static function getPannier() {
                    return $_SESSION['produits'];
                }
            
                public static function getNbPanniers() {
                    if (isset($_SESSION['produits'])) {
                        return array_sum($_SESSION['produits']);
                    }
                    // ou en 1 ligne : 
                    //return isset($_SESSION['produits'])?array_sum($_SESSION['produits']):0;
                }
            
                public static function getQteByPannier($idProduit) {
                    if (self::contains($idProduit))
                        return $_SESSION['produits'][$idProduit];        
                }
            
            // </editor-fold>    
            // <editor-fold defaultstate="collapsed" desc="région FONCTIONS BOOLEENNES">
                public static function isVide() {
                    return (self::getNbProduits() == 0);
                    // OU
            //        if (self::getNbProduits() == 0){
            //            return true;
            //        }
            //        else {
            //            return false;
            //        }
                }
            
                public static function contains($idProduit) {
                    return (array_key_exists($idProduit, self::getPannier()));
            
                    // OU
            //        if (array_key_exists($idProduit, self::getProduits())) {
            //            return true;
            //        } else {
            //            return false;
            //        }
                }
            
            // </editor-fold> 
            
            
            // ControleurPanier::initialiser();
            // ControleurPanier::ajouterProduit(4, 2);
            // ControleurPanier::ajouterProduit(11, 6);
            
            // var_dump(ControleurPanier::getProduits()); // OU var_dump($_SESSION['produits']);
            
            // ControleurPanier::retirerProduit(1);
            // ControleurPanier::retirerProduit(4);
            // ControleurPanier::retirerProduit(11);
            // var_dump(ControleurPanier::isVide());
            
            //var_dump($_SESSION['produits']);
            //echo PanierTestQte::getQteByProduit(8);
            //TODO ADAPTER LES CAS ET LA VUE DU PANIER...
            public static function chercherCPVille($recherche) {
                self::seConnecter();
                self::$requete = "select distinct CP,Ville from codespostaux where CP like'$recherche%' or ville like '$recherche%' order by CP";
                self::$pdoStResults = self::$pdoCnxBase->prepare(self::$requete);
                self::$pdoStResults->execute();
                self::$resultat = self::$pdoStResults->fetch();
                self::$pdoStResults->closeCursor();
                return self::$resultat;
                
            }
        
        










    }

    
    
// </editor-fold>



//// Test des methodes
////------------------
////Test de connexion
//GestionBoutique::seConnecter();
//
////Test de la méthode GetLesCategories()


//
////Test de la méthode GetLesProduits()
//
//$lesProduits = GestionBoutique::getLesProduits();
//var_dump($lesProduits);
//
////Test de la méthode getLesProduitsByCategorie()
//
//$lesProduits = GestionBoutique::getLesProduitsByCategorie('jazz');
//var_dump($lesProduits);
//
////Test de la méthode getLesProduitsById()
//
//$leProduit = GestionBoutique::getProduitById(1);
//
//echo "Produit retourné : <br/> ";
//echo "-------------------<br/> ";
//echo "id : $leProduit->id <br/>";
//echo "nom : $leProduit->nom <br/>";
//echo "description : $leProduit->description <br/>";
//echo "prix : $leProduit->prix <br/>";
//echo "Fichier de l'image : $leProduit->image <br/>";

//$lesCategories = GestionBoutique::getLesCategories();
//$Nbcategories = GestionBoutique::getNbCategories();
//
//
//
//echo "Il y a $Nbcategories categorie <br/> ";
//echo "-------------------<br/> ";
//
//for ($i=0;$i<$Nbcategories;$i++)
//{
//echo  $lesCategories[$i]->libelle . "(categorie ". $lesCategories[$i]->id. ") <br/> ";
//}



//var_dump($lesCategories);
//
////Test de la méthode getNbProiduits()
//
//$produit = GestionBoutique::getNbProduits();
//echo "Il y a $produit produits dans la boutique";


//GestionBoutique::ajouterCategorie('funk');
//var_dump(GestionBoutique::getLesCategories());

//try {
//GestionBoutique::ajouterProduit('cacao','1','Du Pur chocolat en poudre','50');
//var_dump(GestionBoutique::getLesProduits());
//
//} catch (Exception $ex) {
//    echo 'Attention Erreur dIntégrité Référentielle ';
//}
//GestionBoutique::supprimerProduit();
//var_dump(GestionBoutique::getLesProduits())
//;
    
?>

