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
    <link rel="stylesheet" href="/views/css/register.css">
</head>

<body>

    <?php require_once __DIR__ . "/inc/header.php" ?>

    <main>
        <form action="/login/startsession" method="POST">
            <?php
            if(session()->get("message") != null) {
            ?>
            <div style="background: <?php echo session()->get("message")["color"] ?>; border-radius: 5px; padding: 10px; display: inline-block; width: calc(100% - 20px);">
                <p style="margin: 0 0 5px 0; float: left">
                    <b style="font-weight: bold; color: rgb(20,20,20);"><?= session()->get("message")["type"] ?></b>
                </p>
                <p style="color: rgb(35, 35, 35); float: left; clear: left"><?= session()->get("message")["data"] ?></p>
            </div>
            <?php session()->set("message", null); } ?>
            <input class="formInput" placeholder="Username" name="username" required type="text">
            <input class="formInput" placeholder="Password" name="password" required type="password">

            <button class="btn" type="submit" style="margin: 15px 0 0 0">Submit</button>
        </form>
    </main>
</body>

</html>