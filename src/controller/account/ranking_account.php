<?php
class RankingController
{
    public function __construct(RankingModel $model)
    {
        $this->model = $model;
    }

    public function getRanking(){
        $query = $this->model->db->prepare("SELECT pseudo,img,nbr_duel_game,nbr_win_duel_game
                                            FROM `user`
                                            ORDER BY nbr_win_duel_game DESC");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
