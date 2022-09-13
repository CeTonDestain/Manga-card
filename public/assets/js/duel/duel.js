var resume_joueur = document.getElementById("resume_joueur").innerHTML;
var resume_ia = document.getElementById("resume_ia").innerHTML;
var joueur_carte = document.getElementsByClassName("duelCharacterWrapper")[0];
var ia_carte = document.getElementsByClassName("duelCharacterWrapper")[1];

var attacks=document.querySelectorAll(".eachAttack")

for(const attack of attacks){
    attack.classList.add("forbiddenAttack");
    attack.classList.remove("attackDispo");
    setTimeout(() => {
        attack.classList.remove("forbiddenAttack");
        attack.classList.add("attackDispo");
        attack.addEventListener("click",()=>{
            document.location.href=`./index.php?page=duel&id=${attack.dataset.id}&attack=${attack.dataset.nbr}`
        })
    }, 4000);


}

if (resume_joueur.includes("inflige")) {
    joueur_carte.classList.add("damageForJoueurSucceed")
    ia_carte.classList.add("damageTakenForJoueurSucceed")
    setTimeout(() => {
        joueur_carte.classList.remove("damageForJoueurSucceed")
        ia_carte.classList.remove("damageTakenForJoueurSucceed")
    }, 2000);
}
if (resume_joueur.includes("esquive l'attaque")) {
    joueur_carte.classList.add("damageForJoueurSucceed")
    ia_carte.classList.add("damageEsquiveForJoueurSucceed")
    setTimeout(() => {
        joueur_carte.classList.remove("damageForJoueurSucceed")
        ia_carte.classList.remove("damageEsquiveForJoueurSucceed")
    }, 2000);
}
if (resume_joueur.includes("rate")) {
    joueur_carte.classList.add("actionFailed")
    setTimeout(() => {
        joueur_carte.classList.remove("actionFailed")
    }, 2000);

}
if (resume_joueur.includes("augmente sa puissance")) {
    joueur_carte.classList.add("boostDamage")
    setTimeout(() => {
        joueur_carte.classList.remove("boostDamage")
    }, 2000);
}
if (resume_joueur.includes("augmente son esquive")) {
    joueur_carte.classList.add("boostEsquive")
    setTimeout(() => {
        joueur_carte.classList.remove("boostEsquive")
    }, 2000);
}

if (resume_joueur.includes("se regenere")) {
    joueur_carte.classList.add("heal")
    setTimeout(() => {
        joueur_carte.classList.remove("heal")
    }, 2000);
}
if (resume_joueur.includes("s'eveil")) {
    joueur_carte.classList.add("eveil")
    setTimeout(() => {
        joueur_carte.classList.remove("eveil")
    }, 2000);
}
if (resume_joueur.includes("s'est sacrifié")) {
    joueur_carte.classList.add("sacrifice")
    ia_carte.classList.add("damageTakenForJoueurSucceed")
    setTimeout(() => {
        joueur_carte.classList.remove("sacrifice")
        ia_carte.classList.remove("damageTakenForJoueurSucceed")
    }, 2000);
}


if (resume_ia.includes("inflige")) {
    setTimeout(() => {
        ia_carte.classList.add("damageForIaSucceed")
        joueur_carte.classList.add("damageTakenForJoueurSucceed")
    }, 2000);
    setTimeout(() => {
        ia_carte.classList.remove("damageForIaSucceed")
        joueur_carte.classList.remove("damageTakenForJoueurSucceed")
    }, 4000);
}
if (resume_ia.includes("esquive l'attaque")) {
    setTimeout(() => {
        ia_carte.classList.add("damageForIaSucceed")
        joueur_carte.classList.add("damageEsquiveForIaSucceed")
    }, 2000);
    setTimeout(() => {
        ia_carte.classList.remove("damageForIaSucceed")
        joueur_carte.classList.remove("damageEsquiveForIaSucceed")
    }, 4000);
}
if (resume_ia.includes("rate")) {
    setTimeout(() => {
        ia_carte.classList.add("actionFailed")
    }, 2000);
    setTimeout(() => {
        ia_carte.classList.remove("actionFailed")
    }, 4000);

}
if (resume_ia.includes("augmente sa puissance")) {
    setTimeout(() => {
        ia_carte.classList.add("boostDamage")
    }, 2000);
    setTimeout(() => {
        ia_carte.classList.remove("boostDamage")
    }, 4000);
}
if (resume_ia.includes("augmente son esquive")) {
    setTimeout(() => {
        ia_carte.classList.add("boostEsquive")
    }, 2000);
    setTimeout(() => {
        ia_carte.classList.remove("boostEsquive")
    }, 4000);
}

if (resume_ia.includes("se regenere")) {
    setTimeout(() => {
        ia_carte.classList.add("heal")
    }, 2000);
    setTimeout(() => {
        ia_carte.classList.remove("heal")
    }, 4000);
}
if (resume_ia.includes("s'eveil")) {
    setTimeout(() => {
        ia_carte.classList.add("eveil")
    }, 2000);
    setTimeout(() => {
        ia_carte.classList.remove("eveil")
    }, 4000);
}

if (resume_ia.includes("s'est sacrifié")) {
    setTimeout(() => {
        ia_carte.classList.add("sacrifice")
        joueur_carte.classList.add("damageTakenForJoueurSucceed")
    }, 2000);
    setTimeout(() => {
        ia_carte.classList.remove("sacrifice")
        joueur_carte.classList.remove("damageTakenForJoueurSucceed")
    }, 4000);
}
