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
            <h2 id="title">NO TIME TO DIE</h2>
            <p>1h 53m</p>
            <h2>Actors:</h2>
            <ul>
                <li><?= $movie->title ?></li>
            </ul>
            <h2>Directors:</h2> 
            <ul>
            <?php foreach($movie->directors as $director) { ?>
                <li><?= $director->name . " " . $director->surname ?></li>
            <?php } ?>
            </ul>
        </article>
        <article>
            <h1>In short</h1>
            <p><?= $movie->description ?></p>
        </article>
        <article>
            <div>
                <h3>User123 Test</h3>
                <small>6 years active on this platform</small>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas ut obcaecati molestias, in iure vel, magnam, eum magni quod pariatur voluptate cum nostrum non fugit vitae deleniti corrupti delectus repellendus?</p>
            </div>
            <div>
                <h3>User123</h3>
                <small>6 years active on this platform</small>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas ut obcaecati molestias, in iure vel, magnam, eum magni quod pariatur voluptate cum nostrum non fugit vitae deleniti corrupti delectus repellendus?</p>
            </div>
            <div>
                <h3>User123</h3>
                <small>6 years active on this platform</small>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas ut obcaecati molestias, in iure vel, magnam, eum magni quod pariatur voluptate cum nostrum non fugit vitae deleniti corrupti delectus repellendus?</p>
            </div>
            <div>
                <h3>User123</h3>
                <small>6 years active on this platform</small>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas ut obcaecati molestias, in iure vel, magnam, eum magni quod pariatur voluptate cum nostrum non fugit vitae deleniti corrupti delectus repellendus?</p>
            </div>
        </article>
    </main>
</body>

</html>