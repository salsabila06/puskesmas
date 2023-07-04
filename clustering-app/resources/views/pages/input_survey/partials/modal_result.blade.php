<!-- Modal -->
<div class="modal fade" id="modal_result" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hasil <span class="title-survey"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>Nama Puskesmas : {{ $faskes->faskes_name }}</h6>
                <h6>Kode Puskesmas : {{ $faskes->faskes_code }}</h6>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Parameter</th>
                            <th>Nilai (%)</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
