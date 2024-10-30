<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'Database/DatabaseConnection.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: LoginPage.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Utiliser getInstance() pour obtenir l'instance unique et getConnection() pour obtenir la connexion PDO
$conn = DatabaseConnection::getInstance()->getConnection();

// Récupère les informations de CV de l'utilisateur
$sql = "SELECT name, job, email, description, competences, experience, education, age FROM CV WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$cv = $stmt->fetch(PDO::FETCH_ASSOC);

// Si le formulaire est soumis, met à jour le CV
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $job = $_POST['job'];
    $email = $_POST['email'];
    $description = $_POST['description'];
    $competences = $_POST['competences'];
    $experience = $_POST['experience'];
    $education = $_POST['education'];
    
    // Optionnel : Ajoute une valeur par défaut pour l'âge si le champ n'est pas fourni
    $age = $_POST['age'] ?? null; // Utilise null si pas défini

    // Insérer ou mettre à jour le CV
    $sql = "INSERT INTO CV (user_id, name, job, email, description, competences, experience, education, age)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
            name = VALUES(name), 
            job = VALUES(job), 
            email = VALUES(email), 
            description = VALUES(description), 
            competences = VALUES(competences), 
            experience = VALUES(experience), 
            education = VALUES(education), 
            age = VALUES(age)"; // Ajoute le champ age ici
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id, $name, $job, $email, $description, $competences, $experience, $education, $age]);

    header("Location: CV.php"); // Recharge la page pour afficher les nouvelles données
    exit();
}

// Récupère les informations de CV si elles existent déjà
$sql = "SELECT name, job, email, description, competences, experience, education, age FROM CV WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$cv = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae</title>
    <link rel="stylesheet" href="styleCV.css">
</head>

<body>
    <div class="container">
        <h1>Curriculum Vitae</h1>
        
        <form method="POST" action="CV.php">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($cv['name'] ?? ''); ?>" required>

            <label for="job">Travail / Statut :</label>
            <input type="text" id="job" name="job" value="<?php echo htmlspecialchars($cv['job'] ?? ''); ?>" required>

            <label for="email">Adresse email :</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($cv['email'] ?? ''); ?>" required>

            <label for="age">Âge :</label>
            <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($cv['age'] ?? ''); ?>">

            <label for="description">Description :</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($cv['description'] ?? ''); ?></textarea>

            <label for="experience">Expériences professionnelles :</label>
            <textarea id="experience" name="experience" required><?php echo htmlspecialchars($cv['experience'] ?? ''); ?></textarea>

            <label for="education">Formation :</label>
            <textarea id="education" name="education" required><?php echo htmlspecialchars($cv['education'] ?? ''); ?></textarea>

            <label for="competences">Compétences :</label>
            <textarea id="competences" name="competences" required><?php echo htmlspecialchars($cv['competences'] ?? ''); ?></textarea>

            <button type="submit">Enregistrer</button>
        </form>

        <footer>
            <p>&copy; 20XX <?php echo htmlspecialchars($cv['name'] ?? ''); ?></p>
        </footer>
    </div>
</body>
</html>
