<x-layout>
    <x-slot:title>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pengaturan Template Sertifikat</h1>
        </div>
    </x-slot:title>

    @push('page_css')
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    @endpush

    <div class="col-6 mx-auto">
        <div class="card mb-3">
            <div class="card-body">
                <form target="_blank" enctype="multipart/form-data"
                    action="{{ route('admin.certificate_setting_preview',$order->id) }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Background</label>
                        <input type="file" class="form-control" name="background" id="background">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Template</label>
                        <select name="template" id="templateId" class="form-control">
                            <option value="a">asdasd</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mb-2">Preview</button>
                </form>
                {{-- <button class="btn btn-warning btn-block" id="previewCert">Preview</button> --}}
            </div>
        </div>
    </div>

    @push('page_js')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $("#previewCert").click(function (e) {
                var fd = new FormData();
                var files = $('#background')[0].files
                var template = $('#templateId').val()
                fd.append('background', files[0])
                fd.append('template', template)

                $.ajax({
                    url: "{{ route('admin.certificate_setting_preview',$order->id) }}",
                    type: 'POST',
                    data: fd,
                    // contentType: 'multipart/form-data',
                    dataType: 'JSON',
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        var link = "http://www.google.com/";
                        window.open(link, 'newStuff');
                    }
                });
            });

        </script>
    @endpush


</x-layout>
