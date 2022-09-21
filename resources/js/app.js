const axios = require("axios");
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
                                    class="w-full px-3 mt-1 text-sm transition duration-300 bg-neutral-100 border rounded-lg border-transparent h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-300 focus:border-[#0000FF] focus:ring-0"
                                    placeholder="Candidate's full name" required>
                            </div>
                        </td>
                        <td class="py-2">
                            <div class="flex justify-center items-center px-2">
                                <input name="email[]" type="email" id="email"
                                    class="w-full px-3 mt-1 text-sm transition duration-300 bg-neutral-100 border rounded-lg border-transparent h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-300 focus:border-[#0000FF] focus:ring-0"
                                    placeholder="Candidate's email" required>
                            </div>
                        </td>
                        <td class="py-2">
                            <div class="flex justify-center items-center px-2">
                                <input name="party[]" type="text" id="party"
                                    class="w-full px-3 mt-1 text-sm transition duration-300 bg-neutral-100 border rounded-lg border-transparent h-11 outline-0 text-neutral-600 placeholder-neutral-400 hover:border-neutral-300 focus:border-[#0000FF] focus:ring-0"
                                    placeholder="Candidate's party">
                            </div>
                        </td>
                        <td class="py-2">
                            <div id="file-upload-field" class="flex justify-center items-center px-2 relative overflow-hidden">
                                <input name="image[]" type="file" id="image"
                                    class="absolute z-10 opacity-0 w-10 mt-1 text-sm transition duration-300 bg-neutral-100 border rounded-lg border-transparent h-10 outline-0 text-neutral-700 hover:border-neutral-300 focus:border-[#0000FF] focus:ring-0">
                                <label for="image" id="file-upload-btn" class="cursor-pointer text-neutral-600 p-2 rounded-md bg-neutral-100">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                </label>
                            </div>
                        </td>
                        <td class="py-2 text-center">
                            <div class="w-full h-12 flex justify-center items-center">
                                <button type="button"
                                    class="text-white p-0.5 rounded bg-rose-600 hover:bg-rose-700 focus:bg-rose-700 focus:ring focus:ring-rose-400/30 remove-row">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>`;

    $("tbody.candidates-table").append(tableRow);
}

function addPollOptionRow() {
    const optionsTableRow = `<tr>
                                <td>
                                    <div class="flex justify-start items-center px-2">
                                    <span class="text-xl font-bold mt-1.5">-</span>
                                        <input name="options[]" type="text" id="option"
                                            class="w-full mt-1 text-base sm:text-lg border-0 h-14 focus:ring-0 outline-0 text-neutral-700 placeholder-neutral-400"
                                            placeholder="Option" autocomplete="off" required>
                                    </div>
                                </td>

                                <td class="w-[10rem] text-center">
                                    <div class="flex justify-end items-center">
                                        <button type="button"
                                            class="flex justify-center items-center font-bold text-xs gap-1 text-red-500 p-2 rounded-md hover:text-red-700 hover:bg-red-600/10 remove-option-row active:scale-95">
                                            Remove
                                        </button>
                                    </div>
                                </td>
                            </tr>`;

    $("tbody.options-table").append(optionsTableRow);
}

function copyToClipboard(elementId) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(elementId).text()).select();
    document.execCommand("copy");
    $temp.remove();
}

// Search data in database tables
function search(table) {
    $(`#${table}-search`).on("keyup", function () {
        $slug = $(this).val();

        $.ajax({
            type: "get",
            url: `/search/${table}`,
            data: { slug: $slug },
            success: function (data) {
                $(`#${table}-content`).html(data);
            },
        });
    });
}

// retrieve responses
function getResponses() {
    let responses = [];

    $.ajax({
        type: "GET",
        url: "/api/responses",
        dataType: "json",
        success: function (response) {
            response.map((data) => {
                responses.push(data);
            });
        },
    });

    return responses;
}

// create response
function createResponse() {
    axios.get("/api/options").then((response) => {
        response.data.map((data) => {
            $(`#option-form-${data.id}`).on("submit", function (e) {
                e.preventDefault();

                const url = $(this).attr("action");
                const method = $(this).attr("method");

                const formData = {
                    _token: $("#token").val(),
                    user_id: Number($("#userId").val()),
                    poll_id: Number($("#pollId").val()),
                    option_id: data.id,
                };

                $.ajax({
                    type: method,
                    url: url,
                    data: formData,
                    success: function (res) {
                        $("#poll-options").empty();

                        // check is total responses of is in thousands, millions, billions or trillions
                        const isThousand =
                            res.totalResponses > 1000 &&
                            res.totalResponses < 1000000;
                        const isMillion =
                            res.totalResponses > 1000000 &&
                            res.totalResponses < 1000000000;
                        const isBillion =
                            res.totalResponses > 1000000000 &&
                            res.totalResponses < 1000000000000;
                        const isTrillion =
                            res.totalResponses > 1000000000000 &&
                            res.totalResponses < 1000000000000000;

                        $("#total-responses").empty();

                        if (isThousand) {
                            $("#total-responses").text(
                                parseFloat(res.totalResponses / 1000).toFixed(1)
                            );
                        } else if (isMillion) {
                            $("#total-responses").text(
                                parseFloat(
                                    res.totalResponses / 1000000
                                ).toFixed(1)
                            );
                        } else if (isBillion) {
                            $("#total-responses").text(
                                parseFloat(
                                    res.totalResponses / 1000000000
                                ).toFixed(1)
                            );
                        } else if (isTrillion) {
                            $("#total-responses").text(
                                parseFloat(
                                    res.totalResponses / 1000000000000
                                ).toFixed(1)
                            );
                        } else {
                            $("#total-responses").text(res.totalResponses);
                        }

                        res.options.map((result) => {
                            const percentage =
                                result.id in res.response
                                    ? Math.round(
                                          (res.response[result.id] /
                                              res.totalResponses) *
                                              100
                                      )
                                    : 0;

                            const checker = `
                                <span class="relative w-fit h-fit">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </span>`;

                            const selected =
                                result.id in res.responses ? checker : "";

                            const output = `
                                <div class="relative flex items-center justify-start w-full overflow-hidden border rounded-lg border-neutral-300">
                                    <button type="button"
                                        style="width: ${percentage}%;"
                                        class="bg-neutral-300 cursor-default text-left transition duration-1000 text-neutral-700 flex justify-start items-start border-0 outline-0 w-full min-h-[2.5rem]">
                                        <span class="absolute w-full min-h-[2.5rem] flex justify-between items-center px-3">
                                            <span class="relative flex items-center justify-start gap-1 text-sm font-medium">
                                                ${selected}
                                                ${result.value}
                                            </span>

                                            <span class="text-sm font-bold text-neutral-800">
                                                ${percentage}%
                                            </span>
                                        </span>
                                    </button>
                                </div>`;

                            $("#poll-options").append(output);
                        });
                    },
                });
            });
        });
    });
}

let showMenu = true;
let showNav = true;
$(document).ready(function () {
    createResponse();

    // search users' table
    search("users");

    // search elections' table
    search("elections");

    // search results' table
    search("results");

    // search polls' table
    search("polls");

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
            $(document)
                .find("div.mobile-nav-menu")
                .css("flex-direction", "column");

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

    $("button.add-option-btn").on("click", function (event) {
        event.preventDefault();
        addPollOptionRow();
    });

    $("tbody").on("click", "button.remove-option-row", function () {
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
