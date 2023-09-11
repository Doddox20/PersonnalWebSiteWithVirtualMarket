<div class="title-boutique">
   <h1> <?php echo $_REQUEST['categorie'] ?> </h1>
</div>

<div class="magasin">

   <?php
    foreach (VariablesGlobales::$lesProduits as $unProduit) {
   ?>
      
            <form id="produ" action="index.php?controleur=Pannier&action=AjouterPannier&idProduit=<?php echo $unProduit->idProduit;?>" method="post">
                     <div class="img--prod">
                        <img src="./public/img/<?php echo $unProduit->imageProduit; ?>" alt="">
                     </div>
                     <div class="title--pr">
                        <a><?php echo $unProduit->LibelleProduit;?></a>
                        <a><?php echo $unProduit->PrixHTProduit;?> €</a>
                     </div>
                     <div class="qte--p--add">
                        <?php
                           if (isset($_SESSION['login_client'])) { ?>

                           <input type='submit' name='valider' id='valider' value='Ajouter'>
                           <div>
                              <input id="number" name="number" type="number" value="1" max="<?php echo $unProduit->QteStockProduit;?>">
                              <a>/ <?php echo $unProduit->QteStockProduit;?></a> 
                           </div>
                        <?php } ?>
                        
                     </div>
            </form>
   <?php
    }
    ?>


   </div>


