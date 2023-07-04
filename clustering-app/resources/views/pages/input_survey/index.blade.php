@extends('layouts.app')

@section('title')
    Isi Survey
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Table Survey</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="table" width="100%">
                            <thead>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Tanggal Terbit</th>
                                <th>Aksi</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @push('js')
        <script src="{{ asset('assets/js/isi_survey.js') }}"></script>
    @endpush
@endsection

@include('pages.input_survey.partials.modal_result')
