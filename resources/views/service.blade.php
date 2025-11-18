<x-layout>
    <x-slot:titleTab>I nostri servizi</x-slot:titleTab>

    <div class="container">
        <div class="row my-5 g-4">
            @foreach($services as $service)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden 
                                transition-transform hover-scale hover-shadow">
                        <div class="card-header bg-dark text-white text-center fw-bold fs-5">
                            <i class="bi bi-scissors me-2"></i>
                            {{ $service->service }}
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between text-center">
                            <p class="card-text text-secondary mb-4 small">
                                Servizio professionale da barbiere italiano.
                            </p>

                            <div class="mt-auto">
                                <h6 class="fw-semibold text-primary mb-1">
                                    Durata: {{ $service->duration }} Min
                                </h6>
                                <h5 class="text-primary fw-bold">
                                    € {{ $service->price }}
                                </h5>
                            </div>
                        </div>
                        <div class="card-footer bg-light text-center">
                            <a href="{{ route('appointment.create') }}" 
                               class="btn btn-outline-success btn-sm w-100">
                               Prenota Ora
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


</x-layout>
