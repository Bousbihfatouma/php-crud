<?php
//on annalyse la valeur de la variable action pour savoir si ont dois ajouter un nouveau produit ou si ont modififie in produit existant 
//ou encore supprimer un produit
switch($_POST["action"]){
    case "new":
    addProduct();
    break;

}
//fonction pour ajouter un produit
function addproduct (){
    //1-connection à la bdd
   require_once '../connexion.php' ;
    //ecrire une requête sql
    $nom=trim(strip_tags(addslashes($_POST['nom'])));
    //on vérifie si l'utlisateur  a saissi une description
    if (isset($_POST['description'])) {
        $description= trim(strip_tags(addslashes($_POST['description'])));

    } else{
        $description='';
    }
   $prix = $_POST['prix'];
  $sql = 'INSERT INTO product (nom, description, prix) VALUES ("' . $nom . '", "' . $description . '", ' . $prix . ')';
   echo $sql;
}