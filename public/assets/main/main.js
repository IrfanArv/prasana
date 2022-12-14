$(document).ready(function () {
    $("#scrol").click(function () {
        $("html, body").animate(
            {
                scrollTop: $(".welcome").offset().top,
            },
            500
        );
    });


    var headerNav = document.getElementById("header");
    headerNav.classList.remove("navbar-light");
    headerNav.classList.remove("bg-light");
    var myNav = document.getElementById("header");
    var logo = "../../img/whitelogo.svg";
    var logoblack = "../../img/blacklogo.svg";
    var burger1 = document.getElementById("burger1");
    var burger2 = document.getElementById("burger2");
    var burger3 = document.getElementById("burger3");
    window.onscroll = function () {
        "use strict";
        if (
            document.body.scrollTop >= 280 ||
            document.documentElement.scrollTop >= 280
        ) {
            myNav.classList.add("bg-white");
            burger1.classList.add("color-nav-dark");
            burger2.classList.add("color-nav-dark");
            burger3.classList.add("color-nav-dark");
            myNav.classList.remove("bg-transparent");
            myNav.classList.remove("navbar-light");
            myNav.classList.remove("bg-light");
            var links = document.querySelectorAll("a.nav-link");
            document.getElementById("logoimage").src = logoblack;
            if (
                /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                    navigator.userAgent
                )
            ) {
                links.forEach((link) => (link.style.color = "#ffffff"));
            } else {
                links.forEach((link) => (link.style.color = "#828282"));
            }
        } else {
            burger1.classList.remove("color-nav-dark");
            burger2.classList.remove("color-nav-dark");
            burger3.classList.remove("color-nav-dark");
            burger1.classList.add("color-nav-white");
            burger2.classList.add("color-nav-white");
            burger3.classList.add("color-nav-white");
            myNav.classList.add("bg-transparent");
            myNav.classList.remove("bg-white");
            myNav.classList.remove("navbar-light");
            myNav.classList.remove("bg-light");
            document.getElementById("logoimage").src = logo;
            var links = document.querySelectorAll("a.nav-link");
            links.forEach((link) => (link.style.color = "#ffffff"));
        }
    };
});
