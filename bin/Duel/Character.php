<?php

class Character
{
    public function __construct(string $name, int $puissance, array $attack, string $type, int $pv,int $esquive,string $img)
    {
        $this->name = $name;
        $this->puissance = $puissance;
        $this->attack = $attack;
        $this->pv = $pv;
        $this->type = $type;
        $this->esquive = $esquive;
        $this->img = $img;


        $this->healthMax=$this->pv;

        $this->eveilBool=false;
        $this->jaugeEveil=0;
        $this->eveilTurn=0;

        $this->boostDamage=false;
        $this->boostDamageTurn=0;
        $this->boostDamageAttente=0;

        $this->boostEsquive=false;
        $this->boostEsquiveTurn=0;
        $this->boostEsquiveAttente=0;


        $this->charaAttente=[];
        $this->healthMaxAttente=0;


    }

}
?>