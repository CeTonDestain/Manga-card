<?php

// host
define("HOST", "http://localhost/manga-card-mvc/public/");

//constantes pour la connexion a la base de données
define("DB_HOSTNAME","localhost");
define("DB_USERNAME","root");
define("DB_PASSWORD","");
define("DB_DATABASE","card_game");



// constantes pour fichier
// image
define("DIR_IMAGE","./assets/img/");
define("DIR_IMAGE_CHARACTER",DIR_IMAGE . "characters/");

// son
define("DIR_SON","./assets/son/");
define("DIR_SON_CHARACTER",DIR_SON . "characters/");

// js/css/font
define("DIR_JS","./assets/js/");
// duel
define("DIR_JS_DUEL",DIR_JS."duel/");
define("DIR_JS_ACCOUNT",DIR_JS."account/");

define("DIR_FONT","./assets/font/");
define("DIR_CSS","./assets/css/");

// bin
define("DIR_BIN","../bin/");


// templates
define("DIR_TEMPLATES","../templates/");
//account
define("DIR_TEMPLATES_ACCOUNT",DIR_TEMPLATES . "account/");
//duel
define("DIR_TEMPLATES_DUEL",DIR_TEMPLATES . "duel/");
//divers
define("DIR_TEMPLATES_DIVERS",DIR_TEMPLATES . "divers/");


// sources model view controller
define("DIR_APPLICATION","../src/");
define("DIR_CONTROLLER",DIR_APPLICATION."controller/");
define("DIR_VIEW",DIR_APPLICATION."view/");
define("DIR_MODEL",DIR_APPLICATION."model/");
// account
define("DIR_CONTROLLER_ACCOUNT",DIR_CONTROLLER."account/");
define("DIR_VIEW_ACCOUNT",DIR_VIEW."account/");
define("DIR_MODEL_ACCOUNT",DIR_MODEL."account/");
// duel
define("DIR_CONTROLLER_DUEL",DIR_CONTROLLER."duel/");
define("DIR_VIEW_DUEL",DIR_VIEW."duel/");
define("DIR_MODEL_DUEL",DIR_MODEL."duel/");



// Pour page Duel 
define("VARIATION_DAMAGE",30/100);
define("NBR_TURN_EVEIL",5);
define("EVEIL_TIMES",1);
define("NBR_BOOST_TURN",3);

