@extends('layouts.app')

@section('title')
    Puskesmas
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Table Puskesmas</h4>
            <button class="btn btn-success ml-auto" data-target="#modal_add" data-toggle="modal">Tambah</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="table" width="100%">
                            <thead>
                                <th>#</th>
                                <th>Nama Puskesmas</th>
                                <th>Tipe Puskesmas</th>
                                <th>Kecamatan</th>
                                <th>PIC</th>
                                <th>Tanggal Dibangun</th>
                                <th>Aksi</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @push('js')
        <script src="{{ asset('assets/js/faskes.js') }}"></script>
    @endpush
@endsection

@include('pages.faskes.partials.modal_add')
@include('pages.faskes.partials.modal_edit')
