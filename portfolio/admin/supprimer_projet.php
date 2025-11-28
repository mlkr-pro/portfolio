<?php
session_start();
require_once "../config.php";

if(!isset($_SESSION["admin"])) { header("Location: login.php"); exit; }

$id = $_GET["id"];

$req = $pdo->prepare("DELETE FROM projets WHERE id=?");
$req->execute([$id]);

header("Location: admin.php");
exit;
