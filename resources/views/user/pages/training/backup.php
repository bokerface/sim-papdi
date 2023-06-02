<x-user.layout>
    <div class="col-12">
        <section class="py-5" id="features">
            <div class="container px-5 my-5">
                <div class="row gx-5 mb-5">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <img src="{{ route('training.image').'?q='.$training->image }}" class="rounded img-thumbnail" alt="...">
                    </div>
                    <div class="col-lg-8">
                        <h4 class="mb-3">{{ $training->name }}</h4>
                        <div class="mb-3">
                            <span>Tanggal Mulai</span>
                            <p class="text-secondary">{{ $training->start_date }}</p>
                            <span>Tanggal Selesai</span>
                            <p class="text-secondary">{{ $training->end_date }}</p>
                            <p class="text-secondary">Sisa kuota {{ $training->quota }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-8">
                        <h5>Deskripsi</h5>
                        <p>{{ $training->description }}</p>
                    </div>
                    <div class="col-4">

                    </div>
                </div>
            </div>
        </section>
    </div>
</x-user.layout>


<div class="col-3">
    <div style="max-width: 90px; max-height: 90px;min-width: 90px; min-height: 90px">
        <div class="img-thumbnail rounded-circle" style="background-image:
                                            url('https://dummyimage.com/600x400/000/fff');background-size:cover;background-position:
                                            center;height: 90px;">
        </div>
    </div>
</div>