<?php
// On démarre la session
session_start(); // A partir de ce moment on a accès à $_SESSION
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    $admin=true;
     include '../includes/_head.php'; ?>
    
    
</head>

<body>
    <?php include '../includes/_navbar.php'; ?>
    <main class="container-lg bg-white py-4">
        <?php
        // On vérifie s'il y a un message à afficher (en session)
        if (isset($_SESSION["message"])) {
            echo '<div class="alert alert-success alert-dismissible fade show">' . 
            $_SESSION["message"] . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> ';
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
                require_once '../core/connexion.php';
                // 2 - Ecriture de la requête SQL
                $sql = 'SELECT * FROM product ORDER BY id DESC';
                // echo $sql;
                // 3 - Exécution de la requête SQL
                $query = mysqli_query($connexion, $sql);
                // 4 - Récupération des données
                // On passe en revue les produits récupérés dans la base de données
                // à l'aide d'une boucle while
                while ($produit = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td><?php echo $produit['id']; ?></td>
                        <td>
                            <?php if (isset($produit['image_name'])) {
                                // On affiche l'image
                            ?>
                                <img src="../images/<?php echo $produit['image_name']; ?>" alt="<?php echo $produit['nom']; ?>" class="img-list">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $produit['nom']; ?></td>
                        <td><?php echo $produit['description']; ?></td>
                        <td><?php echo $produit['prix']; ?></td>
                       <td><a href="modifier-produit.php?id=<?php echo $produit ['id'];?>" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a></td>
                       

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
<?php include '../includes/_js.php';?>
</html>