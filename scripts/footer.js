const footer = document.querySelector("footer");
createBubbles();

function randomNum(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

function createBubbles() {
    for (let i = 0; i < window.innerWidth / 30; i++) {
        footer.appendChild(createBubble());
    }
}

function createBubble() {
    let bubble = document.createElement("div");
    bubble.classList.add("bubble");
    bubble.style.top = randomNum(0, 300) + "px";
    bubble.style.left = randomNum(0, window.innerWidth) + "px";
    bubble.style.scale = randomNum(10, 30) / 10;

    let animDelay = randomNum(0, 70) / 10;
    let animDuration = randomNum(90, 130) / 10;
    bubble.style.animationDelay = animDelay + "s";
    bubble.style.animationDuration = animDuration + "s";
    setTimeout(resetPos, animDelay * 1000, animDuration * 1000, bubble);

    return bubble;
}

function resetPos(animDuration, bubble) {
    setInterval(resetX, animDuration, bubble)
}

function resetX(bubble) {
    bubble.style.left = randomNum(0, window.innerWidth) + "px";
}