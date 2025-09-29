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
    flatpickr(".datepicker", {
        dateFormat: "d-m-Y", // formato che viene inviato al server (giorno-mese-anno)
        altInput: true, // mostra un campo alternativo più leggibile
        altFormat: "d-m-Y", // formato visibile all’utente (uguale a quello inviato)
        locale: Italian, // lingua italiana
        minDate: "today",       // blocca le date precedenti a oggi
    });
});
