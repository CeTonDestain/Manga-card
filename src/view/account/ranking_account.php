<?php
    class RankingView{
        public function __construct(RankingController $controller)
        {
            $this->controller=$controller;
            $this->template=DIR_TEMPLATES_ACCOUNT."ranking.php";
        }
        public function render()
        {
            session_start();
            $_SESSION["firstTimeEndGame"]=1;
            
            if(!empty($_SESSION["userIp"])){
                if(!isset($_SESSION["username"]) || $_SESSION["userIp"]!=$_SERVER["REMOTE_ADDR"]){
                    session_destroy();
                    header("LOCATION: ./?page=login_account");
                    
                }
            }
            $rankingUser=$this->controller->getRanking();
            require($this->template);
        }
    }
?>