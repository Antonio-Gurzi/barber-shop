<x-layout>
    <x-slot:titleTab>Prenota</x-slot:titleTab>

    <form action="" class="container d-flex flex-column gap-2 mt-5">

        <div class="row g-3 d-flex justify-content-center">
            <div class="col-12 col-md-4">
                <!-- <label for="title" class="form-label">Titolo</label> -->
                <input type="text" class="form-control text-center" id="name" name="name" value="Nome utente">
            </div>
        </div>

        <div class="row g-3 d-flex justify-content-center">
            <div class="col-12 col-md-4">
                <!-- <label for="title" class="form-label">Titolo</label> -->
                <input type="mail" class="form-control text-center" id="email" name="email" value="Email utente">
            </div>
        </div>

        <div class="row g-3 d-flex justify-content-center mt-3">
            <div class="col-12 col-md-4 text-center">
                <label for="title" class="form-label">Selezione data</label>
                <input type="date" class="form-control text-center" id="data" name="data">
            </div>
        </div>

    </form>

</x-layout>