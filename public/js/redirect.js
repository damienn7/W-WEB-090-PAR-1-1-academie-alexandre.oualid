(function ($) {
//     $("#logout").on("submit", function (e) {
//         e.preventDefault();
//     $.ajax("http://localhost:8080/public/index.php", {
//         type: 'GET'
//     }).done(function (data, text, jqxhr) {
//         // $("main").append($(jqxhr.responseText));
//     }).fail(function (jqxhr) {
//         alert(jqxhr.responseText);
//     }).always(function () {
        
//     });
// });

    $("#connect_account").on("submit", function (e) {
        let form = $("#login_account");
        let data = form.serialize();
        $.ajax($("#login_account").attr("action"), { type: 'POST',url: './index.php',data:data })
            .done(function (data, text, jqxhr) {
                // $('body').innerHTML = "";
                // $("html").append();
                alert(jqxhr.responseText);
            }).fail(function (jqxhr) {
                alert(jqxhr.responseText);
            }).always(function () {
                // $("main").css("background-color", "#ed147d");
                alert(jqxhr.responseText);
            });

    });

})(jQuery);




