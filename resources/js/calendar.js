import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

const availableTimes = [
    "09:00",
    "09:30",
    "10:00",
    "10:30",
    "11:00",
    "11:30",
    "12:00",
    "12:30",
    "15:00",
    "15:30",
    "16:00",
    "16:30",
    "17:00",
    "17:30",
    "18:00",
];

document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("calendar");
    if (!calendarEl) return;

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        locale: "it",
        selectable: true,

        // Definizione pulsanti personalizzati
        customButtons: {
            todayButton: {
                text: "Oggi",
                click: function () {
                    calendar.today(); // riporta al giorno corrente
                },
            },
        },

        headerToolbar: {
            left: "prev,next",
            center: "title",
            right: "todayButton", // pulsante oggi a destra
        },

        height: "auto",
        select: function (info) {
            handleDaySelect(info);
        },
    });

    calendar.render();
});

function handleDaySelect(info) {
    const timeContainer = document.getElementById("timeContainer");

    // rimuove eventuale select precedente
    timeContainer.innerHTML = "";

    // crea select orari
    const select = document.createElement("select");
    select.id = "timeSelect";
    select.classList.add("form-control");

    availableTimes.forEach((time) => {
        const option = document.createElement("option");
        option.value = time;
        option.textContent = time;
        select.appendChild(option);
    });

    timeContainer.appendChild(select);

    // salva la data selezionata
    const dateInput = document.getElementById("bookingDate");
    dateInput.value = info.startStr;
}
