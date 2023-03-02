@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inventaris
                </div>
                <form id="form" action="" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="no_urut">No. Urut</label>
                            <input type="text" name="no_urut" id="no_urut" class="form-control" value="{{ $no }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tgl_opname">Tgl Opname</label>
                            <input type="text" name="tgl_opname" id="tgl_opname" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="user_opname">User Opname</label>
                            <input type="text" name="user_opname" id="user_opname" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <select id="lokasi" name="lokasi"></select>
                        </div>

                        <a class="btn btn-warning" onclick="getLocation()">Lokasi Geo</a>
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" name="latitude" id="latitude" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" name="longitude" id="longitude" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label for="aset">Aset</label>
                            <select id="aset" name="aset"></select>
                        </div>

                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <select id="satuan" name="satuan"></select>
                        </div>

                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" value="1">
                        </div>

                        <div class="form-group">
                            <label for="tgl_perolehan">Tgl Perolehan</label>
                            <input type="date" name="tgl_perolehan" id="tgl_perolehan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="no_dokumen_pembelian">No. Dokumen Pembelian</label>
                            <input type="text" name="no_dokumen_pembelian" id="no_dokumen_pembelian" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nilai_perolehan">Nilai Perolehan</label>
                            <input type="number" name="nilai_perolehan" id="nilai_perolehan" class="form-control" value="1">
                        </div>

                        <a class="btn btn-primary" id="submit">Submit</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script>

    $(document).ready(function () {
        var d = new Date();

        var month = d.getMonth()+1;
        var day = d.getDate();

        var output =  d.getFullYear() + '-' +
            (month<10 ? '0' : '') + month + '-' +
            (day<10 ? '0' : '') + day;

        $('#tgl_opname').val(output);



        $("#lokasi").select2({
                width: '100%',
                // dropdownParent: $("#modal-ticket"),
                ajax: {
                    url: "{{ route('lokasi.select') }}",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            name: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        return {
                            results: $.map(data.items, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            }),
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search lokasi',
                // minimumInputLength: 1,
            });

            $("#satuan").select2({
                width: '100%',
                // dropdownParent: $("#modal-ticket"),
                ajax: {
                    url: "{{ route('satuan.select') }}",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            name: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        return {
                            results: $.map(data.items, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            }),
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search satuan',
                // minimumInputLength: 1,
            });

            $("#aset").select2({
                width: '100%',
                // dropdownParent: $("#modal-ticket"),
                ajax: {
                    url: "{{ route('aset.select') }}",
                    dataType: 'json',
                    data: function(params) {
                        return {
                            name: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        return {
                            results: $.map(data.items, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            }),
                            pagination: {
                                more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search aset',
                // minimumInputLength: 1,
            });


            $('#submit').on('click', function () {
                $.ajax({
                    url : "{{ route('inventaris.store') }}",
                    method : 'POST',
                    data: new FormData($("#form")[0]),
                    processData: false,
                    contentType: false,
                    success : function(result){
                        alert(result.message);
                        document.location = result.url;
                    },
                    error: function(response) {
                        var response = response.responseJSON;

                        alert(response.message);
                    }
                });
            })


    })

    function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                alert("Geolocation is not supported by this browser.")
            }
        }

    function showPosition(position) {
        $('#latitude').val(position.coords.latitude);
        $('#longitude').val(position.coords.longitude);
    }

</script>
@endpush
