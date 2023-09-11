<div class="panier">
  <a href="#panier"><i class='bx bx-cart bx-sm'></i>
</div>

<div  class="pannier-container">
  <div class="header--pannier">
    <h2>Votre Panier</h2>
    <a href="#" class="closebtn bx-sm">×</a>
  </div>
  
  
      <div class="container">

        <form method="post" action="index.php?controleur=Pannier&action=ModifierPannier" method="post">
          <?php
          GestionBoutique::initialiser();
          $total = 0;
          if (GestionBoutique::getNbPanniers() == 0) {
          ?>
            <p> Aucun produit dans le pannier </p>
            <?php
          } else {
            $lesProduits = GestionBoutique::getPannier();
            foreach ($lesProduits as $idProduit => $uneQte) {
            $unProduit = GestionBoutique::getProduitById($idProduit);
            $prixTotalProduit = $unProduit->PrixHTProduit * $uneQte;
            $total += $prixTotalProduit;
            ?>
            <div class="container--produitinpannier">
              <div class="img-pannier">
              <img src="./public/img/<?php echo $unProduit->imageProduit; ?>" alt="">
              </div>
              <div class="article-pannier">
                <p><?php echo $unProduit->LibelleProduit; ?> </p>
                <p><?php echo $unProduit->PrixHTProduit; ?>€</p>
                <div class="qte--pannier">
                  <label for="login"> Quantitée :  </label> <input type="text" name="qteProduit" id="qteProduit" value="<?php echo $uneQte; ?>" />
                  <input type="hidden" value="<?php echo $unProduit->idProduit; ?>" id="idProduit" />
                  
                </div>
                <input type="submit" value="Changer quantitée" />
                <a  href="index.php?controleur=Pannier&action=RetirerPannier&idProduit=<?php echo $unProduit->idProduit;?>"  >Supprimer</a>
              </div>
            </div>
          <?php
            }
          }
          ?>
          <p>Prix total pour tous les produits: <?php echo $total ?>€</p> 
        </form>
        
      <footer class="vider">
        <div>
        <a  href="index.php?controleur=Pannier&action=ViderPannier"  >Vider Pannier </a>
        </div>
      </footer>
  </div>
</div>

<script>
  const btn = document.querySelector(".panier")
  const pannier = document.querySelector(".pannier-container")
  const closepann = document.querySelector(".closebtn")
  

  btn.onclick = function () {
      pannier.classList.toggle("hidden_pannier")

  }

  closepann.onclick = function(){
    pannier.classList.remove("hidden_pannier")
  }


</script>