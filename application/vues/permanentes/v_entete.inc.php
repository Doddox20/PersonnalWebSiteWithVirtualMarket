<head>

<!-- CSS only -->
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<script src="<?php echo Chemins::JS .'jquery-3.6.1.min.js';?>"> </script>
<script src="//code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<script src="<?php echo Chemins::JS .'jquery-autocomplete/jquery.autocomplete.js';?>"> </script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600;700&family=Nunito:wght@200;300;400;500;600;700;900;1000&display=swap" rel="stylesheet">
<script src="<?php echo Chemins::JS .'jquery.browser.js';?>"> </script>


<!-- <script src="<?php echo Chemins::JS . 'utils.js'; ?>"> </script> -->
<link href="<?php echo Chemins::STYLES . 'main_style.css'; ?>" rel="stylesheet" type="text/css">
<!--<link href="<?php echo Chemins::STYLES . 'styleform_jquery.css'; ?>" rel="stylesheet" type="text/css">-->
</head>


<header>
<!-- <div class="loader">
  <span class="anim"> § </span>
</div> -->
<nav class="main--nav">
  <a class="Title" href="index.php">DORIAN CONTAL</a>
  <div class="nav--menu--connexion">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="index.php?controleur=Admin&action=AfficherPageCom">Compétences</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="index.php?controleur=Admin&action=AfficherPageCV">Présentation</a>
          </li>

          <li id="boutique" class="nav-item">
            <a class="nav-link" >Boutique</a>
            <div class="categ">
              <div class="bc--categ">
              <ul class="list--categ">
                  <?php

                  require_once 'configs/Chemins.class.php';
                  require_once Chemins::CONTROLEURS .'ControleurCategories.class.php';
                  $ControleurCategories = new controleurCategories();
                  $ControleurCategories -> afficher();
                  
                  foreach(VariablesGlobales::$lesCategories as $uneCategorie) {
                      ?>
                      <li>
                          <a href=boutique.php?controleur=Produits&action=afficher&categorie=<?php echo $uneCategorie->libelle; ?>><?php echo $uneCategorie->libelle; ?></a> 
                      </li>
                      <?php
                  }
                  ?>
              </ul>
              </div>
            </div>
          </li>

         
        </ul>
        <div class="ifconnect">
          <?php 
            if ((isset($_SESSION['login_client'])) or (isset($_SESSION['login_admin'])))
            {echo '<a class="nav-link " href="index.php?controleur=Admin&action=AfficherAdminIndex"><i class="bx bx-wrench bx-sm"></i></a>';}
            else
            {
              echo '';
            }
            ?>

          <?php 
            if ((isset($_SESSION['login_client'])) or (isset($_SESSION['login_admin'])))
            {echo '<a class="nav-link " href="index.php?controleur=Admin&action=seDeconnecter"><i class="bx bx-log-in bx-sm "></i></a>';}
            else
            {
              echo '<a class="nav-link connecter" href="index.php?controleur=Admin&action=AfficherPageCo"><i class="bx bx-log-in-circle bx-sm"></i></a>';
            }
            ?>
            
            <?php 
            if (isset($_SESSION['login_client']))
            {require_once Chemins::VUES_PERMANENTES . 'v_panier.inc.php';}
            else
            {}
            ?>
            
          </div>
      </div>
    </div>
  </div>
</nav>


</header>