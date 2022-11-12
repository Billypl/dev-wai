const formSlider = document.getElementById("monthly-beer");
const formSliderOutput = document.getElementById("cur-val");
formSliderOutput.innerHTML = formSlider.value;

formSlider.oninput = function () {
    formSliderOutput.innerHTML = this.value;
}


const inputs = $(".questions input:not([type='radio'], [type='checkbox']), .questions select").toArray();
const radios = $(".questions input[type='radio']").toArray();
const checkboxes = $(".questions input[type='checkbox']").toArray();

attachEventListeners();
fillInputsAtTheStart();


function attachEventListeners() {
    for (radio of radios) {
        radio.addEventListener("input", saveToSession);
    }
    for (input of inputs) {
        input.addEventListener("input", saveToSession);
    }
    for (checkbox of checkboxes) {
        checkbox.addEventListener("input", saveCheckboxesToSession);
    }
}

function saveToSession() {
    sessionStorage.setItem(this.name, this.value);
}

function saveCheckboxesToSession() {
    let arr = [];
    for (checkbox of checkboxes) {
        if (checkbox.checked) {
            arr.push(checkbox.value);
        }
    }
    let json = JSON.stringify(arr);
    sessionStorage.setItem(this.name, json);
}


function fillInputsAtTheStart() {
    fillGeneralInputs();
    fillRadioButtons();
    fillCheckboxes();
}

function fillGeneralInputs() {
    for (input of inputs) {
        let val = sessionStorage.getItem(input.name);
        input.value = val;
    }
}

function fillRadioButtons() {
    for (radio of radios) {
        let val = sessionStorage.getItem(radio.name);
        if (radio.value == val)
            radio.checked = true;
    }
}

function fillCheckboxes() {
    for (checkbox of checkboxes) {
        let arr = JSON.parse(sessionStorage.getItem(checkbox.name));
        if (arr.includes(checkbox.value))
            checkbox.checked = true;
    }
}