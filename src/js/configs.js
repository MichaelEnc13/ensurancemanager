var style = document.createElement("link");
style.setAttribute("rel", "stylesheet");
style.setAttribute("href", "src/css/darkmode.css");
style.setAttribute("async", true);
var parent = document.querySelector(".darkmodeLoader")

function loadDark() {

    parent.appendChild(style);
}

function offDark() {
    if (parent.contains(style)) {
        parent.removeChild(style)
    }

}



$(document).on("click", ".dark_toggle_switch", function(e) {


    $(".dark_toggle_switch").toggleClass("dark_toggle_switch_on");
    if (localStorage.getItem("darkmode") == null || localStorage.getItem("darkmode") == "false") {
        localStorage.setItem("darkmode", true);
        loadDark();
    } else {
        localStorage.setItem("darkmode", false);
        offDark();
    }


});

function verify_dark() {
    if (localStorage.getItem("darkmode") == null || localStorage.getItem("darkmode") == "false") {

        offDark();

        $(".dark_toggle_switch").removeClass("dark_toggle_switch_on")

    } else {
        $(".dark_toggle_switch").addClass("dark_toggle_switch_on")
        loadDark();

    }
}

verify_dark()