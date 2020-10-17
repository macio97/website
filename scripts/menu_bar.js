function mouseOver() {
  if (screen.width >= 600) {
    document.getElementById("section").style.height = "160px";
    document.getElementById("submenu").style.display = "inline-block";
    document.getElementById("submenu").style.opacity = "100%";
  }
}
function mouseOut() {
  if (screen.width >= 600) {
    document.getElementById("section").style.height = "50px";
    document.getElementById("submenu").style.display = "none";
    document.getElementById("submenu").style.opacity = "0%";
  }
}
function openMenu() {
  if (document.getElementById("hambmenu").checked) {
    document.getElementById("section").style.height = "250px";
  }
  else {
    document.getElementById("section").style.height = "50px";
  }
}
