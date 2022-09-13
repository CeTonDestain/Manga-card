<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= "" . DIR_CSS . "home.css" ?>">
    <title>Manga-Card</title>
</head>

<body>
    <?php
    include(DIR_TEMPLATES_DIVERS . "header.php");
    ?>

    <main>
        <div class="modeDeJeuContainer">

            <div class="mode" id="duel" data-id="selectDuel" data-login="<?= !empty($_SESSION['username']) ? $_SESSION['username'] : '0' ?>">
                <div class="duelTitle">
                    <h3>VS</h3>
                </div>
                <div class="duelDescription">
                    <p class="titre">Mode Duel</p>
                    <p class="description">1v1 contre l'ia</p>
                </div>
            </div>
        </div>
    </main>
    <div id="myModal" class="modal hide">

        <div class=" modalHome modal-content">
            <div class="messageContent">
                <div class="modalChoiceContainer">
                    <div><a href="./index.php?page=login_account">
                            <p>Se connecter</p>
                        </a></div>
                    <div><a href="./index.php?page=selectduel">
                            <p>Invite</p>
                        </a></div>
                </div>
                <div class="buttonModal">
                    <p class="close">X</p>

                </div>
            </div>
        </div>
    </div>
</body>
<script src=<?= "" . DIR_JS . "home.js" ?>></script>

</html>