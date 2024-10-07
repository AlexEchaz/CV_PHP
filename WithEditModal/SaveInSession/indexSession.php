<?php

session_start();

$defaultName = "Alexandre ECHAZARRETA";
$defaultJob = "étudiant";
$defaultEmail = "alexandre.echazarreta@ynov.com";
$defaultDescription = "étudiant en informatique très motivé, actuellement en recherche de stage";

if (!isset($_SESSION['name'])) {
    $_SESSION['name'] = "Alexandre ECHAZARRETA";
    $_SESSION['job'] = "étudiant";
    $_SESSION['email'] = "alexandre.echazarreta@ynov.com";
    $_SESSION['description'] = "étudiant en informatique très motivé, actuellement en recherche de stage";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['job'] = $_POST['title'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['description'] = $_POST['description'];
}?>

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
            <h1><?php echo $_SESSION['name']; ?></h1>
            <p><?php echo $_SESSION['job']; ?></p>
            <p><?php echo $_SESSION['email']; ?></p>
            <button id="editPersonalInfo">Edit Personal Info</button>
        </header>

        <section class = "profile">
            <h2>Profil</h2>
            <p><?php echo $_SESSION['description']; ?></p>
        </section>

        <div id = "myModal" class = "modal">
            <div class = "modalContent">
                <span class="close">&times;</span>
                <h2>Personal Informations</h2>
                <form method="POST" action=""></form>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $_SESSION['name']; ?>" required>

                    <label for="job">Job:</label>
                    <input type="text" id="job" name="job" value="<?php echo $_SESSION['job']; ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" required>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required><?php echo $_SESSION['description']; ?></textarea>

                    <input type="submit" value="Save Changes">
                </form>
            </div>
        </div>

        <footer>
            <p>&copy; Alexandre ECHAZARRETA 2024</p>
        </footer>
    </div>
    
</body>