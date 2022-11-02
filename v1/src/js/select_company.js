var company = [];
company[0] = {
    url: "patria.png",
    company: "Seguros Patria, S. A."
}
company[1] = {
    url: "atlantica.png",
    company: "Atlántica Seguros, S.A."
}

company[2] = {
    url: "general.png",
    company: "General de Seguros, S.A."
}
company[3] = {
    url: "humano.png",
    company: "Humano Seguros, S.A."
}

company[4] = {
    url: "pepin.png",
    company: "Seguros Pepín, S. A."
}

$("#select_ensurance").on("change", function() {
    //selected
    var path = "src/img/ensurances/"
    var slt = $("#select_ensurance").val();

    if (slt != "") {
        var imgName = company[slt].url;
        $(".form__header__brand img").attr("src", path + imgName);
        $(".form__header__brand").css("display", "block");
    } else {
        $(".form__header__brand").css("display", "none");
        $(".form__header__brand img").attr("src", "");
    }



});