let elements = $(".no-js").toArray();

for (e of elements) {
    $(e).css('display', 'flex');
}