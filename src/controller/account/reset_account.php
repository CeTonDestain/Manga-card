<?php
class ResetController
{
    public function __construct(ResetModel $model)
    {
        $this->model = $model;
    }

    public function VerifEmail($email){
        $query = $this->model->db->prepare("SELECT *
                            from user
                            WHERE email like :email");
    $query->bindParam(":email", $email);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    return $result;
    }
    public function sendToken($token,$email,$validity){
        $query = $this->model->db->prepare("INSERT INTO password_reset
                                (email,token,validity)
                                VALUES
                                (:email,:token,:validity)");
        $query->bindParam(":email", $email);
        $query->bindParam(":token", $token);
        $query->bindParam(":validity", $validity);
        $query->execute();
        return $query->execute();
    }
}
