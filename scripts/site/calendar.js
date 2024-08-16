let GlobalDate = new Date(); ;
let Day ;
let Month ;
let Year ;
let Hour;
let Min ;
let categoryValue;
let subCategoryValue;

jQuery(document).ready(function ($) {
    const dataButton = document.getElementById("mp-submit-category-and-price");

    dataButton.addEventListener('click', function() {

        const categoryField = document.getElementById("mp-category");
        const subCategoryField = document.getElementById("mp-sub-category");

        categoryValue = categoryField.value.trim();
        subCategoryValue = subCategoryField.value.trim();

        if(categoryValue !== "" && subCategoryValue !== ""){
            getCalendarAjax(categoryValue, subCategoryValue);
        } else {
            calendarRightField3 = document.querySelector('.mp-error-info');
            calendarRightField3.innerHTML = '<span>Oba pola muszą być wybrane</span>';
        }
    });

    function getCalendarAjax(categoryValue, subCategoryValue) {
        $.ajax({
            url: my_ajax_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'get_calendar',
                category: categoryValue,
                subCategory: subCategoryValue,
            },
            success: function(response) {
                $('.mp-calendar-right').html(response);
                generateCalendarDo();
            }
        });
        
    }


function generateCalendarDo()
    {
        const currentDate = new Date();
        const monthSelect = document.getElementById("month");
        const yearSelect = document.getElementById("year");
        const calendarBody = document.getElementById("calendar-body");

        Month = currentDate.getMonth() + 1;
        Year = currentDate.getFullYear();//yearSelect.value;

        // Wywołaj funkcję generowania kalendarza dla wybranego miesiąca i roku
        generateCalendar(Month, Year);

        // Słuchacze zmiany miesiąca i roku
        monthSelect.addEventListener("change", function() {
            generateCalendar(monthSelect.value, yearSelect.value);
            Month = monthSelect.value;
            Day = null;
            Hour = null;
            Min = null;
            $(".mp-calendar-hours").remove();
        });

        yearSelect.addEventListener("change", function() {
            generateCalendar(monthSelect.value, yearSelect.value);
            Year= yearSelect.value;
            Day = null;
            Hour = null;
            Min = null;
            $(".mp-calendar-hours").remove();
        });

    }

    // Funkcja do generowania dni miesiąca w tabeli kalendarza
    function generateCalendar(month, year)
    {
        const calendarBody = document.getElementById("calendar-body");
        calendarBody.innerHTML = ''; // Wyczyść poprzednią zawartość
        const daysInMonth = new Date(year, month, 0).getDate();
        const firstDayOfMonth = new Date(year, month - 1, 1).getDay();
        const dayNames = ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Ndz'];

        let dateCounter = 1;
        let currentDayIndex = (firstDayOfMonth === 0) ? 6 : firstDayOfMonth - 1;

        for (let i = 0; i < Math.ceil((daysInMonth + currentDayIndex) / 7); i++) {
            const row = document.createElement("tr");

            for (let j = 0; j < 7; j++) {
                const cell = document.createElement("td");
                if (i === 0 && j < currentDayIndex) {
                    // Puste komórki przed pierwszym dniem miesiąca
                    cell.textContent = '';
                } else if (dateCounter <= daysInMonth) {
                    // Dni miesiąca
                    cell.textContent = dateCounter;
                    cell.addEventListener('click', function() {
                        // Usunięcie stylu border z poprzednio klikniętej komórki
                        const previousSelectedCell = document.querySelector('.mp-selected');
                        if (previousSelectedCell) {
                            previousSelectedCell.classList.remove('mp-selected');
                        }
                        // Ustawienie stylu border dla aktualnie klikniętej komórki
                        cell.classList.add('mp-selected');

                        console.log(GlobalDate);
                        Day = cell.textContent;
                        GlobalDate.setUTCDate(Day);
                        GlobalDate.setUTCMonth(Month-1);
                        GlobalDate.setUTCFullYear(Year);
                        $.ajax({
                            url: my_ajax_object.ajaxurl,
                            type: 'POST',
                            data: {
                                action: 'get_calendar_hours',
                                date: GlobalDate.toISOString(),
                                cat_id: categoryValue
                            },
                            success: function(response) {
                                $('.calendar-dates').html(response);
                            }
                        });
                    });
                    dateCounter++;
                }
                row.appendChild(cell);
            }
            calendarBody.appendChild(row);
        }
    }

    $(document).on('click', '.mp-calendar-hour', function() {
        $('.mp-calendar-hour').removeClass('mp-selected-button');
        $(this).addClass('mp-selected-button');
        let fullText = $(this).text().trim();
        let timeParts = fullText.split(': ')[1].split(':');
        Hour = parseInt(timeParts[0]);
        Min = parseInt(timeParts[1]);
    });

    $(document).on('click', '#mp-button-getinfo', function() {
        GlobalDate.setUTCHours(Hour);
        GlobalDate.setUTCMinutes(Min);
        GlobalDate.setUTCDate(Day);
        GlobalDate.setUTCMonth(Month-1);
        GlobalDate.setUTCFullYear(Year);
        console.log(GlobalDate);

        if (Day != null && Month != null && Year != null && Hour != null && Min != null) {
            $.ajax({
                url: my_ajax_object.ajaxurl,
                type: 'GET',
                data: {
                    action: 'get_user_info',
                },
                success: function (response) {
                    $('.mp-calendar-right').html(response);
                }
            });
        } else {
            calendarRightField3 = document.querySelector('.mp-error-info');
            calendarRightField3.innerHTML = '<span>Data nie została wybrana</span>';
        }
    });

    $(document).on('click', '#mp-back-box-category-service', function() {
        $.ajax({
            url: my_ajax_object.ajaxurl,
            type: 'GET',
            data: {
                action: 'get_category_service',
            },
            success: function(response) {
                $('.mp-calendar-right').html(response);
            }
        });
    });

})

