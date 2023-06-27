<x-user.layout>
    <div class="col-12">
        <section class="py-2" id="features">
            <div class="container px-5 my-5">
                <h4 class="mb-3">Sertifikat Saya</h4>
                @foreach($orders as $order)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <span class="text-dark font-weight-bold">
                                    {{ $order->order_date->isoFormat('D MMMM Y') }}
                                </span>
                                <br>
                                <span>ID Pendaftaran : {{ $order->id }}</span>
                            </div>
                            <div>
                                <x-user.order-status :id="$order->id" />
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $order->training->name }}</h5>
                            <p class="card-text">
                                Tanggal Mulai :
                                {{ $order->training->start_date->isoFormat('D MMMM Y, H:mm') }}
                            </p>
                            <span class="card-text">
                                Tanggal Selesai :
                                {{ $order->training->end_date->isoFormat('D MMMM Y, h:mm') }}
                            </span>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('user.detail_order',$order->id) }}"
                                    class="btn btn-primary btn-sm stretched-link">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $orders->links() }}
            </div>
        </section>
    </div>
</x-user.layout>
