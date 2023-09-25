<x-user.layout>
    <div class="col-12">
        <section class="py-5" id="features">
            <div class="container px-5 my-5 d-flex justify-content-center">
                <div class="col-5">
                    <h4 class="card-title">
                        Daftar Sertifikat Anda
                    </h4>
                    <div class="card mt-3">
                        <div class="card-body">
                            <ul class="list-group">
                                @if(session()->has('error'))
                                    <div class="alert alert-warning" role="alert">
                                        {{ session()->get('error') }}
                                    </div>
                                @endif

                                @foreach($certificates as $certificate)
                                    <li class="list-group-item">
                                        {{ $certificate->training_name }}
                                        <a href="{{ route('user.download_certificate',[$certificate->training_id,$certificate->email]) }}"
                                            class="btn btn-success btn-sm">download</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-user.layout>
