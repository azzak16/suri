@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lokasi Aset
                    <a href="#" class="btn btn-primary btn-sm float-right" id="add-modal">tambah lokasi</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>name</th>
                        </tr>
                        @forelse ($datas as $data)
                            <tr>
                                <td>{{ $data->name }}</td>
                            </tr>
                        @empty
                        <h3>data kosong</h3>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal crud-->
<div class="modal fade" id="modal-ticket" aria-labelledby="modal-ticket-label" aria-hidden="true">
    <div class="modal-dialog modal-m">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-ticket-label">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="form" action="" method="post">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="type" id="type">
                <div class="modal-body">
                    {{-- form input --}}
                    <div id="form-ticket">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="name" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="#" class="btn btn-success" id="add">Add</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
@push('scripts')

<script>

    $(document).ready(function () {

        $('#add-modal').click(function() {
            $('#modal-ticket').modal('show');
        });

        $('#add').on('click', function () {
                $.ajax({
                    url : "{{ route('lokasi.store') }}",
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

</script>

@endpush
