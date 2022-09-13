<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= "" . DIR_CSS . "account.css" ?>>
    <title>Manga-Card |login</title>
</head>

<body>
    <header>
        <h1><a href="./">Manga-Card</a></h1>
    </header>
    <main>
        <form action="" method="post">
        <p>
        <?= $error
        ?>
        </p>
            <div class="form-group">
                <div class="form-group-input-label">
                    <label for="inputeEmail">Email:</label>
                    <input type="email" name="email" id="inputEmail">
                </div>
            </div>
            <div class="form-group-button">
                <input type="submit" value="se connecter">
            </div>
        </form>
    </main>
</body>

</html>