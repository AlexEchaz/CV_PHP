<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae</title>
    <link rel="stylesheet" href="styleWelcome.css">
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

        <section class = "experience">
            <h2>Expériences professionnelles</h2>
            <div class="job">
                <p>Atuellement aucune, en recherche de stage</p>
            </div>
        </section>

        <section class="education">
            <h2>Formation</h2>
            <div class="school">
                <h3>Baccalauréat</h3>
                <p>2020 - 2023</p>
                <p>Mention Assez Bien</p>
            </div>
        </section>

        <section class="skills">
            <h2>Compétences</h2>
            <ul>
                <li>HTML, CSS, GitHub</li>
                <li>React, JavaScript</li>
                <li>Go, C, C++</li>
            </ul>
        </section>

        <footer>
            <p>&copy; 2024 Alexandre ECHAZARRETA.</p>
        </footer>
    </div>
    

</body>
</html>