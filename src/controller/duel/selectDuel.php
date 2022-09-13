<?php
class SelectDuelController
{
    public function __construct(SelectDuelModel $model)
    {
        $this->model = $model;
    }

    public function totalCard()
    {
        $queryCount = $this->model->db->query("SELECT COUNT(id)
        FROM personnages
        ");
        $totalCard = $queryCount->fetch();
        return $totalCard;
    }

    public function card($start, $limit)
    {
        $query = $this->model->db->query("SELECT personnages.name, personnages.id, personnages.`type`, personnages.img
                    FROM personnages
                    INNER JOIN unnivers
                    ON personnages.unnivers=unnivers.id
                    ORDER BY unnivers.name ASC ,personnages.name ASC
                    LIMIT " . $start . ", " . $limit . "
                     ");
        $characters = $query->fetchAll(PDO::FETCH_ASSOC);
        return $characters;
    }

    public function totalCardWithSearch($searchInput)
    {
        $queryCount = $this->model->db->prepare("SELECT COUNT(personnages.id)
                    FROM personnages
                    INNER JOIN unnivers
                    ON personnages.unnivers=unnivers.id
                    WHERE personnages.name LIKE :name
                    OR unnivers LIKE :name
    ");
        $queryCount->bindValue(":name", "%{$searchInput}%");
        $queryCount->execute();
        $totalCard = $queryCount->fetch();
        return $totalCard;
    }

    public function cardWithSearch($searchInput, $limit, $start)
    {
        $query = $this->model->db->prepare("SELECT personnages.name, personnages.id, personnages.`type`, personnages.img ,unnivers.logo, unnivers.name as unnivers 
        FROM personnages 
        INNER JOIN unnivers
        ON personnages.unnivers=unnivers.id
        WHERE personnages.name LIKE :name
        OR unnivers.name LIKE :name
        ORDER BY unnivers.name ASC ,personnages.name ASC
        LIMIT " . $start . ", " . $limit . "
         ");
        $query->bindValue(":name", "%{$searchInput}%");
        $query->execute();
        $characters = $query->fetchAll(PDO::FETCH_ASSOC);
        return $characters;
    }
}
