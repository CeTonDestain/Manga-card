<?php
    class ProfileView{
        public function __construct(ProfileController $controller)
        {
            $this->controller=$controller;
            $this->template=DIR_TEMPLATES_ACCOUNT."profile.php";
        }
        public function render()
        {
            session_start();

                if(!isset($_SESSION["username"]) || $_SESSION["userIp"]!=$_SERVER["REMOTE_ADDR"]){
                    session_destroy();
                    header("LOCATION: ./?page=login_account");
                    
                }
                if(isset($_GET["pseudo"])){
                    $user=$this->controller->getInfo($this->controller->model->pseudo);

                    if(isset($user["img"])){
                        $profilePicture=DIR_IMAGE_CHARACTER.$user["img"];
                    }else{
                        $profilePicture=DIR_IMAGE . "unknow-profile-pic.webp";
                    }
                    
                    if(isset($_POST["bio"])){
                        $error=[];
                        if(strlen($_POST["bio"])<255){
                            $error["bio"]="la bio ne doit pas depasser 255 caracteres";
                        }
                        $this->controller->setBio();
                        header("Location: ./index.php?page=profile_account&pseudo={$this->controller->model->pseudo}");
                    }
                    if(isset($_GET["profilePicture"])){
                    $this->controller->setImage();
                    header("Location: ./index.php?page=profile_account&pseudo={$this->controller->model->pseudo}");
                    }

                    $allImg=$this->controller->getImage();
                }else{
                    header("Location: ./index.php?page=login_account");
                }
            require($this->template);
        }
    }
?>