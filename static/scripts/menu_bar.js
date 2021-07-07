// @license magnet:?xt=urn:btih:1f739d935676111cfff4b4693e3816e664797050&dn=gpl-3.0.txt GPL-v3-or-Later

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
    document.getElementById("section").style.height = "280px";
  }
  else {
    document.getElementById("section").style.height = "50px";
  }
}

// @license-end