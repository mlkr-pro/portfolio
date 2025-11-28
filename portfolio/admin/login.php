<?php 
session_start(); 
include "../config.php"; 

if(!empty($_POST)){
    $u = $_POST["username"];
    $p = $_POST["password"];

    $req = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
    $req->execute([$u]);
    $user = $req->fetch();

    if($user && password_verify($p, $user["password"])){
        $_SESSION["admin"] = true;
        header("Location: admin.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="/portfolio/css/admin.css">
<body>
<form method="post">
    <h2>Connexion Admin</h2>
    <input type="text" name="username" placeholder="Utilisateur">
    <input type="password" name="password" placeholder="Mot de passe">
    <button type="submit">Connexion</button>
</form>
</body>
</html>
