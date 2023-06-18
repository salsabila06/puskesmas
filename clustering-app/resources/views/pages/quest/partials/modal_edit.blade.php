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
                        <input type="hidden" id="id_quest" name="id_quest">
                        <div class="form-group">
                            <label for="quest">Pertanyaan</label>
                            <textarea type="text" name="quest" rows="4" id="quest" class="form-control h-100"
                                aria-describedby="helpId"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="quest_type_id">Tipe</label>
                            <select class="custom-select quest_type_id" name="quest_type_id" id="quest_type_id">
                                <option selected disabled>Pilih Tipe</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="target">Tipe Puskesmas</label>
                            <select class="custom-select faskes_type" name="target" id="target">
                                <option selected disabled>Pilih Tipe</option>
                                <option value="0">Semua</option>
                            </select>
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
