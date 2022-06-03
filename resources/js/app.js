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

function logout() {
    $(document).on("submit", "#logout-form", function (event) {
        event.preventDefault();

        var pageURL = $(this).attr("action");
        history.pushState(null, "", "/login");

        $.ajax({
            type: "POST",
            url: "/logout",
            data: { page: pageURL },
            dataType: "html",
            success: function (response) {
                $("body").html(response);
            },
        });
    });
}

function createAccount() {
    $(document).on("submit", "#signup-form", function (event) {
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
            },
            success: function (response) {
                if (response.status === 422) {
                    $.each(response.error, function (prefix, value) {
                        $("span#" + prefix + "-error").text(value[0]);
                    });
                } else {
                    $("#signup-form")[0].reset();
                    $(document)
                        .find("span#success-message")
                        .text(response.message);
                    $("div#success-msg").css("display", "flex");

                    setTimeout(() => {
                        $("div#success-msg").css("display", "none");
                        // history.pushState(null, '', '/dashboard');
                        window.location.href = "/dashboard";
                    }, 2000);
                }
            },
        });
    });
}

function updateTheme() {
    $(document).on("submit", "#theme-form", function (event) {
        event.preventDefault();

        var pageURL = $(this).attr("action");

        $.ajax({
            type: $(this).attr("method"),
            url: pageURL,
            data: new FormData(this),
            processData: false,
            dataType: "json",
            success: function (response) {
                console.log(response.status);
            },
            error: function (response) {
                console.log(response);
            },
        });
    });
}

function updateEmail() {
    $(document).on("submit", "#email-form", function (event) {
        event.preventDefault();

        var pageURL = $(this).attr("action");
        var method = $(this).attr("method");

        $.ajax({
            type: method,
            url: pageURL,
            data: new FormData(this),
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.status === 409) {
                    $(document)
                        .find("span#email-error-message")
                        .text(response.error);
                    $("div#email-error-msg").css("display", "flex");
                } else {
                    $(document)
                        .find("span#email-success-message")
                        .text(response.message);
                    $("div#email-success-msg").css("display", "flex");
                }
            },
        });
    });
}

$(document).ready(function () {
    // navigate to 'LOGIN' page
    // getPage('.login-btn', '/login')

    // navigate to 'HOME' page
    // getPage('.home-btn', '/')

    // navigate to 'SIGN UP' page
    // getPage('.signup-btn', '/register')

    // navigate to 'dashboard' page
    // getPage('.dashboard-btn', '/dashboard')

    // navigate to 'profile' page
    // getPage('.profile-btn', '/profile')

    // navigate to 'elections' page
    // getPage('.elections-btn', '/elections')

    // navigate to 'settings' page
    // getPage('.settings-btn', '/settings')

    // navigate to 'users' page
    // getPage('.users-btn', '/users')

    // logout of user account
    // logout();

    // update theme
    // updateTheme();

    // update email
    // updateEmail();

    // create user account
    // createAccount();

    $(document).on("click", "#close-success-msg", function (event) {
        event.preventDefault();
        $("div#success-msg").css("display", "none");
    });

    $(document).on("click", "#close-email-success-msg", function (event) {
        event.preventDefault();
        $("div#email-success-msg").css("display", "none");
    });

    $(document).on("click", "#close-email-error-msg", function (event) {
        event.preventDefault();
        $("div#email-error-msg").css("display", "none");
    });
});
