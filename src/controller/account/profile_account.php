<?php
class ProfileController
{
    public function __construct(ProfileModel $model)
    {
        $this->model = $model;
    }

    public function getInfo($pseudo)
    {
        $query = $this->model->db->prepare("SELECT * 
                                            FROM user 
                                            WHERE pseudo=:pseudo");
        $query->bindParam(":pseudo", $pseudo);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getImage()
    {
        $query = $this->model->db->query("SELECT img
        FROM personnages
        UNION ALL
        SELECT img from personnages_eveil
        ");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function setImage()
    {
        $query=$this->model->db->prepare("UPDATE user
                                        SET img=:img
                                        where pseudo=:pseudo");
        $query->bindParam(":img",$this->model->profilePicture);
        $query->bindParam(":pseudo",$_SESSION["username"]);
        $query->execute();
    }
    public function setBio()
    {
        $query=$this->model->db->prepare("UPDATE user
                                        SET bio=:bio
                                        where pseudo=:pseudo");
        $query->bindParam(":bio",$this->model->bio);
        $query->bindParam(":pseudo",$_SESSION["username"]);
        $query->execute();
    }
}
