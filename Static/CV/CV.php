<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include '../config/config.php';
$db = $db::getInstance();

// Récupérer les informations du CV de l'utilisateur connecté
$user_id = $_SESSION['user_id'];
$stmt = $db->prepare("SELECT * FROM cv WHERE user_id = ?");
$stmt->execute([$user_id]);
$cv = $stmt->fetch();

// Si le formulaire est soumis, mettre à jour les informations du CV
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $skills = $_POST['skills'];

    if ($cv) {
        // Mise à jour du CV existant
        $stmt = $db->prepare("UPDATE cv SET description = ?, skills = ? WHERE user_id = ?");
        $stmt->execute([$description, $skills, $user_id]);
        echo "CV mis à jour avec succès !";
    } else {
        // Ajout d'un nouveau CV si aucun n'existe
        $stmt = $db->prepare("INSERT INTO cv (user_id, description, skills) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $description, $skills]);
        echo "CV créé avec succès !";
    }

    // Rafraîchir la page pour afficher les nouvelles données
    header("Location: cv.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon CV</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
    <?php include '../views/header.php'; ?>

    <div class="container">
        <h1>Mon CV</h1>

        <!-- Affichage du CV -->
        <?php if ($cv): ?>
            <p><strong>Description :</strong> <?= htmlspecialchars($cv['description']); ?></p>
            <p><strong>Compétences :</strong> <?= htmlspecialchars($cv['skills']); ?></p>
        <?php else: ?>
            <p>Vous n'avez pas encore rempli votre CV.</p>
        <?php endif; ?>

        <h2>Modifier mon CV</h2>
        <form method="POST" action="cv.php">
            <label for="description">Description</label><br>
            <textarea id="description" name="description" rows="5" cols="40" required><?= htmlspecialchars($cv['description'] ?? ''); ?></textarea><br><br>

            <label for="skills">Compétences</label><br>
            <textarea id="skills" name="skills" rows="5" cols="40" required><?= htmlspecialchars($cv['skills'] ?? ''); ?></textarea><br><br>

            <button type="submit">Enregistrer</button>
        </form>
    </div>

    <?php include '../views/footer.php'; ?>
</body>
</html>
