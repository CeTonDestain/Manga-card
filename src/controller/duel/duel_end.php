<?php
class DuelEndController
{
    public function __construct(DuelEndModel $model)
    {
        $this->model = $model;
    }

    public function endGame($win)
    {

        $query = $this->model->db->prepare("UPDATE user 
                                            SET nbr_duel_game = (nbr_duel_game+1)
                                            WHERE pseudo=:pseudo");
        $query->bindParam(":pseudo", $_SESSION["username"]);
        $query->execute();

        if ($win === true) {
            $query = $this->model->db->prepare("UPDATE user 
            SET nbr_win_duel_game = (nbr_win_duel_game+1)
            WHERE pseudo=:pseudo");
            $query->bindParam(":pseudo", $_SESSION["username"]);
            $query->execute();
        }
    }
}
