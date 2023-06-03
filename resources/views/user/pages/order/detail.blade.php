<x-user.layout>
    <div class="col-12">
        <section class="py-5" id="features">
            <div class="container px-5 my-5">
                <h4>Status Pembayaran</h4>
                <div class="card">
                    <div class="card-body">
                        <div class="col-6">
                            <h5>Keterangan</h5>
                            <h6 class="text-secondary">
                                ID Pemesanan : 1
                            </h6>
                            <div class="my-3 d-flex">
                                <div class="me-3">
                                    <img src="{{ route('training.image').'?q='.$training->image }}"
                                        class="rounded img-thumbnail" style="max-width: 150px" alt="...">
                                </div>
                                <div>
                                    <span><b>{{ $training->name }}</b></span>
                                    <p class="text-secondary">
                                        Rp. 900000
                                    </p>
                                </div>
                            </div>
                            <h6>Jumlah Peserta : 20</h6>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-user.layout>
