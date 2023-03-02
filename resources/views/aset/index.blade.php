@extends('app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Aset
                    {{-- <a href="#" class="btn btn-primary btn-sm float-right" id="add-modal">Add Department</a> --}}
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
@endsection
@push('scripts')
