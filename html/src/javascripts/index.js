//include JQuery
let $ = require('jquery');
global.jQuery = $;

// include Bootstrap
require('bootstrap');

import axios from 'axios'

console.log(`app.js has loaded!`);

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
 * Send FormData
 */
$('form').on('beforeSubmit', '.form-ajax', function (event) {
    event.preventDefault();
    alert('sdfsdfsdf');

    let form = $(this);
    let action = $(this).attr('action');
    let data = new FormData($(this)[0]);

    axios.post(action, {
        data: data
    })
        .then(function (response) {
            $('.close').click();
            generate(response.message, 'success', 5000);
            // Update page
            setTimeout(function () {
                location.reload();
            }, 1000);
        })
        .catch(function (error) {
            console.log(error);
        });

    return false;
});

