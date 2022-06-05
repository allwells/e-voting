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

function creationForm(formId, msgId, successMsg) {
    $(document).on("submit", formId, function (event) {
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
                $(document).find(msgId).text("");
                $(successMsg).css("display", "none");
            },
            success: function (response) {
                if (response.status === 422) {
                    $.each(response.error, function (prefix, value) {
                        $("span#" + prefix + "-error").text(value[0]);
                    });
                } else {
                    $(formId)[0].reset();
                    $(document).find(msgId).text(response.message);
                    $(successMsg).css("display", "flex");
                }
            },
        });
    });
}

function closeNotification(btnId, notificationId) {
    $(document).on('click', btnId, function(event) {
        event.preventDefault();
        $(document).find(notificationId).css("display", "none");
    })
}

$(document).ready(function () {
    // create user account
    createAccount();

    // Create election
    creationForm('#create-election-form', '#election-message', '#election-success-msg');

    // Add candidates for election
    creationForm('#add-candidates-form', 'candidate-message', 'candidate-success-msg');

    // close candidate creation notifications
    closeNotification('#close-candidate-success-msg', '#candidate-success-msg');

    // close election creation notifications
    closeNotification('#close-election-success-msg', '#election-success-msg');
});
