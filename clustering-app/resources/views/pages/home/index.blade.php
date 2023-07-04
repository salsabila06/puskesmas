@extends('layouts.app')

@section('title')
    Dashboard
@endsection


@section('content')
    @if (auth()->user()->role_id == ROLE_DINAS)
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <iconify-icon icon="healthicons:i-exam-multiple-choice" class="text-white" width="30">
                        </iconify-icon>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Komponen</h4>
                        </div>
                        <div class="card-body">
                            {{ $quest_type }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <iconify-icon icon="mingcute:hospital-fill" class="text-white" width="30"></iconify-icon>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Puskesmas</h4>
                        </div>
                        <div class="card-body">
                            {{ $faskes }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <iconify-icon icon="wpf:survey" class="text-white" width="30"></iconify-icon>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Survey</h4>
                        </div>
                        <div class="card-body">
                            {{ $survey }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <iconify-icon icon="fluent:book-question-mark-24-filled" class="text-white" width="30">
                        </iconify-icon>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pertanyaan</h4>
                        </div>
                        <div class="card-body">
                            {{ $quest }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header align-items-center">
                        <h4>Grafik Cluster</h4>
                        <div class="ml-auto w-25">
                            <select class="custom-select" name="" id="survey-select">
                                @forelse ($survey_list as $item)
                                    <option value="{{ $item->survey_id }}" {{ $loop->index == 0 ? 'selected' : '' }}>
                                        {{ $item->title }}</option>
                                @empty
                                    <option value="" selected disabled>Belum Ada Survey</option>
                                @endforelse
                            </select>

                        </div>

                    </div>
                    <div class="card-body">
                        <canvas id="chart-pie" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <iconify-icon icon="wpf:survey" class="text-white" width="30"></iconify-icon>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Survey</h4>
                        </div>
                        <div class="card-body">
                            {{ $survey }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <iconify-icon class="text-white" width="30"
                            icon="streamline:interface-file-clipboard-check-checkmark-edit-task-edition-checklist-check-success-clipboard-form">
                        </iconify-icon>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Survey Selesai</h4>
                        </div>
                        <div class="card-body">
                            {{ $survey_passed }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <iconify-icon icon="bi:clipboard-x" class="text-white" width="30"></iconify-icon>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Survey Belum</h4>
                        </div>
                        <div class="card-body">
                            {{ $not_yet_survey }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
        <script src="{{ asset('assets/js/chart.js') }}"></script>
    @endpush
@endsection
