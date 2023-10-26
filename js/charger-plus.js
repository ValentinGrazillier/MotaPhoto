jQuery(document).ready(function ($) {
    var page = 1;

    $('#charger-plus').on('click', function () {
        page++;

        var data = {
            action: 'charger_plus',
            page: page,
        };

        $.ajax({
            url: myAjax.ajaxurl,
            data: data,
            type: 'POST',
            success: function (response) {
                if (response) {
                    $('.zone-les-photos').append(response);
                } else {
                    $('#charger-plus').hide();
                }
            },
        });
    });
});
