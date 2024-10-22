<?php
session_start();
#include '../../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = $db::getInstance();
    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: profile.php");
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleLoginPage.css">
</head>

<form method="POST">
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Mot de passe</label>
    <input type="password" name="password" required>
    <button type="submit">Connexion</button>
</form>
