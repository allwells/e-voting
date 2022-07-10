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
    $(document).on("submit", "form.register-form", function (event) {
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
                $("div.success-msg").css("display", "none");
            },
            success: function (response) {
                if (response.status === 422) {
                    $.each(response.error, function (prefix, value) {
                        $("span#" + prefix + "-error").text(value[0]);
                    });
                } else {
                    $("form.register-form")[0].reset();
                    $(document).find("div.success-msg").text(response.message);
                    $("div.success-msg").css("display", "flex");
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
    $(document).on("click", btnId, function (event) {
        event.preventDefault();
        $(document).find(notificationId).css("display", "none");
    });
}

function addCandidateRow() {
    const tableRow = `<tr class="my-2">
                        <td class="py-2">
                            <div class="flex justify-center items-center px-2">
                                <input name="name[]" type="text" id="name"
                                    class="w-full px-3 mt-1 text-sm transition duration-300 bg-neutral-100 border rounded border-transparent h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-300 focus:border-indigo-600 focus:ring-0"
                                    placeholder="Enter candidate's full name" required>
                            </div>
                        </td>
                        <td class="py-2">
                            <div class="flex justify-center items-center px-2">
                                <input name="party[]" type="text" id="party"
                                    class="w-full px-3 mt-1 text-sm transition duration-300 bg-neutral-100 border rounded border-transparent h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-300 focus:border-indigo-600 focus:ring-0"
                                    placeholder="Enter candidate's party" required>
                            </div>
                        </td>
                        <td class="py-2 text-center">
                            <div class="w-full h-12 flex justify-center items-center">
                                <button type="button"
                                    class="text-white rounded-sm bg-rose-600 hover:bg-rose-700 focus:bg-rose-700 focus:ring focus:ring-rose-400/40 remove-row">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 12H4"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>`;

    $("tbody.candidates-table").append(tableRow);
}

function copyToClipboard(elementId) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(elementId).text()).select();
    document.execCommand("copy");
    $temp.remove();
}

let showMenu = true;
let showNav = true;
$(document).ready(function () {
    // create user account
    createAccount();

    // Create election
    creationForm(
        "form.create-election-form",
        ".election-message",
        ".election-success-msg"
    );

    // Add users
    creationForm(".add-users-form", ".users-message", ".users-success-msg");

    // close election creation notifications
    closeNotification(".close-election-success-msg", ".election-success-msg");

    // close user creation notifications
    closeNotification(".close-users-success-msg", ".users-success-msg");

    // mobile menu button
    $(document).on("click", "button.mobile-menu-btn", function (event) {
        event.preventDefault();

        if (showMenu) {
            $(document).find("svg.open-menu-icon").css("display", "none");
            $(document).find("svg.close-menu-icon").css("display", "block");

            // open side menu
            $(document).find("div.sidebar-menu").css("display", "block");

            showMenu = !showMenu;
        } else {
            $(document).find("svg.open-menu-icon").css("display", "block");
            $(document).find("svg.close-menu-icon").css("display", "none");

            // close side menu
            $(document).find("div.sidebar-menu").css("display", "none");

            showMenu = !showMenu;
        }
    });

    // mobile nav button
    $(document).on("click", "button.mobile-nav-btn", function (event) {
        event.preventDefault();

        if (showNav) {
            $(document).find("svg.open-nav-icon").css("display", "none");
            $(document).find("svg.close-nav-icon").css("display", "block");

            // open nav
            $(document).find("div.mobile-nav-menu").css("display", "flex");
            $(document).find("div.mobile-nav-menu").css("flex-direction", "column");

            showNav = !showNav;
        } else {
            $(document).find("svg.open-nav-icon").css("display", "block");
            $(document).find("svg.close-nav-icon").css("display", "none");

            // close nav
            $(document).find("div.mobile-nav-menu").css("display", "none");

            showNav = !showNav;
        }
    });

    $("button.add-candidate-btn").on("click", function (event) {
        event.preventDefault();
        addCandidateRow();
    });

    $("tbody").on("click", "button.remove-row", function () {
        $(this).parent().parent().parent().remove();
    });

    // Copy text to clipboard
    $("button.copy-btn").on("click", function (event) {
        copyToClipboard("#text-to-copy");
    });

    // copy icons
    var copySuccessIcon = `<svg class="copy-success-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                           </svg>`;

    var copyIcon = `<svg class="copy-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>`;

    //   Copy to clipboard icon
    $(document).on("click", ".copy-btn", function () {
        $("svg.copy-icon").replaceWith(copySuccessIcon);

        setTimeout(() => {
            $("svg.copy-success-icon").replaceWith(copyIcon);
        }, 3000);
    });
});
