<?php
// On démarre la session
session_start(); // A partir de ce moment on a accès à $_SESSION
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'includes/_head.php'; ?>
</head>
<body>
    <?php include 'includes/_navbar.php'; ?>
    <main class="container-lg bg-white py-4">
        <?php
            // On vérifie s'il y a un message à afficher (en session)
            if(isset($_SESSION["message"])){
                echo '<div class="alert alert-success">'.$_SESSION["message"].'</div>';
                // On supprime le message de la session
                unset($_SESSION["message"]);
            }
        ?>
        <h1>Liste des produits</h1>
        <a href="ajouter-produit.php" class="btn btn-success my-3">Nouveau produit</a>
        <p>Administrer vos produits</p>
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // 1 - Connexion à la BDD
                    require_once 'connexion.php';
                    // 2 - Ecriture de la requête SQL
                    $sql = 'SELECT * FROM product';
                    // echo $sql;
                    // 3 - Exécution de la requête SQL
                    $query = mysqli_query($connexion, $sql);
                    // 4 - Récupération des données
                    // On passe en revue les produits récupérés dans la base de données
                    // à l'aide d'une boucle while
                    while($produit = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $produit['id']; ?></td>
                    <td><?php echo $produit['image_name']; ?></td>
                    <td><?php echo $produit['nom']; ?></td>
                    <td><?php echo $produit['description']; ?></td>
                    <td><?php echo $produit['prix']; ?></td>
                    <td></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>