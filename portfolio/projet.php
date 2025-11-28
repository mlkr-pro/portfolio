<?php
require_once "config.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET["id"];

$req = $pdo->prepare("SELECT * FROM projets WHERE id = ?");
$req->execute([$id]);
$projet = $req->fetch();

if (!$projet) {
    header("Location: index.php");
    exit;
}

$page = "projet";
$title = htmlspecialchars($projet["titre"]) . " – Portfolio MMI";
include_once "include/header.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/portfolio/css/style.css">
    <title><?= htmlspecialchars($projet["titre"]) ?></title>
</head>
<body>

<section class="projet-detail fade-up">

    <h1><?= htmlspecialchars($projet["titre"]) ?></h1>

    <div class="projet-wrapper">

        <div class="projet-image-container fade-up-delay">
            <img class="projet-image" 
                 src="/portfolio/images/<?= $projet["image"] ?>" 
                 alt="<?= htmlspecialchars($projet["titre"]) ?>">
        </div>

        <div class="projet-description fade-up-delay2">
            <p><?= nl2br(htmlspecialchars($projet["description"])) ?></p>

            <p class="projet-date">
                Publié le : <?= date("d/m/Y", strtotime($projet["date_publication"])) ?>
            </p>

            <a href="index.php" class="btn-retour">Retour aux projets</a>
        </div>

    </div>

</section>

<?php include_once "include/footer.php"; ?>

</body>
</html>
