<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= "" . DIR_CSS . "account.css" ?>>
    <title>Manga-Card | Register</title>
</head>

<body>
    <header>
        <h1><a href="./">Manga-Card</a></h1>
    </header>
    <main>
        <form action="" method="post">
            <div class="form-group">
                <div class="form-group-input-label">
                    <label for="inputPseudo">Pseudo :</label>
                    <input type="text" id="inputPseudo" name="pseudo" value="<?= isset($pseudo) ? $pseudo : "" ?>">
                    <?php if (isset($errors["pseudo"])) {
                    ?>
                        <p><?= $errors["pseudo"] ?></p>
                    <?php
                    } ?>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-input-label">
                    <label for="inputEmail">Email :</label>
                    <input type="email" id="inputEmail" name="email" value="<?= isset($email) ? $email : "" ?>">
                    <?php if (isset($errors["email"])) {
                    ?>
                        <p><?= $errors["email"] ?></p>
                    <?php
                    } ?>
                </div>
                <div class="form-group-input-label">
                    <label for="inputConfirmEmail">Confirmation de l'email :</label>
                    <input type="email" id="inputConfirmEmail" name="ConfirmEmail" value="<?= isset($confirmEmail) ? $confirmEmail : "" ?>">
                    <?php if (isset($errors["ConfirmEmail"])) {
                    ?>
                        <p><?= $errors["ConfirmEmail"] ?></p>
                    <?php
                    } ?>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group-input-label">
                    <label for="inputPassword">Mot de passe :</label>
                    <input type="password" id="inputPassword" name="password" value="<?= isset($password) ? $email : "" ?>">
                    <?php if (isset($errors["password"])) {
                    ?>
                        <p><?= $errors["password"] ?></p>
                    <?php
                    } ?>
                </div>
                <div class="form-group-input-label">
                    <label for="inputRetypePassword">Confirmation du mot de passe :</label>
                    <input type="password" id="inputRetypePassword" name="retypePassword" value="<?= isset($retypePassword) ? $email : "" ?>">
                    <?php if (isset($errors["retypePassword"])) {
                    ?>
                        <p><?= $errors["retypePassword"] ?></p>
                    <?php
                    } ?>
                </div>
            </div>

            <div class="form-group-button">
                <input type="submit" value="creation du compte">
            </div>
        </form>
        <p>compte deja existant ? <a href="./index.php?page=login_account"> se connecter</a></p>
    </main>
</body>

</html>