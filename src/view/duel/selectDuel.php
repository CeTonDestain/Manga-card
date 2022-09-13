<?php
session_start();

class SelectDuelView
{
    public function __construct(SelectDuelController $controller)
    {
        $this->controller = $controller;
        $this->template = DIR_TEMPLATES_DUEL . "selectduel.php";
    }
    public function render()
    {
        if(!empty($_SESSION["userIp"])){
            if(!isset($_SESSION["username"]) || $_SESSION["userIp"]!=$_SERVER["REMOTE_ADDR"]){
                session_destroy();
                header("LOCATION: ./?page=login_account");
                
            }
        }

        $limit = 10;
        $pages = isset($this->controller->model->p) && !empty($this->controller->model->p) ? $this->controller->model->p : 1;
        $start = isset($this->controller->model->p) && !empty($this->controller->model->p) ? $limit * ($this->controller->model->p - 1) : 0;

        if (isset($_GET["q"])) {
            $searchInput = trim(strip_tags($this->controller->model->q));
            $totalCard=$this->controller->totalCardWithSearch($searchInput);
            $characters=$this->controller->cardWithSearch($searchInput,$limit,$start);
        }else{
            $totalCard=$this->controller->totalCard();
            $characters=$this->controller->card($start,$limit);
        }
        require($this->template);
    }
}
