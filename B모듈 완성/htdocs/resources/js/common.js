const log = console.log;

window.addEventListener("load", () => {
    $("#location_modal").dialog({
        'width': 500,
        'my': 'center',
        'at': 'center',
        'show': true,
        'hidden': true,
        'modal': true,
        'autoOpen': false
    });


    $("header .location").on("click", () => {
        log("dsasd");
        $.ajax({
            'url': '/location.php',
            'timeout': 1000,
            success: (e) => {
                $("#location_modal .inner").html(e);
                $("#location_modal").dialog("open");
            },
            error: (e) => {
                alert("찾아오시는 길을 표시할 수 없습니다");
            }
        })
    });
});