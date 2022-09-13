<?php
class LoginController
{
    public function __construct(LoginModel $model)
    {
        $this->model = $model;
    }

    public function verifyEmail($email)
    {
        $query = $this->model->db->prepare("SELECT *
                        from user
                        WHERE email like :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }
    
}
