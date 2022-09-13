<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?= "" . DIR_CSS . "home.css" ?>>
    <title>Manga-Card | Classement</title>
</head>

<body>
    <?php
    include(DIR_TEMPLATES_DIVERS . "header.php");
    ?>
    <main>
        <h3 class="sectionTitle">Classement</h3>

        <table class="rankingTable">
            <tr>
                <th>#</th>
                <th>nom</th>
                <th>victoire</th>
                <th>ratio</th>
            </tr>
            <?php
            $count = 0;
            foreach ($rankingUser as $rankUser) {
            ?>
                <tr>
                    <td><?= $count += 1 ?></td>
                    <td class="profileTable" data-id="<?= $rankUser["pseudo"] ?>">
                        <div class="containerImgPseudoTable">
                            <img src="<?= DIR_IMAGE_CHARACTER . $rankUser["img"] ?>" alt="<?= $rankUser["img"] ?>"><?= $rankUser["pseudo"] ?>
                        </div>
                    </td>
                    <td><?= $rankUser["nbr_win_duel_game"] ?></td>
                    <td><?= $rankUser["nbr_duel_game"] == 0 ?
                            0 :
                            ceil(($rankUser["nbr_win_duel_game"] / $rankUser["nbr_duel_game"]) * 100) ?>%</td>
                </tr>
            <?php
            }
            ?>
        </table>
    </main>
    <script>
        const tableToProfile = document.querySelectorAll(".profileTable")
        for (const profile of tableToProfile) {
            profile.addEventListener("click", () => {
                document.location.href = `http://localhost/manga-card-mvc/public/index.php?page=profile_account&pseudo=${profile.dataset.id}`
            })
        }
    </script>
</body>

</html>