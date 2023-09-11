

    <article class="Connection">
        <form id="SeConnecter" action="index.php?controleur=Admin&action=Inscrire" method="post">

            <h2> Inscription </h2>
            <div class="insc">
                <input type='text' placeholder="Prénom" name='login' id='pseudo'/>
                <input type='text' placeholder="Nom" name='login' id='pseudo'/>
            </div>
            <div class="insc">
                <input type='text' placeholder="Num Tel" name='login' id='pseudo'/>
                <input type='text' placeholder="Email" name='login' id='pseudo'/>
            </div>
            <div class="insc">
            <input type='text' placeholder="Pseudo" name='login' id='pseudo'/>
            <input type='password' placeholder="Mot de Passe" name='login' id='pseudo'/>
            </div>
            <div class="insc">

                <input type='text' placeholder="Code Postal" name='cp' id='cp'/>
                <input type='text' placeholder="Ville" name='ville' id='ville' />
                <input type='text' placeholder="Rue" name='login' id='pseudo'/>

            </div>



            <input type='submit' name='valider' id='valider' value='Créer un Compte'/>
            <div class="autre">
                 <a class="Nouvelle" href="index.php?controleur=Admin&action=AfficherPageCo">Connection</a>
            </div>
        </form>
    </article>
<script>

$("#cp").autocomplete("application/vues/chercherCPVille.php", {
 width: 200,
}); //D’autres options sont disponibles, voir doc en ligne
 
$("#cp").result(function(event, data, formatted) {
 if (data)
 {
 $("#cp").val(data[1]);
 $("#ville").val(data[2]).prop("disabled", true);
}
});
</script>
