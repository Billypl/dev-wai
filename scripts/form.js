var slider = document.getElementById("monthly-beer");
var output = document.getElementById("cur-val");
output.innerHTML = slider.value;

slider.oninput = function () {
    output.innerHTML = this.value;
}