var modeDuel = document.getElementById("duel");

modeDuel.addEventListener('click', () => {

  if (modeDuel.dataset.login == 0) {

    var modal = document.getElementById("myModal");
    modal.classList.toggle("hide")
  
  
  } else {
    document.location.href = `./index.php?page=selectduel`
  }
})

var modalClose=document.getElementsByClassName("close")[0];
modalClose.addEventListener("click",()=>{
  var modal=document.getElementById("myModal");
  modal.classList.toggle("hide")
})

var optionMobile=document.getElementsByClassName("optionMobile")[0];
var banderoleMobile=document.getElementsByClassName("banderoleMobile")[0];
optionMobile.addEventListener('click',()=>{
  banderoleMobile.classList.toggle("show");

})
