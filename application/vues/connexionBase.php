<?php
//Config MYSQL
// $utilisateur="root";
// $passe="root";
// $serveur="localhost";
// $base="ppe_marchand_contall";
$utilisateur="contal";
$passe="qwubb";
$serveur="127.0.0.1";
$base="contal1";

//Connexion à la base
try{
 $pdoCnxBase=new PDO('mysql:host='.$serveur.';dbname='.$base,$utilisateur,$passe);
 $pdoCnxBase->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 $pdoCnxBase->query("SET CHARACTER SET utf8");
 } catch (Exception $ex) {
 echo $ex->getMessage();
 }
?>