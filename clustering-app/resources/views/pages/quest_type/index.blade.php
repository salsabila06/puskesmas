@extends('layouts.app')

@section('title')
    Parameter Penilaian
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Table Parameter Penilaian</h4>
            <button class="btn btn-success ml-auto" data-target="#modal_add" data-toggle="modal">Tambah</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="table" width="100%">
                            <thead>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @push('js')
        <script src="{{ asset('assets/js/quest_type.js') }}"></script>
    @endpush
@endsection

@include('pages.quest_type.partials.modal_add')
@include('pages.quest_type.partials.modal_edit')
