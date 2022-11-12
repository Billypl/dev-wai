const footer = document.querySelector("footer");

createBubbles();

function randomNum(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}


function createBubbles() {
    for (let i = 0; i < 150; i++) {
        footer.appendChild(createBubble());
    }
}

function createBubble() {
    let bubble = document.createElement("div");
    bubble.classList.add("bubble");
    bubble.style.top = randomNum(0, 300) + "px";
    bubble.style.left = randomNum(0, window.innerWidth) + "px";
    bubble.style.scale = randomNum(10, 20) / 10;
    bubble.style.animationDelay = randomNum(0, 70) / 10 + "s";
    bubble.style.animationDuration = randomNum(90, 130) / 10 + "s";
    return bubble;
}