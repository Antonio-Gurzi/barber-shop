<x-layout>
    <x-slot:titleTab>Prenota</x-slot:titleTab>
    @vite('resources/js/calendar.js')


    <form action="" class="container d-flex flex-column gap-2 my-5">

        <div class="row g-3 d-flex justify-content-center">
            <div class="col-12 col-md-4">
                <p class="fs-4 text-center">Ciao {{$user->name}}, prenota pure il tuo appuntamento!</p>
            </div>
        </div>
        <!-- <div class="row g-3 d-flex justify-content-center">
            <div class="col-12 col-md-4">
                <label for="title" class="form-label">Titolo</label>
                <input type="email" class="form-control text-center" id="email" name="email" value="Email:{{$user->email}}">
            </div>
        </div> -->
        <!-- Selezione giorno e orario -->
        <div class="container mt-5 d-flex flex-column align-items-center">

            <!-- Calendario centrato -->
            <div id="calendar"></div>

            <!-- Select container -->
            <div id="selectionContainer" class="mt-4 w-100" style="max-width: 350px;">

                <!-- Dropdown servizi -->
                <div class="mb-3 text-center">
                    <label for="serviceSelect" class="form-label">Seleziona servizio</label>
                    <select id="serviceSelect" name="service" class="form-control">
                        <option value="null" selected>-</option>
                        <option value="taglio" data-duration="30">Taglio (30 min)</option>
                        <option value="taglio_barba" data-duration="40">Taglio,Barba (40 min)</option>
                        <option value="taglio_barba_shampoo" data-duration="50">Taglio, Barba e Shampoo (50 min)</option>
                    </select>
                </div>

                <!-- Dropdown orari generato da JS -->
                <div class="mb-3 text-center">
                    <label class="form-label">Seleziona orario</label>
                    <div id="timeContainer"></div>
                </div>

            </div>

            <!-- Hidden input per la data selezionata -->
            <input type="hidden" id="bookingDate" name="bookingDate">

            <div>
                <form action="">
                    <button type="submit" class="btn btn-success rounded-3">Prenota</button>
                </form>
            </div>

        </div>





    </form>

</x-layout>