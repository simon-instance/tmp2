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
                    <p>Genre: <?= $movie->genres[0]??null ?></p> 
                    <p>Duration: <?= $movie->duration . "m" ?></p>
                    <span>
                        Publicatiejaar: <?= $movie->publication_year ?> <br><br>
                        Acteurs: <br>

                        <?php if(count($movie->movie_cast_person_ids??[]) > 5) { ?>
                        <?php
                            for($i = 0; $i < 5; $i++) {
                        ?>
                        <?= $movie->movie_cast_person_ids[$i]->firstname . " " . $movie->movie_cast_person_ids[$i]->lastname ?> <br>
                        <?php } ?>
                            And <?= count($movie->movie_cast_person_ids) - 5 ?> more...
                        <?php } ?>
                    </span>
                </a>
            </div>
        </article>
        <?php } ?>
    </main>
</body>

</html>