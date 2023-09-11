

<article class="Connection">
    <form id="SeConnecter" action="index.php?controleur=Admin&action=verifierConnexion" method="post">
        <h2> Identification</h2>
        <input type='text' placeholder="Pseudo" name='login' id='pseudo'/>
        <input type='password' placeholder="Mot de passe" name='passe' id='pass'/>
        <div>
            <input type="checkbox" name="connexion_auto" id="connexion_auto" /><label for="connexion_auto" class="enligne"> Connexion automatique </label>
        </div>
        <input type='submit' name='valider' id='valider' value='Se Connecter' />
        <div class="autre">
            <a class="Nouvelle" href="index.php?controleur=Admin&action=AfficherInscription">Créer un compte</a>
        </div>
    </form>
</article>

