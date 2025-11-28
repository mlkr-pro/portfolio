<?php require_once "config.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/portfolio/css/style.css">
    <title>Portfolio MMI</title>
</head>
<body>
<?php
$page = "accueil";
$title = "Accueil – Portfolio MMI";
include_once "include/header.php";


$projets = $pdo->query("SELECT * FROM projets ORDER BY date_publication DESC")->fetchAll();
?>

<section class="projet-section">
    <h2>Mes projets</h2>

    <div class="grid-projets">
        <?php foreach($projets as $p): ?>
            <a href="projet.php?id=<?= $p["id"] ?>" class="carte">
                <img src="/portfolio/images/<?= $p["image"] ?>" alt="<?= htmlspecialchars($p["titre"]) ?>">
                <div class="carte-content">
                    <h3><?= htmlspecialchars($p["titre"]) ?></h3>
                    <p><?= substr(htmlspecialchars($p["description"]), 0, 120) ?>...</p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<?php include_once "include/footer.php"; ?>

</body>
</html>