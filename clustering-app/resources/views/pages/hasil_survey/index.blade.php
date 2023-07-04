@extends('layouts.app')

@section('title')
    Daftar Survey
@endsection

@section('css')
    <style>
        .folder:hover {
            background-color: gainsboro;
            cursor: pointer;
            border-radius: 15px;
        }
    </style>
@endsection
@section('content')
    <div class="row justify-content-start align-items-center">

        @forelse ($survey as $item)
            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2">
                <a href="/result/{{ $item->id_survey }}" class="text-decoration-none text-monospace text-dark">
                    <div class="text-center p-1 folder">
                        <iconify-icon icon="material-symbols:folder" class="text-warning" width="100"></iconify-icon>
                        <p class="text-truncate text-black font-weight-bold" data-toggle="tooltip" data-placement="bottom"
                            title="{{ $item->title }}">{{ $item->title }}</p>
                    </div>
                </a>
            </div>
        @empty

            <div class="col-12 text-center p-3">
                <iconify-icon icon="mdi:file-document-alert" width="100" class="text-danger"></iconify-icon>
                <h6 class="my-3">Survey Belum Tersedia.<br> Silahkan tambahkan survey terlebih dahulu</h6>
                <a href="/survey" class="btn btn-primary">Tambah Survey</a>
            </div>
        @endforelse


    </div>

@endsection
