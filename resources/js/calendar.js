import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: 'dayGridMonth',
        locale: 'it',
        selectable: true,
        height: 'auto',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'oggiButton' // pulsante personalizzato
        },
        customButtons: {
            oggiButton: {
                text: 'Oggi',
                click: function () {
                    calendar.today(); // riporta al giorno corrente
                }
            }
        },
        dateClick: function (info) {
            handleDaySelect(info);
        },
    });

    calendar.render();
});

function handleDaySelect(info) {
    const timeContainer = document.getElementById('time');
    if (!timeContainer) return;
    timeContainer.innerHTML = '';

    const select = document.createElement('select');
    select.id = 'timeSelect';
    select.name = 'time';
    select.classList.add('form-control');

    const availableTimes = [
        '09:00', '09:30', '10:00', '10:30',
        '11:00', '11:30', '12:00', '12:30',
        '15:00', '15:30', '16:00', '16:30',
        '17:00', '17:30', '18:00'
    ];

    availableTimes.forEach((time) => {
        const option = document.createElement('option');
        option.value = time;
        option.textContent = time;
        select.appendChild(option);
    });

    timeContainer.appendChild(select);

    const dateInput = document.getElementById('day');
    if (dateInput) {
        dateInput.value = info.dateStr;
    }
}
