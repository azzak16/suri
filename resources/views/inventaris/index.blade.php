@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inventaris
                    <a href="{{ route('inventaris.create') }}" class="btn btn-primary btn-sm float-right" id="add-modal">Tambah Inventaris</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>no</th>
                            <th>tgl opname</th>
                            <th>user</th>
                            <th>lokasi</th>
                            <th>latitude</th>
                            <th>longitude</th>
                            <th>aset</th>
                            <th>satuan</th>
                        </tr>
                        @forelse ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->tgl_opname }}</td>
                                <td>{{ $data->user->name }}</td>
                                <td>{{ $data->lokasi->name }}</td>
                                <td>{{ $data->latitude }}</td>
                                <td>{{ $data->longitude }}</td>
                                <td>{{ $data->aset->name }}</td>
                                <td>{{ $data->satuan->name }}</td>
                            </tr>
                        @empty
                            <p>data kosong</p>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
