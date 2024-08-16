jQuery(document).ready(function ($) {
    
    $('.mp-button').click(function() {
        let buttonText = $(this).text();

        $.ajax({
            url: my_ajax_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'get_data',
                button_text: buttonText
            },
            success: function(response) {
                $('.mp-wrap').html(response);
                executeAdditionalJS();
            }
        });
    });

    function executeAdditionalJS2(){

        $('#create_sub_category').click(function() {
            let selectedValue = $('input[name="reservation_category"]:checked').val();
            let subCategoryName = $('#sub_category_name').val();

            $.ajax({
                url: my_ajax_object.ajaxurl,
                type: 'POST',
                data: {
                    action: 'create_sub_category',
                    selected_value: selectedValue,
                    sub_category_name: subCategoryName
                },
                success: function(response) {
                    $('.mp-wrap').html(response);
                }
            });
        });
    }
    function executeAdditionalJS() {

        let button_text = $('#button_text').val();
        let reserv_id = $('#reserv_id').val();
        $('.mp-add-new-category').click(function() {
            $.ajax({
                url: my_ajax_object.ajaxurl,
                type: 'POST',
                data: {
                    action: 'add_category',
                    reserv_id: reserv_id
                },
                success: function(response) {
                    $('.mp-wrap').html(response);
                }
            });
        });

        $('.mp-add-new-sub-category').click(function() {

            $.ajax({
                url: my_ajax_object.ajaxurl,
                type: 'POST',
                data: {
                    action: 'add_sub_category',
                    reserv_id: reserv_id
                },
                success: function(response) {
                    $('.mp-wrap').html(response);
                    executeAdditionalJS2();
                }
            });
        });
        
    }
});

