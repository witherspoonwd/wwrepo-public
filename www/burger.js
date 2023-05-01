function hideNavBox() {
  var x = document.getElementById("navbox");
  var y = document.getElementById("titleBar");
  if (x.style.display === "flex") {
    x.style.display = "none";
    y.style.display = "block";
  } else {
    x.style.display = "flex";
    y.style.display = "none";
  }
}
