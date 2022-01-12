<?php
    $movie = session()->get("movie");
?>

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
    <link rel="stylesheet" href="/views/movieDetails/css/index.css">
</head>

<body>
    <?php require_once __DIR__ . "/../inc/header.php" ?>
    <main>
        <article>
            <img src="/views/img/movie.jpg" alt="movie_cover">
            <a href="#">
                <img src="/views/movieDetails/img/button.png" alt="playbutton">
            </a>
        </article>
        <article>
            <h2 id="title"><?= $movie->title ?></h2>
            <p><?= $movie->duration . "m" ?></p>
            <h2>Actors:</h2>
            <ul>
            <?php foreach($movie->movie_cast_person_ids??[] as $actor) { ?>
                <li><?= $actor->firstname . " " . $actor->lastname ?></li>
            <?php } ?>
            </ul>
            <h2>Directors:</h2> 
            <ul>
            <?php foreach($movie->movie_director_person_ids??[] as $director) { ?>
                <li><?= $director->firstname . " " . $director->lastname ?></li>
            <?php } ?>
            </ul>
        </article>
        <article>
            <h1>In short</h1>
            <p><?= $movie->description ?></p>
        </article>
        <article>
            <?php
                foreach($movie->reviews??[] as $review) {
            ?>
                <div>
                    <h3><?= $review->user->name . " " . $review->user->surname ?></h3>
                    <small>Active since <?= $review->user->createdAt ?></small>
                    <p><?= $review->content ?></p>
                </div>
            <?php } ?>
        </article>
        <video controls width="320" height="240" autoplay >
            <source src="/views/inc/james.mp4" type="video/mp4">
        </video>
    </main>
</body>

</html>