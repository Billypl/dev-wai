const footer = document.querySelector("footer");
const bubbles = createBubbles();
renderBubbles();

function randomNum(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

function createBubbles() {
    let bubblesArr = [];
    for (let i = 0; i < window.innerWidth / 30; i++)
        bubblesArr.push(createBubble());
    return bubblesArr;
}

function renderBubbles() {
    for (let bubble of bubbles)
        footer.appendChild(bubble);
}

function createBubble() {
    let bubble = document.createElement("div");
    bubble.classList.add("bubble");
    bubble.style.top = randomNum(0, 300) + "px";
    bubble.style.left = randomNum(0, window.innerWidth) + "px";
    bubble.style.scale = randomNum(10, 30) / 10;
    bubble.style.animationDelay = randomNum(0, 70) / 10 + "s";
    bubble.style.animationDuration = randomNum(90, 130) / 10 + "s";

    return bubble;
}

let resizeTimer;
window.onresize = () => {
    clearTimeout(resizeTimer);
    resizeTimer = window.setTimeout(resetX, 1000);
}

function resetX() {
    for (let bubble of bubbles)
        bubble.style.left = randomNum(0, window.innerWidth) + "px";
}