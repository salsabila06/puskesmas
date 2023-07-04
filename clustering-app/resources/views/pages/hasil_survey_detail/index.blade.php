@extends('layouts.app')

@section('title')
    Hasil Survey
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Table Hasil Survey</h4>
            @if (!$is_clustered)
                <button class="btn btn-success ml-auto" data-faskes="{{ $faskes_count }}" data-pass="{{ $faskes_pass_count }}"
                    data-survey="{{ request()->segment(2) }}" id="cluster">Cluster</button>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <h6>Jumlah Puskesmas : {{ $faskes_pass_count }} / {{ $faskes_count }}</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="table" width="100%">
                            <thead>
                                <th>#</th>
                                <th>Nama Puskesmas</th>
                                @foreach ($survey as $item)
                                    <th>{{ $item->quest_type->quest_type_name }}(%)</th>
                                @endforeach
                            </thead>
                            <tbody>
                                @foreach ($result as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->faskes_name }}</td>
                                        @foreach ($item->result as $value)
                                            <td>{{ $value }}</td>
                                        @endforeach
                                        {{-- <td>{{ $item->value_percentage }}</td>
                                        <td>{{ $item->value_percentage }}</td> --}}
                                        {{-- <td>{{ $item->faskes->faskes_name }}</td>
                                    <td>{{ $item->faskes->faskes_name }}</td> --}}
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @push('js')
        <script src="{{ asset('assets/js/cluster.js') }}"></script>
    @endpush
@endsection
