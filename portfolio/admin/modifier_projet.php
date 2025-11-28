<?php
session_start();
require_once "../config.php";
if(!isset($_SESSION["admin"])) { header("Location: login.php"); exit; }

$id = $_GET["id"];
$req = $pdo->prepare("SELECT * FROM projets WHERE id=?");
$req->execute([$id]);
$projet = $req->fetch();

if(!$projet){ die("Projet introuvable."); }

if(!empty($_POST)){
    $titre = $_POST["titre"];
    $descr = $_POST["description"];

    if(!empty($_FILES["image"]["name"])){
        $image = $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], "../images/".$image);

        $update = $pdo->prepare("UPDATE projets SET titre=?, description=?, image=? WHERE id=?");
        $update->execute([$titre, $descr, $image, $id]);
    } else {
        $update = $pdo->prepare("UPDATE projets SET titre=?, description=? WHERE id=?");
        $update->execute([$titre, $descr, $id]);
    }

    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/portfolio/css/admin.css">
    <title>Modifier le projet</title>
</head>
<body>

<?php include_once "../include/admin_header.php"; ?>

<div class="admin-container">

<h2>Modifier le projet</h2>

<form method="post" enctype="multipart/form-data">

    <input type="text" name="titre" value="<?= htmlspecialchars($projet["titre"]) ?>" required>

    <textarea name="description" required><?= htmlspecialchars($projet["description"]) ?></textarea>

    <p>Image actuelle :</p>
    <img src="../images/<?= $projet["image"] ?>" width="150">

    <input type="file" name="image">

    <div style="display: flex; gap: 10px;">
        <a href="admin.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </div>

</form>

</div>

<?php include_once "../include/admin_footer.php"; ?>

</body>
</html>
