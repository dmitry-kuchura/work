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
$('body').on('click', '.modal-btn', function () {
    let target = $(this).attr('data-target');
    $('#modal-popup').modal('show').find('#modal-content').load(target);
});

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

                if (result.table === 'users') {
                    if (result.method === 'update') {
                        $('#user-' + result.data.id).html(result.data.name + ' / ' + result.data.email + ' / ' + result.data.company);
                    } else {
                        let usersList = $('#usersData');
                        usersList.append(result.html);
                    }
                }

                if (result.table === 'companies') {
                    if (result.method === 'update') {
                        $('#company-' + result.data.id).html(result.data.name + ' / ' + result.data.quota + ' ' + result.data.quota_type);
                    } else {
                        let usersList = $('#companyData');
                        usersList.append(result.html);
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
$('body').on('click', '.deleteButton', function () {
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
            } else {
                generate(response.data.message, 'warning', 5000);
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
    let transfer = $('#transfer');

    axios.post('api/get-report', {month: month})
        .then(function (response) {
            console.log(response);
            if (response.data.success === true) {
                let html = $(response.data.result);
                report.empty();

                report.append(html);
                report.slideDown();

                transfer.slideUp();
            }
        })
        .catch(function (error) {
            console.log(error);
        });
});