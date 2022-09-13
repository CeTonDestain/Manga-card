<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= "" . DIR_CSS . "duel.css" ?>">
    <title>CardGame | Duel</title>
</head>

<body>
    <header>
        <h1><a href="./">Manga-Card</a></h1>
    </header>
    <?php
    if (!isset($_SESSION["firstTime"])) {
        $_SESSION["firstTime"] = true;
    ?>
        <div id="myModal" class="modal">

            <div class="modal-content">
                <div class="messageContent">
                    <div class="message">
                        Merci d'autoriser le site à diffuser du son
                        sur votre navigateur afin d'avoir
                        la meilleure experience possible
                    </div>
                    <div class="buttonModal">
                        <p class="close">Accepter</p>

                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="animation-content">
    </div>
    <main>
        <audio src="<?= DIR_SON . "soundSelect.mp3" ?>" 
                id="soundSelect" allow="autoplay"></audio>
        <audio src="<?= DIR_SON . "backgroundSound.mp3" ?>" 
                id="soundBackground" allow="autoplay" 
                loop="loop"></audio>
        <h3 class="sectionTitle">Selection du personnage</h3>
        <div class="search">
            <input type="text" id="searchInput" placeholder="Rechercher">
        </div>
        <div class="allcharacter">
            <?php
            foreach ($characters as $character) {
            ?>

                <div class="characterWrapper" id='character' 
                     data-id="<?= $character["id"] ?>">
                    <div class="characterImg">
                        <audio src="<?= DIR_SON_CHARACTER . $character['id'] . ".webm" ?>" 
                        id="voix-<?= $character["id"] ?>"></audio>
                       
                        <img src="<?= DIR_IMAGE_CHARACTER . $character["img"] ?>" 
                         alt="<?= $character["name"] ?>">
                    </div>
                    <div class="characterName">
                        <p><?= $character["name"] ?></p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </main>

    <footer>
        <?php
        if ($totalCard[0] > $limit) {
            $pages = ceil($totalCard[0] / $limit);
        ?>
            <ul class="pagination">
                <?php
                for ($i = 1; $i <= $pages; $i++) {
                ?>
                    <li class="pagination-item <?= $i == $page ? "active" : "" ?>" data-id="<?= $i ?>">
                        <?php
                        if (isset($_GET["q"])) {

                        ?>
                            <?= $i ?>"><?= $i ?>
                        <?php
                        } else {
                        ?>
                            <?= $i ?>
                        <?php
                        }
                        ?>
                    </li>
                <?php
                }
                ?>
            </ul>
        <?php
        }
        ?>
    </footer>
    <script type="module" src=<?= "" . DIR_JS_DUEL . "selectDuel.js" ?>></script>
</body>

</html>