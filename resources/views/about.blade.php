<x-layout>
    <x-slot:titleTab>Chi sono</x-slot:titleTab>

    <div class="py-5 bg-dark text-white">
        <div class="container">
            <div class="row align-items-center g-4">

                <!-- Immagine -->
                <div class="col-12 col-md-4 text-center text-md-start">
                    <img src="{{ asset('img/fabio.png') }}" alt="Fabio Buccafurri" class="img-fluid rounded-5 shadow-lg fade-in">
                </div>

                <!-- Testo -->
                <div class="col-12 col-md-8">
                    <h2 class="mb-3 text-white">Ciao, sono Fabio proprietario di GLAMOOD</h2>
                    <p>
                        Nato e cresciuto a Reggio Calabria, ho sempre avuto una forte vena creativa, esplorando diversi progetti fin da ragazzo. Tra tutte le mie passioni, quella che mi ha conquistato completamente è il mondo dell’<span class="fw-bold">hair styling</span>.
                    </p>
                    <p>
                        Dopo anni di gavetta e tanta esperienza, ho capito che per crescere davvero dovevo mettermi alla prova nella mia città. Nonostante le sfide che comporta aprire un’attività in una realtà complessa come la nostra, ho deciso di realizzare il mio sogno: <span class="fw-bold">aprire il mio negozio</span>.
                    </p>
                    <p>
                        Qui ti aspetto, pronto a offrirti <span class="fw-bold">passione, professionalità e il massimo della qualità</span> in ogni servizio.
                    </p>
                    <a href="{{ route('appointment.create') }}"
                        class="btn btn-outline-success btn-sm w-100">
                        Prenota Adesso il tuo appuntamento
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-layout>