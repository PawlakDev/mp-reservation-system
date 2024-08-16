jQuery(document).ready(function ($) {
    $('.mp-reservation-del').click(function() {
        if (!confirm("Czy na pewno chcesz usunąć ten element?")) {
            event.preventDefault();
        } else {
            let id = $(this).closest('tr').find('td:first').text().trim();
            $.ajax({
                url: my_ajax_object.ajaxurl,
                type: 'POST',
                data: {
                    ID: id,
                    action: 'mp_reservations_action_del'
                },
                success: function(response) {
                    $('#wpbody-content').html(response);
                    mpReservationErrorInfo(id);
                }
            });
        }
    });

    $('.mp-reservation-edit').click(function() {
        let id = $(this).closest('tr').find('td:first').text().trim();
        openPopup(id);
    });

    function mpReservationErrorInfo(id)
    {
        $('#mp-reservation-del-info').html('<div class="error" style="margin-left:0;margin-right:0;"><p><b>Usunięto element o id ' + id + '</b></p></div>');
    }

    function openPopup(id) {
        $('.mp-popupForm').show();
        $('.popupBackground').show();
        // $('#buttonIdDisplay').text(buttonId);
        $.ajax({
            url: my_ajax_object.ajaxurl,
            type: 'POST',
            data: {
                ID: id,
                action: 'mp_reservations_action_edit'
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
