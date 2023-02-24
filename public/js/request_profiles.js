(function ($) {
    $.ajax("http://localhost:8080/public/index.php?get=all", {
        type: 'GET'
    }).done(function (data, text, jqxhr) {
        $("main").append($(jqxhr.responseText));
    }).fail(function (jqxhr) {
        alert(jqxhr.responseText);
    }).always(function () {
        $("main").css("background-color", "#ed147d");
    });

    $("#form-filter").on("submit", function (e) {
        e.preventDefault();
        $.ajax($("#form-filter").attr("action"), { type: 'GET' })
            .done(function (data, text, jqxhr) {
                // $("main").append($(jqxhr.responseText));
                // alert(jqxhr.responseText);
            }).fail(function (jqxhr) {
                alert(jqxhr.responseText);
            }).always(function () {
                $("main").css("background-color", "#ed147d");
                // alert(jqxhr.responseText);
            });

    });
})(jQuery);



