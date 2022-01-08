<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FletNix</title>

    <!-- Reset browser css -->
    <link rel="stylesheet" href="/views/css/reset.css">

    <link rel="stylesheet" href="/views/css/index.css">
    <link rel="stylesheet" href="/views/css/home.css">
</head>

<body>
    <?php require_once __DIR__ . "/inc/header.php"; ?>
    <main>
        <?php foreach(session()->get("movies")??[] as $key=>$movie) { ?>
        <article>
            <div>
                <a href="/movieDetails/<?= $key ?>">
                    <h2><?= $movie->title ?></h2>
                    <p>Genre: <?= $movie->genre ?></p> 
                    <p>Duration: <?= $movie->durationString ?></p>
                    <span>
                        Publicatiejaar: <?= $movie->releaseYear ?> <br><br>
                        Acteurs: <br>
                        <?php
                            foreach($movie->movieActors??[] as $movieActor) {
                                echo $movieActor->name . " " . $movieActor->surname;
                            }
                        ?>
                    </span>
                </a>
            </div>
        </article>
        <?php } ?>
    </main>
</body>

</html>