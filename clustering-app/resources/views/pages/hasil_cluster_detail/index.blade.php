@extends('layouts.app')

@section('title')
    Hasil Cluster
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Table Hasil Cluster</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table" id="table" width="100%">
                            <thead>
                                <th>#</th>
                                <th>Nama Puskesmas</th>
                                <th>Cluster</th>
                            </thead>
                            <tbody>
                                @foreach ($result as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->faskes->faskes_name }}</td>
                                        <td>{{ $item->cluster_type->cluster_type_name }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
