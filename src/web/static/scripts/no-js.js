let elements = $(".no-js").toArray();

for (e of elements) {
    $(e).removeClass("no-js");
}