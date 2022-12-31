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
    let src = this.children[0].src;
    const thumbDir = "/upload/img/";
    zoom.children[0].src = thumbDir + getImgName(src);
    console.log();
}



function getImgName(imgSrc) {
    let src = decodeURI(imgSrc)
    let name = src.split("/").pop(); //.split(".")[0];
    return name;
}

function fillImgInfo() {
    for (let image of images) {
        let imgInfo = createImgInfo(image.children[0].src);
        image.appendChild(imgInfo);
    }
}

function createImgInfo(imgSrc) {
    let info = document.createElement("div");
    info.classList.add("img-info");

    let title = document.createElement("span");
    title.innerText = "Title: " + getImgName(imgSrc);
    info.appendChild(title);

    let author = document.createElement("span");
    author.innerText = "Author: ";
    info.appendChild(author);

    return info;
}