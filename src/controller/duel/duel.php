<?php
class DuelController
{
    public function __construct(DuelModel $model)
    {
        $this->model = $model;
    }

    public function antiCheatId($id)
    {
        $queryCheckCheat = $this->model->db->prepare("SELECT id
        FROM personnages
        WHERE id=:id");
        $queryCheckCheat->bindParam(":id", $id, PDO::PARAM_INT);
        $queryCheckCheat->execute();
        $checkIdChara = $queryCheckCheat->fetch();

        if (!$checkIdChara) {
            header("LOCATION: ./");
        }
    }
    public function antiCheatAttack($joueur)
    {
        if (
            ($joueur->attack[$_GET["attack"]]["nbr_use"] <= 0) ||
            ($joueur->attack[$_GET["attack"]]["type"] === "eveil" &&
                $joueur->jaugeEveil < $joueur->puissance * EVEIL_TIMES) ||
            ($joueur->attack[$_GET["attack"]]["type"] === "boost damage" 
                && $joueur->boostDamage === true) ||
            ($joueur->attack[$_GET["attack"]]["type"] === "boost esquive" 
                && $joueur->boostEsquive === true)
        ) {
            header("LOCATION: ./");
        }
    }
    // ici on importe le personnage
    public function getCharacter($id)
    {
        $query = $this->model->db->prepare("SELECT *
                               FROM personnages
                               WHERE id= :id");
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
        $character = $query->fetch();
        return $character;
    }

    // et la ce sont les attaques
    public function getAttack($id)
    {
        $query = $this->model->db->prepare("SELECT personnage_id,attacks.name,attacks.damage,attacks.`type`, 
                               attacks.ratage,attacks.nbr_use,attacks.eveil  
                               FROM personnages_attacks
                               INNER JOIN attacks
                               ON attack_id = attacks.id 
                               WHERE personnage_id= :id");
        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->execute();
        $characterAttack = $query->fetchAll(PDO::FETCH_ASSOC);
        return $characterAttack;
    }

    public function degatsAttack($personnage, $idAttack)
    {
        $attackSelected = $personnage->attack[$idAttack]["damage"] * ($personnage->puissance / 100);
        $degatAttack = ceil(rand(
            $attackSelected - $attackSelected * VARIATION_DAMAGE,
            $attackSelected + $attackSelected * VARIATION_DAMAGE
        ));

        // enleve un point de competance au joueur quand l'attaque est utilisé
        $personnage->attack[$idAttack]["nbr_use"] -= 1;
        return $degatAttack;
    }

    public function getCharacterEveil($personnage, $idAttack)
    {
        $query = $this->model->db->prepare("SELECT *
                                        FROM personnages_eveil
                                        WHERE id=:id");
        $query->bindParam(":id", $personnage->attack[$idAttack]["eveil"], PDO::PARAM_INT);
        $query->execute();
        $eveilChara = $query->fetch(PDO::FETCH_ASSOC);
        return $eveilChara;
    }

    public function getAttackEveil($personnage, $idAttack)
    {
        $query = $this->model->db->prepare("SELECT personnage_id,attacks.name,attacks.damage,attacks.`type`, 
                                            attacks.ratage,attacks.nbr_use,attacks.eveil  
                                            FROM personnages_eveil_attacks
                                            INNER JOIN attacks
                                            ON attack_id = attacks.id 
                                            WHERE personnage_id= :id");
        $query->bindParam(":id", $personnage->attack[$idAttack]["eveil"], PDO::PARAM_INT);
        $query->execute();
        $eveilCharaAttack = $query->fetchAll(PDO::FETCH_ASSOC);
        return $eveilCharaAttack;
    }

    public function typeOfAttack($personnage, $idAttack, $degatAttack, $adversaire)
    {
        switch ($personnage->attack[$idAttack]["type"]) {

            case "damage":
                // premier if gere si l'ia a esquivé l'attaque
                if (floor(rand(0, 100)) < $adversaire->esquive) {
                    // resumer de l'action
                    $resume = "{$personnage->name} a utilisé {$personnage->attack[$idAttack]["name"]} 
                    mais {$adversaire->name} esquive l'attaque";
                } else {
                    // deuxieme if gere si le joueur a rater son attaque
                    if (floor(rand(0, 100) > $personnage->attack[$idAttack]["ratage"])) {
                        // retire les pv a l'ia
                        $adversaire->pv -= $degatAttack;

                        // resumer de l'action
                        $resume = "{$personnage->name} a utilisé {$personnage->attack[$idAttack]["name"]} 
                    et inflige {$degatAttack} degats à {$adversaire->name}";

                        // augmente la jauge d'eveil 
                        $personnage->jaugeEveil += $degatAttack;
                    } else {
                        // resumer de l'action
                        $resume = "{$personnage->name} a utilisé {$personnage->attack[$idAttack]["name"]} 
                    mais rate lamentablement son attaque";
                    }
                }
                break;

            case "heal":
                // premier if gere si le joueur a rater son attaque
                if (floor(rand(0, 100) > $personnage->attack[$idAttack]["ratage"])) {
                    // rajout de la vie au joueur
                    $personnage->pv + $degatAttack > $personnage->healthMax ? $personnage->pv = $personnage->healthMax
                        : $personnage->pv += $degatAttack;

                    // resumer de l'action
                    $resume = "{$personnage->name} a utilisé {$personnage->attack[$idAttack]["name"]} 
                    et se regenere {$degatAttack} pv";
                } else {
                    // resumer de l'action
                    $resume = "{$personnage->name} a utilisé {$personnage->attack[$idAttack]["name"]} 
                    mais rate lamentablement son attaque";
                }
                break;

            case "eveil":
                // transfert les données du joueur vers une autre variable d'attente durant l'eveil
                $personnage->charaAttente = clone ($personnage);

                // importe le nouveau personnage de type eveil
                $eveilChara = $this->getCharacterEveil($personnage, $idAttack);
                $eveilCharaAttack = $this->getAttackEveil($personnage, $idAttack);

                // remplace tous les données par le nouveau personnage
                $personnage->name = $eveilChara["name"];
                $personnage->puissance = $eveilChara["puissance"];
                $personnage->attack = $eveilCharaAttack;
                $personnage->type = $eveilChara["type"];
                $personnage->pv = $eveilChara["pv"];
                $personnage->esquive = $eveilChara["esquive"];
                $personnage->img = $eveilChara["img"];
                $personnage->healthMaxAttente = $personnage->healthMax;
                $personnage->healthMax = $personnage->pv;
                // permet de savoir si c'est un perso eveil ou non
                $personnage->eveilBool = true;
                $personnage->eveilTurn = 0;

                //Annuler le boost si il y en a un
                if ($personnage->boostDamage === true) {
                    $personnage->charaAttente->puissance = $personnage->boostDamageAttente;
                    $personnage->boostDamage = false;
                }
                if ($personnage->boostEsquive === true) {
                    $personnage->charaAttente->esquive = $personnage->boostEsquiveAttente;
                    $personnage->boostEsquive = false;
                }

                $resume = "{$personnage->charaAttente->name} s'eveil ! {$personnage->name} arrive sur le terrain";
                break;
            case "boost damage":
                $personnage->boostDamageTurn = 0;
                $personnage->boostDamage = true;

                $personnage->boostDamageAttente = $personnage->puissance;
                $personnage->puissance += $personnage->puissance * $personnage->attack[$idAttack]["damage"] / 100;

                $resume = "{$personnage->name} augmente sa puissance de {$personnage->boostDamageAttente} à {$personnage->puissance} pendant " . NBR_BOOST_TURN . " tours";
                break;
            case "boost esquive":
                $personnage->boostEsquiveTurn = 0;
                $personnage->boostEsquive = true;

                $personnage->boostEsquiveAttente = $personnage->esquive;
                $personnage->esquive += $personnage->esquive * $personnage->attack[$idAttack]["damage"] / 100;

                $resume = "{$personnage->name} augmente son esquive de {$personnage->boostEsquiveAttente} à {$personnage->esquive} pendant " . NBR_BOOST_TURN . " tours";
                break;
            case "sacrifice":
                if (floor(rand(0, 100) < $personnage->attack[$idAttack]["ratage"])) {
                    $resume = "{$personnage->name} a utilisé {$personnage->attack[$idAttack]["name"]} 
                    mais rate lamentablement son attaque";
                } else {
                    $personnage->pv = 1;
                    if (floor(rand(0, 100)) > $adversaire->esquive) {
                        $adversaire->pv -= $degatAttack;
                        // resumer de l'action
                        $resume = "{$personnage->name} s'est sacrifié, il reduit ses pv à 1 et inflige {$degatAttack} ";
                    } else {
                        $resume = "{$personnage->name} s'est sacrifié mais {$adversaire->name} a esquivé l'attaque ";
                    }
                }
            default:
                break;
        }


        //si boost esquive 
        if ($personnage->boostEsquive === true) {
            $personnage->boostEsquiveTurn += 1;
            if ($personnage->boostEsquiveTurn >= NBR_BOOST_TURN) {
                $personnage->esquive = $personnage->boostEsquiveAttente;

                // reinitialise tout 
                $personnage->boostEsquive = false;
            }
        }
        //si boost damage on compte le nombre de tour
        if ($personnage->boostDamage === true) {
            $personnage->boostDamageTurn += 1;
            if ($personnage->boostDamageTurn >= NBR_BOOST_TURN) {
                $personnage->puissance = $personnage->boostDamageAttente;

                // reinitialise tout 
                $personnage->boostDamage = false;
            }
        }
        // si il y a un eveil on compte le nombre de tour
        if ($personnage->eveilBool === true) {
            $personnage->eveilTurn += 1;

            // si le nombre de tour est sup au nombre renseigne alors on remplace le perso eveil par le perso de base
            if ($personnage->eveilTurn >= NBR_TURN_EVEIL) {
                $personnage->name = $personnage->charaAttente->name;
                $personnage->puissance = $personnage->charaAttente->puissance;
                $personnage->attack = $personnage->charaAttente->attack;
                $personnage->type = $personnage->charaAttente->type;
                $personnage->pv = ($personnage->charaAttente->pv + $personnage->charaAttente->pv * 30 / 100) > $personnage->healthMaxAttente ?
                    $personnage->healthMaxAttente : ($personnage->charaAttente->pv + $personnage->charaAttente->pv * 30 / 100);
                $personnage->esquive = $personnage->charaAttente->esquive;
                $personnage->img = $personnage->charaAttente->img;
                $personnage->healthMax = $personnage->healthMaxAttente;

                // plus besoin de rentrer dans la boucle
                $personnage->eveilBool = false;

                //re-initialisation de la barre d'eveil
                $personnage->jaugeEveil = 0;
            }
        }

        return $resume;
    }
}
