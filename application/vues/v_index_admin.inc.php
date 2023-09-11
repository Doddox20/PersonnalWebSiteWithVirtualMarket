<article class="Connection mod">
    <form id="SeConnecter" action="index.php?controleur=Admin&action=ajouterProduit" method="post" enctype="multipart/form-data">
            <h2> Ajouter Un Produit </h2>
            <input type='text' placeholder="Nom du Produit" name='nomProduit' id='pseudo' /><br />
            <input type='text' placeholder="Prix HT" name='prix' id='pseudo' /></br>
            <input type='text' placeholder="Quantitée" name='qte' id='pseudo' /><br />
            <input type='file' name='image' id='pseudo' /><br />
            <select id="pseudo" name="categorie">
                <?php
                foreach (VariablesGlobales::$lesCategories as $uneCategorie) {
                ?>
                    <option value="<?php echo $uneCategorie->idCategorie; ?>"><?php echo $uneCategorie->libelle; ?></option>
                <?php
                }
                ?>
            </select> </br>
            <select id="pseudo" name="fournisseur">
                <?php
                foreach (VariablesGlobales::$lesFournisseurs as $unFournisseur) {
                ?>
                    <option value="<?php echo $unFournisseur->idFournisseur; ?>"><?php echo $unFournisseur->NomFournisseur; ?></option>
                <?php
                }
                ?>
            </select> </br>

            <input type='submit' name='valider' id='valider' value='Ajouter' />


    </form>




    <form id="SeConnecter" action="index.php?controleur=Admin&action=modifierProduit" method="post">

            <h2> Modifier un Produit </h2>
            <select id="pseudo" name="produit">
                <?php
                foreach (VariablesGlobales::$lesProduits as $unProduit) {
                ?>
                    <option value="<?php echo $unProduit->idProduit; ?>"><?php echo $unProduit->LibelleProduit; ?></option>
                <?php
                }
                ?>
            </select> <br />
            <input type='text' placeholder="Prix HT" name='prix' id='pseudo' /></br>
            <input type='text' placeholder="Quantitée" name='qte' id='pseudo' /><br />
            </br>

            <input type='submit' name='valider' id='valider' value='Modifier' />

    </form>




    <form id="SeConnecter" action="index.php?controleur=Admin&action=supprimerProduit" method="post">

            <h2> Supprimer un Produit </h2>

            <select id="pseudo" name="produit">
                <?php
                foreach (VariablesGlobales::$lesProduits as $unProduit) {
                ?>
                    <option value="<?php echo $unProduit->idProduit; ?>"><?php echo $unProduit->LibelleProduit; ?></option>
                <?php
                }
                ?>
            </select>
            </br>


            <input type='submit' name='valider' id='valider' value='Supprimer' />

    </form>





</article>