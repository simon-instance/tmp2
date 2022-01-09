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
        <form action="/register/create" method="POST">
            <input class="formInput" placeholder="Name" required name="name" type="text">
            <input class="formInput" placeholder="Surname" required name="surname" type="text">
            <input class="formInput" placeholder="Country" required name="country" type="text">
            <input class="formInput" placeholder="Year of birth" required name="birthyear" type="text">
            <input class="formInput" placeholder="Bank account S.No" required name="iban" type="text">
            <input class="formInput" placeholder="Username" name="username" required type="text">
            <input class="formInput" placeholder="Password" name="password" required type="password">
            <input class="formInput" placeholder="Confirm password" name="confirmPassword" required type="password">

            <select class="formInput" name="subscription" required>
                <option value="1">sub1</option>
                <option value="2">sub2</option>
                <option value="3">sub3</option>
            </select>
            <small>
                <a href="subscription.html" target="_blank">See the contents</a>
                of all subscriptions
            </small>

            <label for="agreement">You consent to our <a href="privacy.html">privacy policy</a> </label>
            <input class="formInput" name="agreement" id="agreement" required type="checkbox">
            <input class="btn" name="submit" type="submit">
        </form>
    </main>
</body>

</html>