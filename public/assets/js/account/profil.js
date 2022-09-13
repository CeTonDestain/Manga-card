var profilePicture = document.getElementsByClassName("imgChoseProfile")[0];
var modalClose = document.getElementsByClassName("close")[0];

profilePicture.addEventListener("click", () => {
    var modal = document.getElementById("myModal");
    modal.classList.toggle("hide")
})

modalClose.addEventListener("click", () => {
    var modal = document.getElementById("myModal");
    modal.classList.toggle("hide")
})

var profilePicture = document.getElementsByClassName("profilePicture");
for (const picture of profilePicture) {
    picture.addEventListener("click", () => {
        document.location.href = `./index.php?page=profile_account&pseudo=${picture.dataset.pseudo}&profilePicture=${picture.dataset.id}`
    })
}

var bioProfile = document.getElementsByClassName("bioProfileText")[0]
bioProfile.addEventListener("click", () => {
    var bioChange = document.getElementsByClassName("bioProfileChange")[0]
    bioChange.classList.toggle("hide")
})

var cancelBioProfile = document.getElementsByClassName("CancelBioProfile")[0]
cancelBioProfile.addEventListener("click", () => {
    var bioChange = document.getElementsByClassName("bioProfileChange")[0]
    bioChange.classList.toggle("hide")
})

var optionMobile = document.getElementsByClassName("optionMobile")[0];
var banderoleMobile = document.getElementsByClassName("banderoleMobile")[0];
optionMobile.addEventListener('click', () => {
    banderoleMobile.classList.toggle("show");

})
