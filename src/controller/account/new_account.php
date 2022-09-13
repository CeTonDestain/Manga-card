<?php
class NewController
{
    public function __construct(NewModel $model)
    {
        $this->model = $model;
    }
    public function ValideToken($token)
    {
        $query = $this->model->db->prepare("SELECT *
        FROM password_reset
        where token LIKE :token");
        $query->bindParam(":token", $token);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function updatePassword($password, $result)
    {
        $query = $this->model->db->prepare("UPDATE user SET password = :password WHERE email = :email");
        $query->bindParam(":password", $password);
        $query->bindParam(":email", $result["email"]);
        $query->execute();
    }

    public function destroyToken($token)
    {
        $query = $this->model->db->prepare("DELETE FROM password_reset
                                            WHERE token=:token");
        $query->bindParam(":token", $token);
        $query->execute();
    }
}
