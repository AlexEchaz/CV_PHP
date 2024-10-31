<?php
define('INCLUDED_FROM_REGISTER', true);
require_once __DIR__ . '/Database/DatabaseConnection.php';

$error = '';
$registration_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $register_email = $_POST['register_email'] ?? '';
    $register_username = $_POST['register_username'] ?? '';
    $register_password = $_POST['register_password'] ?? '';
    $role = isset($_POST['is_admin']) && $_POST['is_admin'] === 'yes' ? 'admin' : 'user';

    if ($register_email && $register_username && $register_password) {
        try {
            $db = DatabaseConnection::getInstance()->getConnection();
            $stmt = $db->prepare('SELECT * FROM User WHERE email = ?');
            $stmt->execute([$register_email]);
            $existingUser = $stmt->fetch();

            if ($existingUser) {
                $registration_error = 'Cet email est déjà utilisé.';
            } else {
                $hashedPassword = password_hash($register_password, PASSWORD_DEFAULT);
                $stmt = $db->prepare('INSERT INTO User (email, userName, password, role) VALUES (?, ?, ?, ?)');
                $stmt->execute([$register_email, $register_username, $hashedPassword, $role]);
                header('Location: LoginPage.php');
                exit;
            }
        } catch (PDOException $e) {
            $registration_error = 'Erreur lors de la création du compte. Veuillez réessayer.';
        }
    } else {
        $registration_error = 'Veuillez remplir tous les champs pour vous inscrire.';
    }
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'enregistrer</title>
    <link rel="stylesheet" href="styleRegister.css">
</head>
<body>
<section class="registration-form">
            <h2>Inscription</h2>
            <?php if ($registration_error): ?>
                <div class="error"><?php echo $registration_error; ?></div>
            <?php endif; ?>
            <form method="POST" action="register.php">
                <input type="hidden" name="register" value="1">
                <div class="form-group">
                    <label for="register_email">Email :</label>
                    <input type="email" id="register_email" name="register_email" required>
                </div>
                <div class="form-group">
                    <label for="register_username">Nom d'utilisateur :</label>
                    <input type="text" id="register_username" name="register_username" required>
                </div>
                <div class="form-group">
                    <label for="register_password">Mot de passe :</label>
                    <input type="password" id="register_password" name="register_password" required>
                </div>
                <div class="form-group">
                    <label>Voulez-vous être administrateur ?</label><br>
                    <label for="is_admin_yes">
                        <input type="radio" id="is_admin_yes" name="is_admin" value="yes"> Oui
                    </label>
                    <label for="is_admin_no">
                        <input type="radio" id="is_admin_no" name="is_admin" value="no" checked> Non
                    </label>
                </div>

                <button type="submit">S'inscrire'</button>
            </form>
        </section>
</body>
</html>