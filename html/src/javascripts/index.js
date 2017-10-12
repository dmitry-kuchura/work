let $ = require('jquery');
global.jQuery = $;

require('bootstrap');

import axios from 'axios'
import toastr from 'toastr';

/**
 * This function generated some messages with Toastr
 *
 * @link https://github.com/CodeSeven/toastr
 * @param message
 * @param type
 * @param time
 */
function generate(message, type, time) {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": time || "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    toastr[type](message);
}

/**
 * Call to modal window popup
 */
let $modalBtn = $('.modal-btn');
let $modalPopup = $('#modal-popup');
if ($modalBtn.length) {
    $modalBtn.on('click', function () {
        let target = $(this).attr('data-target');

        $modalPopup.modal('show').find('#modal-content').load(target);
    });
}

/**
 * Form submit function
 * used module axios for send XMLHttpRequests
 * @link https://github.com/axios/axios
 */
$('.modal-content').on('submit', '.form-ajax', function (event) {
    event.preventDefault();

    let form = $(this);
    let action = $(this).attr('action');
    let data = new FormData($(this)[0]);

    axios.post(action, data)
        .then(function (response) {
            let result = response.data;

            if (result.success === true) {
                $('.close').click();
                generate(result.message, 'success', 5000);
                console.log(result);
                if (result.table === 'users') {
                    if (result.method === 'update') {
                        $('#' + result.data.id).html(result.data.name + ' / ' + result.data.email + ' / ' + result.data.company);
                    } else {
                        let usersList = $('#usersData');
                        let html = '<li class="list-group-item usersData-item">' +
                            '<div class="usersData-item__text" id="' + result.data.id + '">' + result.data.name + ' / ' + result.data.email + '</div>' +
                            '<div class="usersData-item__buttons">' +
                            '<button class="btn btn-info modal-btn" data-target="api/user-update?id=' + result.data.id + '"> Edit </button>' +
                            '<button class="btn btn-danger deleteButton" data-table="users" data-id="' + result.data.id + '">Delete</button>' +
                            '</div>' +
                            '</li>';
                        html.appendTo(usersList);
                    }
                }
            } else {
                generate(response.data.message, 'warning', 5000);
            }
        })
        .catch(function (error) {
            console.log(error);
        });

    return false;
});

/**
 * Delete item from table
 * Send table and row id
 *
 * @param table
 * @param id
 */
$('.deleteButton').on('click', function () {
    let element = $(this).closest('.usersData-item');
    let table = $(this).data('table');
    let id = $(this).data('id');

    axios.post('api/delete', {
        id: id,
        table: table
    })
        .then(function (response) {
            if (response.data.success === true) {
                generate(response.data.message, 'success', 5000);
                element.slideUp();
            }
        })
        .catch(function (error) {
            console.log(error);
        });
});

/**
 * Function call action and generate random data with Faker
 */
$('.generateData').on('click', function () {
    axios.post('api/generate-transfer-log')
        .then(function (response) {
            if (response.data.success === true) {
                generate(response.data.message, 'success', 5000);
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        })
        .catch(function (error) {
            console.log(error);
        });
});

/**
 * Generate report transferred traffic for companies to current month
 */
$('.generateReport').on('click', function () {
    let month = $('#monthSelect').val();
    let report = $('#report');

    axios.post('api/get-report', {month: month})
        .then(function (response) {
            if (response.data.success === true) {
                let html = $(data.result);
                report.empty();
                html.appendTo(report);
                report.slideDown();

                $('#transfer').slideUp();
            }
        })
        .catch(function (error) {
            console.log(error);
        });
});