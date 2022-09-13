-- creation de la BDD card_game
CREATE DATABASE card_game;
USE card_game;

-- creation de la table unnivers
CREATE TABLE unnivers(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    logo VARCHAR(256) NOT NULL
);

-- creation de la table personnages
CREATE TABLE personnages(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    unnivers INT NOT NULL, 
    type VARCHAR(10),
    pv SMALLINT NOT NULL,
    esquive SMALLINT NOT NULL,
    puissance SMALLINT NOT NULL,
    img VARCHAR(50)
);

-- creation de la table attacks
CREATE TABLE attacks(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    damage SMALLINT NOT NULL,
    type VARCHAR(20) NOT NULL,
    ratage SMALLINT NOT NULL,
    nbr_use SMALLINT NOT NULL,
    eveil INT
);

-- creation de la table personnages_eveil
CREATE TABLE personnages_eveil(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    type VARCHAR(10),
    pv SMALLINT NOT NULL,
    esquive SMALLINT NOT NULL,
    puissance SMALLINT NOT NULL,
    img VARCHAR(50)
);

-- creation de la table personnages_attacks
CREATE TABLE personnages_attacks(
    personnage_id INT,
    attack_id INT,
    PRIMARY KEY (personnage_id,attack_id),
    FOREIGN KEY (personnage_id) REFERENCES personnages(id),
    FOREIGN KEY (attack_id) REFERENCES attacks(id)
);

-- creation de la table personnages_eveil_attacks
CREATE TABLE personnages_eveil_attacks(
    personnage_id INT,
    attack_id INT,
    PRIMARY KEY (personnage_id,attack_id),
    FOREIGN KEY (personnage_id) REFERENCES personnages_eveil(id),
    FOREIGN KEY (attack_id) REFERENCES attacks(id)
);

-- Ajouter les clés étrangeres

ALTER TABLE personnages
ADD CONSTRAINT unnivers
FOREIGN KEY (unnivers) REFERENCES unnivers(id);

ALTER TABLE attacks
ADD CONSTRAINT eveil
FOREIGN KEY (eveil) REFERENCES personnages_eveil(id);


-- ajout d'unnivers

INSERT INTO unnivers
(name,logo)
VALUES
("Dragon ball z","dbz.jpg"),
("Shingeki no kyojin","snk.jpg"),
("Jujutsu kaisen","jjk.jpg"),
("One piece","op.jpg"),
("One punch man","opm.jpg");

-- ajout des personnages

INSERT INTO personnages
(name,type,pv,esquive,puissance,img,unnivers)
VALUES
("Goku","hero",300,15,60,"goku.webp",1),
("TitanColossal","outlaw",500,0,90,"titancolossal.webp",2),
("Gojo","hero",200,25,75,"gojo.webp",3),
("Frieza","outlaw",280,18,65,"frieza.webp",1),
("Yuji","hero",250,15,70,"yuji.webp",3),
("Vegeta","hero",350,10,55,"vegeta.webp",1),
("Luffy","hero",300,15,60,"luffy.webp",4),
("Usopp","hero",150,40,50,"usopp.webp",4),
("Saitama","hero",300,10,90,"saitama.webp",5);


-- ajout des attaques

INSERT INTO attacks
(name,damage,type,ratage,nbr_use)
VALUES
("Kamehameha",50,"damage",20,5),
("kikoha",35,"damage",10,15),
("punch",20,"damage",2,20),
("canon garric",40,"damage",15,5),
("super saiyan 3",0,"eveil",0,1),
("equation imaginaire violet",90,"damage",25,5),
("vide illimite",35,"boost_damage",20,5),
("rayon mortel",70,"damage",20,3),
("double disque mortel",35,"damage",15,5),
("eclair noir",50,"damage",15,5),
("roi des fleaux",0,"eveil",0,1),
("Gomu Gomu no Pistol",40,"damage",5,10),
("Lance-pierres",30,"damage",20,20),
("bombe de tabasco",110,"damage",70,5),
("pichenette",70,"damage",30,5),
("regeneration",40,"heal",25,3);


INSERT INTO personnages_attacks
(personnage_id,attack_id)
VALUES
(1,3),
(1,2),
(1,1),
(1,5),
(2,3),
(2,16),
(3,6),
(3,7),
(4,2),
(4,8),
(4,9),
(5,3),
(5,10),
(5,11),
(6,3),
(6,2),
(6,4),
(7,12),
(8,13),
(8,14),
(9,3),
(9,15);

-- creer un personnage eveil
INSERT INTO personnages_eveil
(name,type,pv,esquive,puissance,img)
VALUES
("Sukuna","outlaw",350,25,140,"sukuna.webp");

-- inserer ses attaques
INSERT INTO attacks
(name,damage,type,ratage,nbr_use)
VALUES
("demantelement",100,"damage",10,5),
("hachis",80,"damage",5,10);

-- lier les attaques avec le personnage
INSERT INTO personnages_eveil_attacks
(personnage_id,attack_id)
VALUES
(1,17),
(1,18);

-- nouveau personnage eveil
INSERT INTO personnages_eveil
(name,type,pv,esquive,puissance,img)
VALUES
("goku SSJ3","hero",350,25,140,"goku_ssj3.webp");

-- insertion nouvelle attaque
INSERT INTO attacks
(name,damage,type,ratage,nbr_use)
VALUES
("Super kamehameha",80,"damage",10,5),
("poing du dragon",150,"damage",5,1),
("deplacement instantanne",0,"boost esquive",15,5),
("enchainement du dragon",60,"damage",0,10),
("autel demoniaque",20,"boost damage",25,1),
("frappe ecrasante ",70,"damage",5,10),
("equation originel bleu",70,"damage",15,10),
("equation inverse rouge",60,"damage",5,15),
("concentration absolue",20,"boost esquive",10,5),
("majin vegeta",0,"eveil",0,1),
("Gomu Gomu no Gatling Gun",70,"damage",15,10),
("gear 2",0,"eveil",0,1),
("gigot de viande",60,"heal",15,3),
("Usopp marteau",70,"damage",15,10),
("Sogeking",0,"eveil",0,1),
("sauts lateraux",33,"boost esquive",15,3),
("forme serieuse",0,"eveil",0,1);

-- mettre le lien entre attaque et personnage
INSERT INTO personnages_eveil_attacks
(personnage_id,attack_id)
VALUES
(2,19),
(2,20),
(2,21),
(2,22),
(1,23),
(1,24);

INSERT INTO personnages_attacks
(personnage_id,attack_id)
VALUES
(3,25),
(3,26),
(5,27),
(6,28),
(7,29),
(7,30),
(7,31),
(8,32),
(8,33),
(9,34),
(9,35);

-- insertion d'attaque
INSERT INTO attacks
(name,damage,type,ratage,nbr_use)
VALUES
("ecrasement",100,"damage",33,5),
("vapeur",70,"damage",20,10);

-- liaison
INSERT INTO personnages_attacks
(personnage_id,attack_id)
VALUES
(2,36),
(2,37);

-- creation perso eveil
INSERT INTO personnages_eveil
(name,type,pv,esquive,puissance,img)
VALUES
("majin vegeta","outlaw",350,25,140,"majin_vegeta.webp"),
("Luffy gear 2","hero",400,15,110,"luffy_gear2.webp"),
("Sogeking","hero",250,60,85,"sogeking.webp"),
("Saitama","hero",300,20,150,"serious_saitama.webp");

-- creation attaque
INSERT INTO attacks
(name,damage,type,ratage,nbr_use)
VALUES
("big bang attack",80,"damage",25,5),
("final flash",100,"damage",25,5),
("prince vegeta",25,"boost damage",15,3),
("impact final",200,"sacrifice",20,2),
("Gomu Gomu no Jet Axe",150,"damage",20,5),
("roi des pirates ",30,"boost esquive",15,3),
("Gomu Gomu no Jet Bazooka",80,"damage",10,5),
("Gomu Gomu no Jet Bullet",95,"damage",15,5),
("Bille Tournesol",100,"damage",20,5),
("Mante Météore",120,"damage",15,5),
("mensonge",33,"boost damage",15,3),
("papillon meteore",150,"damage",33,3),
("frappe bien venere",150,"damage",20,5),
("saut lateraux bien venere",33,"boost esquive",15,3),
("pistolet a eau bien venere",110,"damage",15,5),
("coup de tete bien venere",90,"damage",5,5);


-- attaque
INSERT INTO attacks
(name,damage,type,ratage,nbr_use)
VALUES
("puissance maximal",40,"boost damage",15,2);

INSERT INTO personnages_attacks
(personnage_id,attack_id)
VALUES
(4,54);

INSERT INTO personnages_eveil_attacks
(personnage_id,attack_id)
VALUES
(3,38),
(3,39),
(3,40),
(3,41),
(4,42),
(4,43),
(4,44),
(4,45),
(5,46),
(5,47),
(5,48),
(5,49),
(6,50),
(6,51),
(6,52),
(6,53);

Update attacks
set
eveil=1
Where name="roi des fleaux";

Update attacks
set
eveil=2
Where name="super saiyan 3";

Update attacks
set
eveil=3
Where name="majin vegeta";

Update attacks
set
eveil=4
Where name="gear 2";

Update attacks
set
eveil=5
Where name="Sogeking";

Update attacks
set
eveil=6
Where name="forme serieuse";


INSERT INTO unnivers
(name,logo)
VALUES
("Naruto","nrt.webp");

INSERT INTO personnages
(name,type,pv,esquive,puissance,img,unnivers)
VALUES
("Naruto","hero",250,25,85,"naruto.webp",6),
("Sasuke","outlaw",300,20,90,"sasuke.webp",6);

INSERT INTO personnages_eveil
(name,type,pv,esquive,puissance,img)
VALUES
("Naruto KCM","hero",300,25,110,"naruto_kcm.webp");

insert into attacks
(name,damage,type,ratage,nbr_use)
VALUES
("Rasengan",80,"damage",20,10),
("multi-clonage",33,"boost esquive",15,3),
("lancer de clone",70,"damage",10,10),
("kyuubi chakra",0,"eveil",0,1),
("chidori",80,"damage",20,10),
("sharingan",33,"boost damage",15,3),
("amateratsu",90,"damage",20,5),
("boule de feu supreme",75,"damage",20,10),
("Multi Orbes Tourbillonnants",80,"damage",20,10),
("Orbe des Démons à Queues",110,"damage",30,5),
("Influence du Senjutsu",45,"boost damage",20,3),
("Super-Mini Orbe du Bijû",70,"damage",5,10);

INSERT INTO personnages_attacks
(personnage_id,attack_id)
VALUES
(10,55),
(10,56),
(10,57),
(10,58),
(11,59),
(11,60),
(11,61),
(11,62);

INSERT INTO personnages_eveil_attacks
(personnage_id,attack_id)
VALUES
(7,63),
(7,64),
(7,65),
(7,66);

Update attacks
set
eveil=7
Where name="kyuubi chakra";