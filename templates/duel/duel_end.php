<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?="" .DIR_CSS."duel.css"?>">
    <title>Manga-Card | DUEL end</title>
</head>

<body>
    <header>
        <h1>Manga-Card</h1>
    </header>
    <main>
        <h3 class="sectionTitle">Resultat</h3>
        <div class="resultatContainer">
            <h3 class="sectionTitle"><?= $winner ?></h3>
            <div class="information">
                <div class="resultatCharacterWrapper">
                    <img src="<?=DIR_IMAGE_CHARACTER . $_SESSION["joueur"]->img ?>" alt="<?=$_SESSION["joueur"]->name?>">
                    <div class="characterName">
                        <p><?= $_SESSION["joueur"]->name ?></p>
                    </div>

                </div>
            </div>
        </div>
    </main>
    <footer>
    <div class="backToMenu">
        <a href="./">
                    <p>Retour au menu</p>
                    </a>
                </div>
    </footer>

</body>

</html>