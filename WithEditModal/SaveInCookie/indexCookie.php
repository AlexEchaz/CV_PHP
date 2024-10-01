<?php
$defaultName = "Alexandre ECHAZARRETA";
$defaultJob = "étudiant";
$defaultEmail = "alexandre.echazarreta@ynov.com";
$defaultDescription = "étudiant en informatique très motivé, actuellement en recherche de stage";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    setcookie('name', $_POST['name'], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie('job', $_POST['job'], time() + (86400 * 30), "/");
    setcookie('email', $_POST['email'], time() + (86400 * 30), "/");
    setcookie('description', $_POST['description'], time() + (86400 * 30), "/");
    // Reload the page to update cookie values
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$name = isset($_COOKIE['name']) ? $_COOKIE['name'] : $defaultName;
$title = isset($_COOKIE['title']) ? $_COOKIE['title'] : $defaultJob;
$email = isset($_COOKIE['email']) ? $_COOKIE['email'] : $defaultEmail;
$description = isset($_COOKIE['description']) ? $_COOKIE['description'] : $defaultDescription;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
        $name = "Alexandre ECHAZARRETA";
        $job = "étudiant";
        $email = "alexandre.echazarreta@ynov.com";
        $description = "étudiant en informatique très motivé, actuellement en recherche de stage";
    ?>

    <div class = "container">
        <header>
            <h1><?php echo $name; ?></h1>
            <p><?php echo $job; ?></p>
            <p><?php echo $email; ?></p>
        </header>

        <section class = "profile">
            <h2>Profil</h2>
            <p><?php echo $description; ?></p>
        </section>

        <div id = "myModal" class = "modal">
            <div class = "modalContent">
                <span class="close">&times;</span>
                <h2>Personal Informations</h2>
                <form method="POST" action=""></form>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

                    <label for="job">Job:</label>
                    <input type="text" id="job" name="job" value="<?php echo $job; ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required><?php echo $description; ?></textarea>

                    <input type="submit" value="Save Changes">
                </form>
            </div>
        </div>

        <footer>
            <p>&copy; 2024 Alexandre ECHAZARRETA.</p>
        </footer>
    </div>
    
</body>