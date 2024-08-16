jQuery(document).ready(function ($) {
    $('#addPanelButton').click(function() {
        var wrapContent = '<div class="wrap">' +
            '<h2>Stwórz nowy panel</h2>' +
            '<form method="post" action="">' +
            '<label for="shortcode_name">Wpisz nazwę panelu:</label><br>' +
            '<input type="text" id="shortcode_name" name="shortcode_name"><br><br>' +
            '<input type="submit" name="create_shortcode" value="Stwórz" class="button-primary">' +
            '</form>' +
            '</div>';

        $('#wpbody-content').html(wrapContent);
    });

    $('.mp-panel-del').click(function() {
        if (!confirm("Czy na pewno chcesz usunąć ten element?")) {
            event.preventDefault();
        } else {
            let id = $(this).closest('tr').find('td:first').text().trim();
            $.ajax({
                url: my_ajax_object.ajaxurl,
                type: 'POST',
                data: {
                    ID: id,
                    action: 'mp_panels_action_del'
                },
                success: function(response) {
                    $('#wpbody-content').html(response);
                    mpReservationErrorInfo(id);
                }
            });
        }
    });

    function mpReservationErrorInfo(id)
    {
        $('#mp-reservation-del-info').html('<div class="error" style="margin-left:0;margin-right:0;"><p><b>Usunięto element o id ' + id + '</b></p></div>');
    }

    $('.mp-panel-edit').click(function() {
        let id = $(this).closest('tr').find('td:first').text().trim();
        openPopup(id);
    });

    function openPopup(id) {
        $('.mp-popupForm').show();
        $('.popupBackground').show();
        $.ajax({
            url: my_ajax_object.ajaxurl,
            type: 'POST',
            data: {
                ID: id,
                action: 'mp_panel_action_edit'
            },
            success: function(response) {
                $('.mp-popupForm').html(response);
                closePopup();
            }
        });
    }

    function closePopup() {
        $('.mp-popup-close').click(function() {
            $('.mp-popupForm').hide();
            $('.popupBackground').hide();
        });
    }
});