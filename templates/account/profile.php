<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= "" . DIR_CSS . "home.css" ?>">
    <title>Document</title>
</head>

<body>
    <?php
    include(DIR_TEMPLATES_DIVERS . "header.php");
    ?>
    <main>
        <main class="profileMain">
            <div class="profileContainer">
                <div class="textImageContainer">
                    <?php
                    if ($user["pseudo"] === $_SESSION["username"]) {
                    ?>
                        <div class="profileImg">
                            <img src="<?= $profilePicture ?>" alt="">
                            <div class="imgChoseProfile">
                                <img src="<?= DIR_IMAGE ?>icon-picture.svg" alt="changer photo profile">

                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="profileImgOther">
                            <img src="<?= $profilePicture ?>" alt="">
                        </div>
                        <div class="imgChoseProfile"></div>
                    <?php
                    }
                    ?>
                    <div class="textProfile">
                        <div class="pseudoProfile">
                            <h2><?= $user["pseudo"] ?></h2>
                        </div>
                        <div class="bioProfile">
                            <p class="bioProfileText"><?= !isset($user["bio"]) || empty($user["bio"]) ? "pas de bio" : $user["bio"] ?></p>
                            <?php if (isset($error["bio"])) {
                            ?>
                                <p><?= $error["bio"] ?></p>
                            <?php
                            } ?>
                            <?php
                            if ($user["pseudo"] === $_SESSION["username"]) {
                            ?>
                                <div class="bioProfileChange hide">
                                    <form action="" method="post">
                                        <textarea name="bio" id="" cols="30" rows="10"></textarea>
                                        <div class="buttonBioProfileChange">
                                            <button class="CancelBioProfile" type="reset">annuler</button>
                                            <button type="submit">Sauvegarder</button>
                                        </div>
                                    </form>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="bioProfileChange CancelBioProfile"></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div id="myModal" class="modal hide">

            <div class="modal-content">
                <div class="messageContent">
                    <?php
                    foreach ($allImg as $img) {
                    ?>
                        <div class="cardPicture">
                            <img class="profilePicture" src="<?= DIR_IMAGE_CHARACTER . $img["img"] ?>" alt="<?= $img["img"] ?>" data-id="<?= $img["img"] ?>" data-pseudo="<?= trim(strip_tags($_GET["pseudo"])) ?>">
                        </div>

                    <?php
                    }
                    ?>
                    <div class="buttonModal">
                        <p class="close">X</p>

                    </div>
                </div>
            </div>
        </div>
</body>
<script src=<?= "" . DIR_JS_ACCOUNT . "profil.js" ?>></script>

</html>