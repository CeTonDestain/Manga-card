<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= "" . DIR_CSS . "account.css" ?>>
    <title>Manga-Card | New Password</title>
</head>

<body>
    <header>
        <h1><a href="./">Manga-Card</a></h1>
    </header>
    <main>
        <form action="" method="post">
            <div class="form-group">
                <div class="form-group-input-label">
                    <label for="inputPassword"> nouveau mot de passe</label>
                    <input type="password" id="inputPassword" name="password">
                    <?php if (isset($errors["password"])) {
                    ?>
                        <p><?= $errors["password"] ?></p>
                    <?php
                    } ?>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-input-label">
                    <label for="inputConfirmPassword">confirmation du mot de passe</label>
                    <input type="password" id="inputConfirmPassword" name="retypePassword">
                    <?php if (isset($errors["password"])) {
                    ?>
                        <p><?= $errors["password"] ?></p>
                    <?php
                    } ?>
                </div>
            </div>
            <div class="form-group-button">
                <input type="submit" value="se connecter">
            </div>
        </form>
    </main>
</body>

</html>