const modeButton = $("#dark-mode");

if (!localStorage.getItem("theme"))
    localStorage.setItem("theme", "dark");

var isDark = localStorage.getItem("theme") == "dark";
changeFile();

modeButton.click(changeTheme);

function changeTheme() {
    isDark = !isDark;
    let theme = isDark ? "dark" : "light";
    localStorage.setItem("theme", theme);
    changeFile();
}

function changeFile() {
    let cssFile = document.getElementById("theme-mode");
    let cssPath = isDark ?
        "styles/dark-mode.css" :
        "styles/light-mode.css";
    cssFile.setAttribute("href", cssPath);
}