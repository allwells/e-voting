require("./bootstrap");

function getPage(selector, url) {
    $(document).on("click", selector, function (event) {
        event.preventDefault();

        pageURL = $(this).attr("href");
        history.pushState(null, "", pageURL);

        $.ajax({
            type: "GET",
            url: url,
            data: { page: pageURL },
            dataType: "html",
            success: function (response) {
                $("body").html(response);
            },
        });
    });
}

function createAccount() {
    $(document).on("submit", "#register-form", function (event) {
        event.preventDefault();

        var pageURL = $(this).attr("action");

        $.ajax({
            type: $(this).attr("method"),
            url: pageURL,
            data: new FormData(this),
            processData: false,
            dataType: "json",
            contentType: false,
            beforeSend: function () {
                $(document).find("span.error-text").text("");
                $("div#success-msg").css("display", "none");
            },
            success: function (response) {
                if (response.status === 422) {
                    $.each(response.error, function (prefix, value) {
                        $("span#" + prefix + "-error").text(value[0]);
                    });
                } else {
                    $("#register-form")[0].reset();
                    $(document)
                        .find("div#success-msg")
                        .text(response.message);
                    $("div#success-msg").css("display", "flex");

                    setTimeout(() => {
                        $("div#success-msg").css("display", "none");
                        window.location.href = "/login";
                    }, 3000);
                }
            },
        });
    });
}

$(document).ready(function () {
    // create user account
    createAccount();
});
