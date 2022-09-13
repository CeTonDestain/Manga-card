async function getLocalStream() {
    await navigator.mediaDevices.getUserMedia({ video: false, audio: true })
        .then(() => {

            if (soundBackground.duration < sessionStorage.getItem("temps")) {
                sessionStorage.clear()
            }
            if (sessionStorage.length != 0) {
                soundBackground.currentTime = parseFloat(sessionStorage.getItem("temps"));
                soundBackground.play()
                soundBackground.volume = 0.2;
            } else {
                soundBackground.play()
                soundBackground.volume = 0.2;
            }
        }).catch(err => {
            console.log("u got an error:" + err)
        });
}
function movingCardPart1(elem) {
    var left = parseInt(css(elem, "left"), 0),
        rotate = parseInt(0, 0),
        dx = left - (-150),
        dr = rotate - (-90),
        i = 1,
        count = 25,
        delay = 20;

    function loop() {
        if (i >= count) { return; }
        i += 1;
        elem.style.left = (left - (dx * i / count)).toFixed(0) + '%';
        elem.style.transform = `rotate(${(rotate - (dr * i / count))}deg)`;
        setTimeout(loop, delay);
    }
    loop();
    function css(element, property) {
        return window.getComputedStyle(element, null).getPropertyValue(property);
    }
}


function movingCardPart2(elem) {
    elem.style.position = "fixed";
    var left = parseInt(-50, 0),
        top = parseInt(-50, 0),
        scale = parseInt(0, 0),
        rotate = parseInt(0, 0),
        i = 1,
        count = 25,
        delay = 20;
    elem.style.zIndex = "5";
    if (window.innerWidth <= "768") {
        var dx = left - 20,
            dy = top - 20,
            dz = scale - 1.0,
            dr = rotate - 720;
    } else {
        var dx = left - 40,
            dy = top - 30,
            dz = scale - 1.4,
            dr = rotate - 720;
    }

    function loop() {
        if (i >= count) { return; }
        i += 0.5;
        elem.style.left = (left - (dx * i / count)).toFixed(0) + '%';
        elem.style.top = (top - (dy * i / count)).toFixed(0) + '%';
        elem.style.transform = `scale(${(scale - (dz * i / count))}) rotate(${(rotate - (dr * i / count))}deg)`;

        setTimeout(loop, delay);
    }

    loop();
    setTimeout(() => { elem.classList.add("halo_aura") }, 1240);
}

function getTimeSpent(start) {
    let end = new Date().getTime();
    if (sessionStorage.length != 0) {
        let sessionTime = sessionStorage["temps"];
        sessionStorage.clear()
        let totalTime = parseInt(sessionTime) + (end - start) / 1000;
        sessionStorage.setItem("temps", totalTime);
    } else {
        let totalTime = (end - start) / 1000;
        sessionStorage.setItem("temps", totalTime);
    }

}
var soundSelect = document.getElementById("soundSelect")

var soundBackground = document.getElementById("soundBackground");
const start = new Date().getTime();
getLocalStream();

var firstTime = false;

const characters = document.querySelectorAll("#character");
for (const character of characters) {

    character.addEventListener("mouseenter", () => {
        if (!firstTime) {
            soundSelect.volume = 0.5;
            soundSelect.play()
        }
    })

    character.addEventListener("mouseleave", () => {
        if (!firstTime) {
            soundSelect.pause();
            soundSelect.currentTime = 0;
        }
    })

    character.addEventListener("click", () => {
        if (!firstTime) {
            firstTime = true;
            var modal = document.getElementsByClassName("animation-content")[0];
            modal.style = "display:block";
            character.style.zIndex = 1;

            movingCardPart1(character)
            setTimeout(() => { movingCardPart2(character) }, 700);
            var soundVoix = document.getElementById(`voix-${character.dataset.id}`)
            setTimeout(() => {
                soundBackground.volume = 0.1;
                soundVoix.play()
            }, 1400)


            setTimeout(() => {
                getTimeSpent(start);
                document.location.href = `./index.php?page=duel&id=${character.dataset.id}`
            }, 1400 + (soundVoix.duration * 1000))
        }


    })
}

const paginations = document.querySelectorAll(".pagination-item")

for (const page of paginations) {
    page.addEventListener("click", () => {
        getTimeSpent(start);

        document.location.href = `./index.php?page=selectduel&p=${page.dataset.id}`

    })
}


var modal = document.getElementById("myModal");
var closeModal = document.getElementsByClassName("close")[0];
if (closeModal) {
    closeModal.onclick = function () {
        modal.style.display = "none";

    }
}

var searchInput = document.getElementById("searchInput");
searchInput.addEventListener("keyup", e => {
    getTimeSpent(start)
    if (e.keyCode === 13) {
        e.preventDefault();
        if (e.target.value === "") {

            document.location.href = `./index.php?page=selectduel`
        } else {

            document.location.href = `?page=selectduel&q=${e.target.value}`;
        }
    }
})
