<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?="" .DIR_CSS."duel.css"?>">
    <title>DUEL</title>
</head>

<body>
    <header>
        <h1><a href="./">Manga-Card</a></h1>
    </header>
    <main>
        <p class="sectionTitle">Duel</p>
        <div class="duelContainer">

            <div class="duelJoueur1CardContainer">
                <div class="duelCharacterWrapper">
                    <img src="<?= DIR_IMAGE_CHARACTER . $_SESSION["joueur"]->img ?>" alt="<?= $_SESSION["joueur"]->name ?>">
                    <div class="characterName">
                        <p><?= $_SESSION["joueur"]->name ?></p>
                    </div>
                </div>
                <progress value="<?= $_SESSION["joueur"]->pv ?>" max="<?= $_SESSION["joueur"]->healthMax ?>"></progress>
            </div>

            <div class="duelResume">
                <p class="vs">VS</p>
                <div class="resumeAttackJoueur">
                    <p class="resumeAttack" id="resume_joueur"><?= isset($_GET["attack"]) ? $resumeJoueur : " " ?>
                    </p>
                    <p class="resumeAttack" id="resume_ia"><?= isset($_GET["attack"]) ? $resumeIa : " " ?>
                    </p>
                </div>
            </div>

            <div class="duelIaCardContainer">
                <div class="duelCharacterWrapper">
                    <img src="<?= DIR_IMAGE_CHARACTER . $_SESSION["ia"]->img  ?>" alt="<?= $_SESSION["ia"]->name ?>">
                    <div class="characterName">
                        <p><?= $_SESSION["ia"]->name ?></p>
                    </div>
                </div>
                <progress value="<?= $_SESSION["ia"]->pv ?>" max="<?= $_SESSION["ia"]->healthMax?>"></progress>
            </div>

        </div>
    </main>
    <footer>
        <div class="attackscontainer">
            <?php
            // permet d'afficher les attaques
            foreach ($_SESSION["joueur"]->attack as $attack) {
                if ($attack["type"] === "boost esquive" &&  $_SESSION["joueur"]->boostEsquive === true) {
            ?>
                    <div class="attack">
                        <div class="attackNonDispo">
                            <p><?= ucfirst($attack['name']) ?></p>
                            <p class="infoAttack"><?= ucfirst($attack['type']) ?> - <?= ucfirst($attack['nbr_use']) ?></p>
                        </div>
                    <?php
                } else if ($attack["type"] === "boost damage" &&  $_SESSION["joueur"]->boostDamage === true) {
                    ?>
                        <div class="attack">
                            <div class="attackNonDispo">
                                <p><?= ucfirst($attack['name']) ?></p>
                                <p class="infoAttack"><?= ucfirst($attack['type']) ?> - <?= ucfirst($attack['nbr_use']) ?></p>
                            </div>
                        <?php
                    }
                    // permet de voir si c'est une attaque eveil si oui la rendre indisponible tant que la jauge eveil n'est pas au max
                    else if ($attack["type"] === "eveil" && $_SESSION["joueur"]->jaugeEveil < $_SESSION["joueur"]->puissance * EVEIL_TIMES) {
                        ?>
                            <div class="attack">
                                <div class="attackNonDispo">
                                    <p><?= ucfirst($attack['name']) ?></p>
                                    <p class="infoAttack"><?= ucfirst($attack['type']) ?> - <?= ucfirst($attack['nbr_use']) ?></p>
                                </div>
                            <?php
                            // permet de verifier si la competance a encore des utilisations disponibles si non bloquer
                        } else if ($attack["nbr_use"] <= 0) {
                            ?>
                                <div class="attack">
                                    <div class="attackNonDispo">
                                        <p><?= ucfirst($attack['name']) ?></p>
                                        <p class="infoAttack"><?= ucfirst($attack['type']) ?> - <?= ucfirst($attack['nbr_use']) ?></p>
                                    </div>
                                <?php
                            } else {
                                ?>
                                    <div class="attack">
                                        <div class="attackDispo eachAttack" data-id="<?= $_GET["id"] ?>" data-nbr="<?= $i ?>">
                                        <!-- "./index.php?page=duel&id=<?= $_GET["id"] ?>&attack=<?= $i ?>" -->
                                                <p><?= ucfirst($attack['name']) ?></p>
                                                <p class="infoAttack"><?= ucfirst($attack['type']) ?> - <?= ucfirst($attack['nbr_use']) ?></p>
                                        </div>
                                    </div>
                            <?php
                            }
                            $i++;
                        }
                            ?>
                                </div>
    </footer>
    <script src=<?="" .DIR_JS_DUEL."duel.js"?>>
    </script>
</body>

</html>