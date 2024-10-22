<?php
session_start();

// Vérifier si l'utilisateur est connecté
#if (!isset($_SESSION['user_id'])) {
#    header("Location: ../LoginPage/LoginPage.php");
#    exit();
#}

// Connexion à la base de données
require_once '../Database/DatabaseConnection.php';

// Ajouter un projet si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $user_id = $_SESSION['user_id']; // ID de l'utilisateur connecté

    // Insérer dans la base de données
    $query = "INSERT INTO projects (user_id, title, description, date) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $user_id, $title, $description, $date);
    $stmt->execute();
    $stmt->close();
}

// Récupérer les projets de l'utilisateur connecté
$query = "SELECT * FROM projects WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$projects = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Projets</title>
    <link rel="stylesheet" href="styleProjets.css">
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
        <!-- Formulaire pour ajouter un projet -->
        <section class="add-project">
            <h2>Ajouter un nouveau projet</h2>
            <form action="Projets.php" method="POST">
                <label for="title">Titre du projet :</label>
                <input type="text" id="title" name="title" required>

                <label for="description">Description :</label>
                <textarea id="description" name="description" required></textarea>

                <label for="date">Date :</label>
                <input type="date" id="date" name="date" required>

                <button type="submit">Ajouter le projet</button>
            </form>
        </section>

        <!-- Liste des projets existants -->
        <section class="project-list">
            <h2>Mes Projets</h2>
            <?php if (count($projects) > 0): ?>
                <ul>
                    <?php foreach ($projects as $project): ?>
                        <li>
                            <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p><?php echo htmlspecialchars($project['description']); ?></p>
                            <p>Date : <?php echo htmlspecialchars($project['date']); ?></p>
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
