$(function () {

    var nav1 = $('.nav1');
    var nav2 = $('.nav2');
    var nav3 = $('.nav3');
    var nav4 = $('.nav4');
    var bg = $('.bgDiv');
    var firstNav1 = $('.firstNav1');
    var firstNav2 = $('.firstNav2');
    var firstNav3 = $('.firstNav3');
    var firstNav4 = $('.firstNav4');

    showNav(nav1, firstNav1, "nav1");
    showNav(nav2, firstNav2, "nav2");
    showNav(nav3, firstNav3, "nav3");
    showNav(nav4, firstNav4, "nav4");

    function showNav(btn, navDiv, direction) {
        btn.on('click', function () {
            bg.css({
                display: "block",
                transition: "opacity .5s"
            });
            if (direction == "nav1") {
                navDiv.css({
                    left: "0px",
                    transition: "nav1 1s"
                });
            } else if (direction == "nav2") {
                navDiv.css({
                    left: "25%",
                    transition: "nav2 1s"
                });
            } else if (direction == "nav3") {
                location.href = "message";
//                navDiv.css({
//                    left: "0px",
//                    transition: "nav3 1s"
//                });
            } else if (direction == "nav4") {
                location.href = "member";
//                navDiv.css({
//                    right: "0px",
//                    transition: "nav4 1s"
//                });
            }


        });
    }

//点击跳转页面
    $('#home').each(function () {
        var dom = $(this);
        dom.on('click', function () {
            hideNav();
            location.href= "./index";
        });
    });
    $('#article').each(function () {
        var dom = $(this);
        dom.on('click', function () {
            hideNav();
            location.href= "./index";
        });
    });
    $('#message').each(function () {
        var dom = $(this);
        dom.on('click', function () {
            hideNav();
            location.href= "./message";
        });
    });
    $('#github').each(function () {
        var dom = $(this);
        dom.on('click', function () {
            hideNav();
            location.href= "http://www.github.com/blueeagletop";
        });
    });


    bg.on('click', function () {
        hideNav();
    });

    function hideNav() {
        firstNav1.css({
            left: "-100%",
            transition: "left .5s"
        });
        firstNav2.css({
            left: "-100%",
            transition: "left .5s"
        });
        firstNav3.css({
            left: "-100%",
            transition: "left .5s"
        });
        firstNav4.css({
            left: "-100%",
            transition: "left .5s"
        });
        bg.css({
            display: "none",
            transition: "display 1s"
        });
    }
});