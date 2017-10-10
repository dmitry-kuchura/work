//include JQuery
let $ = require('jquery');
global.jQuery = $;

// include Bootstrap
require('bootstrap');

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

