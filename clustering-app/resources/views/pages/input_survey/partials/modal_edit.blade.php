<!-- Modal -->
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Data Pertanyaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="formEdit">
                    <div class="container-fluid">
                        <input type="hidden" id="id_survey" name="id_survey">
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <textarea type="text" name="title" id="title" class="form-control h-100" rows="4"
                                aria-describedby="helpId"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="date_publish">Tanggal Terbit</label>
                            <input type="date" min="{{ date('Y-m-d') }}" id="date_publish" name="date_publish"
                                class="form-control" aria-describedby="helpId">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
