import "./bootstrap";
import "bootstrap";

import "./bootstrap";
import "bootstrap";

import flatpickr from "flatpickr";
// usa SOLO il tema Bootstrap 5
import "flatpickr/dist/flatpickr.min.css";
// import lingua italiana
import { Italian } from "flatpickr/dist/l10n/it.js";

document.addEventListener("DOMContentLoaded", () => {
    const openingHour = 9;   // orario apertura
    const closingHour = 18;  // orario chiusura

    flatpickr(".datepicker", {
        dateFormat: "d-m-Y",
        altInput: true,
        altFormat: "d-m-Y",
        locale: Italian,
        minDate: "today",
        disable: [
            function(date) {
                const day = date.getDay();
                const now = new Date();

                // 1️⃣ Blocca domenica e lunedì
                if(day === 0 || day === 1) return true;

                // 2️⃣ Blocca oggi se è dopo l’orario di chiusura
                const isToday = date.toDateString() === now.toDateString();
                if(isToday && now.getHours() >= closingHour) return true;

                // altrimenti abilitato
                return false;
            }
        ],
    });
});

