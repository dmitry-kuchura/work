/**
 * This function generated some messages with Noty
 *
 * @param message
 * @param type
 * @param time
 */
function generate(message, type, time) {
    noty({
        text: message,
        type: type,
        timeout: time || false,
        animation: {
            open: 'animated flipInX',
            close: 'animated flipOutX'
        }
    });
}

jQuery(document).ready(function ($) {
    /**
     * Call to modal window popup
     */
    $('.modal-btn').on('click', function () {
        $('#modal-popup').modal('show')
            .find('#modal-content')
            .load($(this).attr('data-target'));
    });

    /**
     * Form submit function
     * Send FormData
     */
    $('body').on('beforeSubmit', '.form-ajax', function (event) {
        event.preventDefault();
        var form = $(this);
        var action = $(this).attr('action');
        var data = new FormData($(this)[0]);
        alert('3');
        $.ajax({
            url: action,
            type: 'POST',
            dataType: 'JSON',
            data: data,
            processData: false,
            contentType: false,
            success: function (data) {
                $('.close').click();
                generate(data.message, 'success', 5000);
                // Update page
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
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
        var element = $(this).closest('.usersData-item');
        var table = $(this).data('table');
        var id = $(this).data('id');

        $.ajax({
            url: 'api/delete',
            type: 'POST',
            dataType: 'JSON',
            data: {
                id: id,
                table: table
            },
            success: function (data) {
                generate(data.message, 'success', 5000);
                element.slideUp();
            }
        });
    });

    /**
     * Function call action and generate random data with Faker
     */
    $('.generateData').on('click', function () {
        $.ajax({
            url: 'api/generate-transfer-log',
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                generate(data.message, 'success', 5000);
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        });
    });

    /**
     * Generate report transferred traffic for companies to current month
     */
    $('.generateReport').on('click', function () {
        var month = $('#monthSelect').val();
        var report = $('#report');

        $.ajax({
            url: 'api/get-report',
            type: 'POST',
            dataType: 'JSON',
            data: {
                month: month
            },
            success: function (data) {
                var html = $(data.result);
                report.empty();
                html.appendTo(report);
                report.slideDown();

                $('#transfer').slideUp();
            }
        });
    })
});