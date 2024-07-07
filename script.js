var button = document.getElementById("myButton");
var div = document.getElementById("profile");
var isVisible = false;

function toggleDiv() {
    if (isVisible) {
        div.style.display = "none";
    } else {
        div.style.display = "block";
    }
    isVisible = !isVisible;
}

button.addEventListener("click", toggleDiv);

window.addEventListener("scroll", function() {
    div.style.display = "none";
    isVisible = false;
});