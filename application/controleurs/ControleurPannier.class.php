<?php

//Classe statique, peut aussi être géré avec un singleton

class ControleurPannier {

    public function ajouterPannier() {
        GestionBoutique::ajouterPannier($_REQUEST['idProduit'],$_POST['number']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    public function retirerPannier() {
        GestionBoutique::retirerPannier($_REQUEST['idProduit']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    public function getPannier() {
        GestionBoutique::getPannier();
    }
    public function getNbPannier() {
        GestionBoutique::getNbPanniers();
    }
    public function ModifierPannier(){
        GestionBoutique::modifierQtePannier($_POST['idProduit'],$_POST['qteProduit']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    public function ViderPannier(){
        GestionBoutique::vider();
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }


}
