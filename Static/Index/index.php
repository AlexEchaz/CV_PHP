<?php
//débug
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//
//echo "Chemin actuel : " . __DIR__ . "<br>";
//echo "Fichiers dans le répertoire courant : <pre>";
//print_r(scandir(__DIR__));
//echo "</pre>";
//echo "Fichiers dans /app : <pre>";
//print_r(scandir('/app'));
//echo "</pre>";
//fin débug

require_once __DIR__ . '/Database/DatabaseConnection.php';

session_start();

// Gestion de la connexion
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        $db = DatabaseConnection::getInstance()->getConnection();
        $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['userName'];
            $_SESSION['role'] = $user['role'];
            header('Location: index.php');
            exit;
        } else {
            $error = 'Email ou mot de passe incorrect';
        }
    } catch (PDOException $e) {
        $error = 'Erreur de connexion à la base de données';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Mon Portfolio</title>
    <link rel="stylesheet" href="styleIndex.css">
</head>
<body>
    <header>
        <h1>Connexion</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="LoginPage.php">Connexion</a></li>
                <li><a href="Contact.php">Contact</a></li>
                <li><a href="CV.php">Mon CV</a></li>
                <li><a href="Projet.php">Projets</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="login-form">
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="LoginPage.php">
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">Se connecter</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Alexandre ECHAZARRETA. Tous droits réservés.</p>
    </footer>
</body>
</html>