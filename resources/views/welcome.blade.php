<x-layout>
    <x-slot:titleTab>Homepage</x-slot:titleTab>
    <section class="py-4">
        <div class="d-flex bg-primary justify-content-center gap-5 p-3 flex-wrap">
            <img src="{{asset('img/taglio1b&w.png')}}" alt="" class="img-fixed fade-in">
            <img src="{{asset('img/taglio2b&w.png')}}" alt="" class="img-fixed fade-in">
            <img src="{{asset('img/taglio3b&w.png')}}" alt="" class="img-fixed fade-in">
            <img src="{{asset('img/taglio4b&w.png')}}" alt="" class="img-fixed fade-in">
            <img src="{{asset('img/taglio5b&w.png')}}" alt="" class="img-fixed fade-in">
            <img src="{{asset('img/taglio6b&w.png')}}" alt="" class="img-fixed fade-in">
        </div>
    </section>

    <section class="d-flex justify-content-center align-items-center py-5 bg-black">
        <div class="d-flex justify-content-center align-items-center gap-5 text-white-50">
            <i class="bi bi-whatsapp social-icon whatsapp"></i>
            <i class="bi bi-telephone social-icon phone"></i>
            <i class="bi bi-instagram social-icon instagram"></i>
        </div>
    </section>
</x-layout>