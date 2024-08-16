jQuery(document).ready(function ($) {
    document.getElementById('mp-category').addEventListener('change', function() {
        $("#mp-sub-category").css({
            "pointer-events": "auto",
            "opacity": "1",
        });
        
        let buttonText = $("#mp-category").find(":selected").text();

        $.ajax({
            url: my_ajax_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'get_data_sub_category',
                button_text: buttonText
            },
            success: function(response) {
                $('#mp-sub-category').html(response);
            }
        });
    });
})