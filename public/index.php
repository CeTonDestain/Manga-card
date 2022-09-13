<?php
// on cherche  a dev une page index.php qui nous permet de generer n'importe quelle page de notre site 
// si le parametre n'est pas present on genere la page d'accueil par defaut

$page = "home";
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}


// on importe les constantes pour la connexion a la BDD
@require_once("../config/index.php");
$dsn = "mysql:host=" . DB_HOSTNAME . ";dbname=" . DB_DATABASE;;
$db = new PDO($dsn, DB_USERNAME, DB_PASSWORD);

//Tableau qui contient les different pages du site 
$pages = [
    "home" => array(
        "model" => "HomeModel",
        "controller" => "HomeController",
        "view" => "HomeView"
    ),
    "selectduel" => array(
        "model" => "SelectDuelModel",
        "controller" => "SelectDuelController",
        "view" => "SelectDuelView"
    ),
    "duel" => array(
        "model" => "DuelModel",
        "controller" => "DuelController",
        "view" => "DuelView"
    ),
    "duel_end" => array(
        "model" => "DuelEndModel",
        "controller" => "DuelEndController",
        "view" => "DuelEndView"
    ),
    "register_account" => array(
        "model" => "RegisterModel",
        "controller" => "RegisterController",
        "view" => "RegisterView"
    
    ),
    "login_account" => array(
        "model" => "LoginModel",
        "controller" => "LoginController",
        "view" => "LoginView"
    ),
    "reset_account" => array(
        "model" => "ResetModel",
        "controller" => "ResetController",
        "view" => "ResetView"
    ),
    "new_account" => array(
        "model" => "NewModel",
        "controller" => "NewController",
        "view" => "NewView"
    ),
    "profile_account" => array(
        "model" => "ProfileModel",
        "controller" => "ProfileController",
        "view" => "ProfileView"
    ),
    "ranking_account" => array(
        "model" => "RankingModel",
        "controller" => "RankingController",
        "view" => "RankingView"
    )


];

// on parcourt le tableau pour verifier si la page existe reelement 
$find = false;

foreach ($pages as $key => $value) {
    //key contient le nom de la pages et value contien le tableau associatif 
    //avec les infos sur le model le controller et la vue
    if ($page === $key) {
        //nous avons trouver la bonne page a generer
        $find = true;
        

        $model = $value["model"];
        $controller = $value["controller"];
        $view = $value["view"];

        if(str_contains($key,"duel")){
            $compenent='duel';
        }else if(str_contains($key,"account")){
            $compenent='account';
        }else{
            $compenent="";
        }
    }
}

//on importe les differentes classes (ex:HomeModel,HomeController et HomeView)
if ($find) {
    if($compenent==="duel"){
        require( DIR_MODEL_DUEL . $page . ".php");
        require( DIR_CONTROLLER_DUEL  . $page . ".php");
        require( DIR_VIEW_DUEL . $page . ".php");
    }else if($compenent==="account"){
        require( DIR_MODEL_ACCOUNT . $page . ".php");
        require( DIR_CONTROLLER_ACCOUNT  . $page . ".php");
        require( DIR_VIEW_ACCOUNT . $page . ".php");
    }else{
        require(DIR_MODEL  . $page . ".php");
        require(DIR_CONTROLLER . $page . ".php");
        require(DIR_VIEW . $page . ".php");
    }
    //suite a l'import nous avons la possibilité d'instancier les classes 
    $objModel = new $model($db);
    $objController = new $controller($objModel);
    $objView = new $view($objController);

    $objView->render();
}
