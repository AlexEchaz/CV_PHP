<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: Projets.php");
    exit();
}

require_once 'Database/DatabaseConnection.php';
$conn = DatabaseConnection::getInstance()->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $user_id = $_SESSION['user_id'];

    if (!empty($titre) && !empty($description) && !empty($date)) {
    $query = "INSERT INTO Projets (user_id, titre, description, date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$user_id, $titre, $description, $date]);
}
}

$query = "SELECT * FROM Projets WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$_SESSION['user_id']]);
$Projets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes projets</title>
    <link rel="stylesheet" href="styleProjet.css">
</head>
<body>
    <header>
        <h1>Mes Projets</h1>
        <nav>
            <ul>
                <li><a href="../Index/index.php">Accueil</a></li>
                <li><a href="../CV/CV.php">Mon CV</a></li>
                <li><a href="../LogoutPage.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="add-project">
            <h2>Ajouter un nouveau projet</h2>
            <form action="Projets.php" method="POST">
                <label for="title">Titre du projet :</label>
                <input type="text" id="title" name="titre" required>

                <label for="description">Description :</label>
                <textarea id="description" name="description" required></textarea>

                <label for="date">Date :</label>
                <input type="date" id="date" name="date" required>

                <button type="submit">Ajouter le projet</button>
            </form>
        </section>

        <section class="project-list">
            <h2>Mes Projets</h2>
            <?php if (count($Projets) > 0): ?>
                <ul>
                    <?php foreach ($Projets as $Projets): ?>
                        <li>
                            <h3><?php echo htmlspecialchars($Projets['titre']); ?></h3>
                            <p><?php echo htmlspecialchars($Projets['description']); ?></p>
                            <p>Date : <?php echo htmlspecialchars($Projets['date']); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun projet ajouté pour le moment.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Mon Portfolio</p>
    </footer>
</body>
</html>
