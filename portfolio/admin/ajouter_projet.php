<?php 
session_start();
include "../config.php";

if(!isset($_SESSION["admin"])) { header("Location: login.php"); exit; }

if(!empty($_POST)){
    
    $titre = $_POST["titre"];
    $descr = $_POST["description"];

    $image = $_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../images/".$image);

    $req = $pdo->prepare("INSERT INTO projets(titre, description, image, date_publication) VALUES(?,?,?,NOW())");
    $req->execute([$titre, $descr, $image]);

    header("Location: /portfolio/admin/admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/portfolio/css/admin.css">
</head>
<body>

<?php include_once "../include/admin_header.php"; ?>

<div class="admin-container">
<form method="post" enctype="multipart/form-data">

    <input type="text" name="titre" placeholder="Titre du projet" required>

    <textarea name="description" placeholder="Description du projet" required></textarea>

    <input type="file" name="image" required>

    <div style="display: flex; gap: 10px;">
        <a href="admin.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">Ajouter le projet</button>
    </div>

</form>
</div>

<?php include_once "../include/admin_footer.php"; ?>

</body>
</html>
