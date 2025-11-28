<?php 
session_start();
require_once "../config.php";
if(!isset($_SESSION["admin"])) { header("Location: login.php"); exit; }
$projets = $pdo->query("SELECT * FROM projets ORDER BY date_publication DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/portfolio/css/admin.css">
</head>
<body>

<?php include_once "../include/admin_header.php"; ?>

<div class="admin-container">

    <h2>Liste des projets</h2>

    <a href="ajouter_projet.php" class="btn btn-primary add-btn">+ Ajouter un projet</a>

    <div class="grid-admin">
        <?php foreach($projets as $p): ?>
            <div class="card-admin">

                <div class="card-header">
                    <h3><?= htmlspecialchars($p["titre"]) ?></h3>
                    <span class="date"><?= date("d/m/Y", strtotime($p["date_publication"])) ?></span>
                </div>

                <div class="actions">
                    <a class="btn btn-secondary" href="modifier_projet.php?id=<?= $p["id"] ?>">Modifier</a>
                    <a class="btn btn-danger" 
                       href="supprimer_projet.php?id=<?= $p["id"] ?>"
                       onclick="return confirm('Confirmer la suppression ?');">
                       Supprimer
                    </a>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

</div>

<?php include_once "../include/admin_footer.php"; ?>

</body>
</html>