const images = document.getElementsByClassName("image");
var zoom = document.getElementById("zoomed");
fillImgInfo();

zoom.addEventListener("click", () => {
    zoom.style.display = "none"
})

for (let image of images) {
    image.addEventListener("click", magnify);
    let img = image.children[0];
}

function magnify() {
    zoom.style.display = "flex";
    zoom.children[0].src = this.children[0].src;
    console.log();
}

function getImgName(img) {
    let src = decodeURI(img.src)
    let name = src.split("/").pop().split(".")[0];
    return name;
}



function fillImgInfo() {
    for (let img of images) {
        let imgInfo = createImgInfo(img);
        img.appendChild(imgInfo);
    }
}

function createImgInfo(img) {
    let info = document.createElement("div");
    info.classList.add("img-info");

    let title = document.createElement("span");
    title.innerText = "Title: ";
    info.appendChild(title);

    let author = document.createElement("span");
    author.innerText = "Author: ";
    info.appendChild(author);

    return info;
}