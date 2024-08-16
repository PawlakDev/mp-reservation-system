let FirstName;
let LastName;
let Email;
jQuery(document).ready(function ($) {
    $(document).on('click', '#mp-button-summary', function() {
        FirstName = $("#mp-firstname").val();
        LastName = $("#mp-lastname").val();
        Email = $("#mp-email").val();

        if(FirstName !== "" && LastName !== "" && Email !== ""){
            $.ajax({
                url: my_ajax_object.ajaxurl,
                type: 'POST',
                data: {
                    action: 'get_summary',
                    category: categoryValue,
                    subCategory: subCategoryValue,
                    firstname: FirstName,
                    lastname: LastName,
                    email: Email,
                    date: GlobalDate.toISOString()
                },
                success: function(response) {
                    $('.mp-calendar-right').html(response);
                }
            });
        } else {
            calendarRightField3 = document.querySelector('.mp-error-info');
            calendarRightField3.innerHTML = '<span>Dane nie zostały wypełnione</span>';
        }
    });

    $(document).on('click', '#mp-submit-save', function() {
        console.log('test');
        $.ajax({
            url: my_ajax_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'save_summary_to_database',
                category: categoryValue,
                subCategory: subCategoryValue,
                firstname: FirstName,
                lastname: LastName,
                email: Email,
                date: GlobalDate.toISOString(),
                panelId: shortcodeId
            },
            success: function(response) {
                $('.mp-calendar-right').html(response);
            }
        }); 
    });
})