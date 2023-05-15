<?php
// Nom d'utilisateur de la BDD
$login = 'root';
// Mot de passe de la BDD
$password = '';
// Nom de la BDD
$database = 'descodeuses_presentation';
// Adresse du serveur
$host = 'localhost';

// Connexion à la BDD
$connexion = mysqli_connect($host, $login, $password, $database);
if (mysqli_connect_error()) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}
?>
