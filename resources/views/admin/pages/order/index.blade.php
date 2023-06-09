<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Orders</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </a> --}}
        </div>
    </x-slot:title>

    <div class="mb-3">
        <div class="btn-group">
            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                aria-expanded="false">
                Status Pembayaran
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Lunas</a>
                <a class="dropdown-item" href="#">Menunggu Pembayaran</a>
                <a class="dropdown-item" href="#">Expired</a>
            </div>
        </div>
    </div>

    @foreach($orders as $order)
        <div class="card mb-2">
            <div class="card-header d-flex justify-content-between">
                <div>
                    <span class="text-dark font-weight-bold">
                        {{ $order->order_date->isoFormat('D MMMM Y') }}
                    </span>
                    <br>
                    <span>ID Pendaftaran : {{ $order->id }}</span>
                </div>
                <div>
                    @if($order->status_order == "Lunas")
                        <span class="badge badge-success">Lunas</span>
                    @elseif($order->status_order == "Expired")
                        <span class="badge badge-danger">Expired</span>
                    @else
                        <span class="badge badge-warning">Menunggu Pembayaran</span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- <div class="col-2 mr-3"> --}}
                    {{-- <img src="{{ route('training.image').'?q='.$order->training()->first()->image }}"
                    width="200" alt=""> --}}
                    {{-- </div> --}}
                    <div class="col-8">
                        <div class="mb-2">
                            <h5 class="font-weight-bold">
                                <a href="{{ route('admin.detail_order',$order->id) }}"
                                    class="stretched-link">
                                    {{ $order->training()->first()->name }}
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{ $orders->links() }}

</x-layout>
