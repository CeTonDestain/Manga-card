<?php
class DuelView
{
    public function __construct(DuelController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES_DUEL . "duel.php";
    }
    public function render()
    {
        // importation de la classe
        require(DIR_TEMPLATES_DIVERS . "Character.php");
        session_start();
        $_SESSION["firstTimeEndGame"]=0;

        if(!empty($_SESSION["userIp"])){
            if(!isset($_SESSION["username"]) || $_SESSION["userIp"]!=$_SERVER["REMOTE_ADDR"]){
                session_destroy();
                header("LOCATION: ./?page=login_account");
                
            }
        }
        $i = 0;

        // verification si un petit malin n'a pas changer la valeur dans l'url
        $this->controller->antiCheatId($_GET["id"]);

        if (isset($_GET["attack"])) {

            $this->controller->antiCheatAttack($_SESSION["joueur"]);

            $attackJoueur = trim(strip_tags($this->controller->model->attackJoueur));
            $degatAttackJoueur = $this->controller->degatsAttack($_SESSION["joueur"], $attackJoueur);

            $resumeJoueur = $this->controller->typeOfAttack(
                $_SESSION['joueur'],
                $attackJoueur,
                $degatAttackJoueur,
                $_SESSION["ia"]
            );

            do {
                $iaAttack = rand(0, count($_SESSION["ia"]->attack) - 1);
            } while (($_SESSION["ia"]->attack[$iaAttack]['nbr_use'] <= 0) ||
                ($_SESSION['ia']->attack[$iaAttack]["type"] === "eveil" 
                    && $_SESSION["ia"]->jaugeEveil < $_SESSION["ia"]->puissance * EVEIL_TIMES) ||
                ($_SESSION['ia']->attack[$iaAttack]["type"] === "boost damage" 
                    && $_SESSION["ia"]->boostDamage === true) ||
                ($_SESSION['ia']->attack[$iaAttack]["type"] === "boost esquive" 
                    && $_SESSION["ia"]->boostEsquive === true) ||
                ($_SESSION["ia"]->attack[$iaAttack]["type"] === "sacrifice" 
                    && $_SESSION["ia"]->pv >= $_SESSION["ia"]->healthMax * 25 / 100) ||
                ($_SESSION["ia"]->attack[$iaAttack]["type"] === "heal" 
                    && $_SESSION["ia"]->pv >= $_SESSION["ia"]->healthMax)
            );
            $degatAttackIa = $this->controller->degatsAttack($_SESSION["ia"], $iaAttack);

            $resumeIa = $this->controller->typeOfAttack(
                $_SESSION['ia'],
                $iaAttack,
                $degatAttackIa,
                $_SESSION["joueur"]
            );

            if ($_SESSION["ia"]->pv <= 0) {
                $_SESSION["resultat"] = true;
                header("Location: ./index.php?page=duel_end");
            } else if ($_SESSION["joueur"]->pv <= 0) {
                $_SESSION["resultat"] = false;
                header("Location: ./index.php?page=duel_end");
            }
        } else {

            // creation du personnage du joueur et stockage dans une variable de session
            $idJoueur = trim(strip_tags($this->controller->model->id));
            $characterJoueur = $this->controller->getCharacter($idJoueur);
            $characterJoueurAttack = $this->controller->getAttack($idJoueur);

            $_SESSION["joueur"] = new Character(
                $characterJoueur["name"],
                $characterJoueur["puissance"],
                $characterJoueurAttack,
                $characterJoueur["type"],
                $characterJoueur["pv"],
                $characterJoueur["esquive"],
                $characterJoueur["img"]
            );

            // creation du personnage de l'ia et stockage dans une variable de session
            // import le nombre de personnage puis choisi un au hasard different du personnage du joueur
            $queryNbrChara = $this->controller->model->db->query("SELECT COUNT(id)
                                FROM personnages");
            $nbrChara = $queryNbrChara->fetch();

            do {
                $idIa = rand(1, $nbrChara[0]);
            } while ($idIa == $_GET["id"]);
            $characterIa = $this->controller->getCharacter($idIa);
            $characterIaAttack = $this->controller->getAttack($idIa);

            $_SESSION["ia"] = new Character(
                $characterIa["name"],
                $characterIa["puissance"],
                $characterIaAttack,
                $characterIa["type"],
                $characterIa["pv"],
                $characterIa["esquive"],
                $characterIa["img"]
            );
        }

        require($this->template);
    }
}
