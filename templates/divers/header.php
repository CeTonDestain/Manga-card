<header>
    <h1><a href="./">Manga-Card</a></h1>
</header>
<nav class="banderoleMobile">
            <ul>
                <?php
                if (!isset($_SESSION["username"])) {
                ?>
                    <li><a href="./index.php?page=login_account">se connecter</a></li>
                    <li><a href="./index.php?page=register_account">creer un compte</a></li>
                <?php
                } else {
                ?>
                    <li><a href="./index.php?page=ranking_account">classement</a></li>
                    <li class="deroulant"><a href="#"><?= $_SESSION["username"] ?> ▼</a>
                        <ul class="sous">
                            <li><a href="./index.php?page=profile_account&pseudo=<?= $_SESSION['username'] ?>">mon profil</a></li>
                            <li><a href="./logout.php">se deconnecter</a></li>
                        </ul>
                    </li>
                <?php
                }
                ?>
            </ul>
        </nav>
        <div class="optionMobile">≡</div>