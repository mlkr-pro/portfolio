<?php
$host = "mysql-mlkr.alwaysdata.net"; 
$dbname = "mlkr_portfolio";
$user = "mlkr";
$pass = "Nator.95";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (Exception $e) {
    die("Erreur connexion BDD : " . $e->getMessage());
}
?>
