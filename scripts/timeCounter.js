const clock = document.getElementById("clock");

const startDate = getStartDate();
startClock();

function getStartDate() {
    if (isFirstTimeOnSite()) {
        const today = new Date;
        let t = today.toJSON();
        localStorage.setItem("startDate", t);
    }
    return new Date(localStorage.getItem("startDate"));
}

function isFirstTimeOnSite() {
    if (localStorage.getItem("startDate"))
        return false;
    return true;
}

function startClock() {
    refreshClock();
    setInterval(refreshClock, 1000);
}

function refreshClock() {
    let now = new Date;
    let dTime = new Date(now - startDate);

    let hours = String(dTime.getHours() - 1).padStart(2, '0');
    let minutes = String(dTime.getMinutes()).padStart(2, '0');
    let seconds = String(dTime.getSeconds()).padStart(2, '0');

    let time = `${hours} : ${minutes} : ${seconds}`;
    clock.innerText = time;
}