@extends('layouts.app')

@section('title')
    Isi Survey
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>{{ $survey->title }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">

                    <div class="form-group row">

                        <div class="col">
                            <label for="">Kode Registrasi Puskesmas</label>
                            <input type="text" class="form-control" placeholder="" aria-describedby="helpId" readonly
                                value="{{ $faskes->faskes_code }}">
                        </div>
                        <div class="col">
                            <label for="">Nama Puskesmas</label>
                            <input type="text" class="form-control" placeholder="" aria-describedby="helpId" readonly
                                value="{{ $faskes->faskes_name }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col">
                            <label for="">Tipe Puskesmas</label>
                            <input type="text" class="form-control" placeholder="" aria-describedby="helpId" readonly
                                value="{{ $faskes->type->faskes_type_name }}">
                        </div>
                        <div class="col">
                            <label for="">Tanggal Puskesmas Didirikan</label>
                            <input type="text" class="form-control" placeholder="" aria-describedby="helpId" readonly
                                value="{{ date('d-m-Y', strtotime($faskes->faskes_establish)) }}">
                        </div>
                        <div class="col">
                            <label for="">Kecamatan</label>
                            <input type="text" class="form-control" placeholder="" aria-describedby="helpId" readonly
                                value="{{ $district->district_name }}">
                        </div>
                    </div>

                    <hr class="mb-3">
                    <form action="#" id="formSurvey">
                        <input type="hidden" name="id_survey" value="{{ $survey->id_survey }}">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>No</th>
                                    <th>Parameter</th>
                                    <th>Pilihan</th>
                                </thead>
                                <tbody>

                                    @foreach ($survey->quest_type as $item)
                                        <tr>
                                            <td colspan="3">
                                                <b>{{ App\Http\Controllers\Controller::numberToRoman($loop->iteration) . '. ' . $item['quest_type_name'] }}</b>
                                            </td>
                                        </tr>

                                        @php
                                            
                                            $data = \Illuminate\Support\Arr::where($survey->quest, function ($value) use ($item) {
                                                return $value->quest_type_id == $item['id_quest_type'];
                                            });
                                        @endphp


                                        @foreach ($data as $value)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $value->quest }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="custom-control custom-radio mr-3">
                                                            <input type="radio"
                                                                id="yes-{{ $item['quest_type_name'] . $value->id_quest }}"
                                                                name="{{ $item['quest_type_name'] . $value->id_quest }}"
                                                                value="1" class="custom-control-input">
                                                            <label class="custom-control-label"
                                                                for="yes-{{ $item['quest_type_name'] . $value->id_quest }}">YA/ADA</label>
                                                        </div>
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio"
                                                                id="no-{{ $item['quest_type_name'] . $value->id_quest }}"
                                                                name="{{ $item['quest_type_name'] . $value->id_quest }}"
                                                                value="0" class="custom-control-input">
                                                            <label class="custom-control-label"
                                                                for="no-{{ $item['quest_type_name'] . $value->id_quest }}">Tidak</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="text-right">
                            <button class="btn btn-success" id="send" disabled type="submit">Kirim Survey</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            $(function() {


                let radio = $(`input[type=radio]`)
                let button = $('#send')
                radio.each((i, v) => {
                    $(v).on('change', function() {
                        let checkedRadio = $(`input[type=radio]:checked`)

                        if ((radio.length / 2) == checkedRadio.length) {
                            button.prop('disabled', false)
                        }
                    })
                })

                $('#formSurvey').on('submit', function(e) {
                    e.preventDefault()

                    // console.log($(this).serializeArray());

                    ajax("/input-survey", $(this).serialize()).done((res) => {
                        console.log(res);
                    })
                })
            })
        </script>
    @endpush
@endsection
