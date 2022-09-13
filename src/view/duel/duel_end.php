<?php
require(DIR_BIN . "Duel/Character.php");
class DuelEndView
{
    public function __construct(DuelEndController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES_DUEL . "duel_end.php";
    }
    public function render()
    {
        session_start();
        if (!empty($_SESSION["userIp"])) {
            if (!isset($_SESSION["username"]) || $_SESSION["userIp"] != $_SERVER["REMOTE_ADDR"]) {
                session_destroy();
                header("LOCATION: ./?page=login_account");
            }
        }
        if ($_SESSION["resultat"] === true) {
            $winner = "Bravo tu as gagné";

            if (!empty($_SESSION["userIp"]) && $_SESSION["firstTimeEndGame"]==0) {
                $this->controller->endGame(true);
                $_SESSION["firstTimeEndGame"]=1;
            }
        } else {
            $winner = "Tu as perdu";
            if (!empty($_SESSION["userIp"]) && $_SESSION["firstTimeEndGame"]==0) {
                $this->controller->endGame(false);
                $_SESSION["firstTimeEndGame"]=1;
            }
        }

        require($this->template);
    }
}
