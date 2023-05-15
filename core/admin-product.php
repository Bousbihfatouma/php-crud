<?php
//on démarre la session
session_start();// à partir de ce moment ont a accèder à 
// On analyse la valeur de la variable action
// pour savoir si on doit ajouter un nouveau produit
// ou si on doit modifier un produit existant
// ou encore si on doit supprimer un produit
switch($_POST["action"]){
    case "new":
        addProduct();
        break;
}
// Fonction pour ajouter un produit
function addProduct(){
    // 1 - Connexion à la BDD
    require_once '../connexion.php';
    // 2 - Ecrire une requête SQL
    $nom  = trim(strip_tags(addslashes($_POST['nom'])));
    // On vérifie si l'utilisateur a saisi une description
    if(isset($_POST['description'])){
        $description = trim(strip_tags(addslashes($_POST['description'])));
    } else {
        $description = '';
    }
    $prix = $_POST['prix'];
    // Prise en charge du fichier image
    // On vérifie si l'utilisateur a bien sélectionné un fichier
    if(isset($_FILES['image'])){
        // print_r($_FILES['image']);
        // die();
        // On vérifie si le fichier a bien été uploadé
        if($_FILES['image']['error'] == 0){
            // On récupère le nom du fichier uploadé
            $nomFichier = $_FILES['image']['name'];
            // On passe le nom de l'image en minuscule et de supprime les espaces
            $nomFichier = strtolower(str_replace(' ', '-', $nomFichier));
            // On rend unique le nom de l'image avec le timestamp
            $nomFichier = time().'-'.$nomFichier;
            // On déplace le fichier du dossier temporaire (du serveur) vers le dossier images
            move_uploaded_file($_FILES['image']['tmp_name'], '../images/'.$nomFichier);
        }
    }else{
        $nomFichier = '';
    }
    $sql = 'INSERT INTO product (nom, description, prix, image_name) VALUES ("'.$nom.'", "'.$description.'", '.$prix.', "'.$nomFichier.'")';
    //echo $sql;
    // 3 - Exécuter la requête SQL
    mysqli_query($connexion, $sql);
    //4 mise en session d'un message de succés et redirection de l'user
    $_session['message']='Le produit a bien étais ajouter ';
    header('Location:../index.php');
}
