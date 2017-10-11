let $ = require('jquery');
global.jQuery = $;

require('bootstrap');

import axios from 'axios'
import Noty from 'noty';

/**
 * This function generated some messages with Noty
 *
 * @link https://github.com/needim/noty
 * @param message
 * @param type
 * @param time
 */
function generate(message, type, time) {
    new Noty({
        type: type,
        text: message,
        timeout: time || false,
        layout: 'bottomRight',
        animation: {
            open: function (promise) {
                let n = this;
                new Bounce()
                    .translate({
                        from: {x: 450, y: 0}, to: {x: 0, y: 0},
                        easing: "bounce",
                        duration: 1000,
                        bounces: 4,
                        stiffness: 3
                    })
                    .scale({
                        from: {x: 1.2, y: 1}, to: {x: 1, y: 1},
                        easing: "bounce",
                        duration: 1000,
                        delay: 100,
                        bounces: 4,
                        stiffness: 1
                    })
                    .scale({
                        from: {x: 1, y: 1.2}, to: {x: 1, y: 1},
                        easing: "bounce",
                        duration: 1000,
                        delay: 100,
                        bounces: 6,
                        stiffness: 1
                    })
                    .applyTo(n.barDom, {
                        onComplete: function () {
                            promise(function (resolve) {
                                resolve();
                            })
                        }
                    });
            },
            close: function (promise) {
                let n = this;
                new Bounce()
                    .translate({
                        from: {x: 0, y: 0}, to: {x: 450, y: 0},
                        easing: "bounce",
                        duration: 500,
                        bounces: 4,
                        stiffness: 1
                    })
                    .applyTo(n.barDom, {
                        onComplete: function () {
                            promise(function (resolve) {
                                resolve();
                            })
                        }
                    });
            }
        }
    }).show();
}

/**
 * Call to modal window popup
 */
let $modalBtn = $('.modal-btn');
let $modalPopup = $('#modal-popup');
if ($modalBtn.length) {
    $modalBtn.on('click', function () {
        let target = $(this).attr('data-target');
        console.log(target);

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
            if (response.data.success === true) {
                $('.close').click();
                generate(response.data.message, 'success', 5000);
            } else {
                generate(response.data.message, 'warning', 5000);
            }
            // setTimeout(function () {
            //     location.reload();
            // }, 1000);
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