<?php
class RegisterController
{
    public function __construct(RegisterModel $model)
    {
        $this->model = $model;
    }
    public function verifyExistingEmail($email)
    {
        $query = $this->model->db->prepare("SELECT *
        from user
        WHERE email like :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function verifyExistingPseudo($pseudo)
    {
        $query = $this->model->db->prepare("SELECT *
        from user
        WHERE pseudo like :pseudo");
        $query->bindParam(":pseudo", $pseudo);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function register($pseudo,$password,$email){
        $query = $this->model->db->prepare("INSERT INTO user
        (pseudo,email,password,nbr_duel_game,nbr_win_duel_game)
        VALUES
        (:pseudo,:email,:password,0,0)");
        $query->bindParam(":pseudo", $pseudo);
        $query->bindParam(":email", $email);
        $query->bindParam(":password", $password);
        $query->execute();
    }
}
