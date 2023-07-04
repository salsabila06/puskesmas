<!-- Modal -->
<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Puskesmas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="formAdd">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="fullname">Fullname</label>
                            <input type="text" class="form-control" name="fullname" tabindex="1" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" tabindex="2">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" tabindex="3">
                        </div>
                        <div class="form-group">
                            <label for="faskes_name">Nama Puskesmas</label>
                            <input type="text" class="form-control" name="faskes_name" tabindex="4">
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <label for="faskes_type">Tipe Puskesmas</label>
                                <select class="custom-select faskes_type" name="faskes_type" tabindex="5">
                                    <option selected disabled>Pilih Tipe</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="district">Kecamatan</label>
                                <select class="custom-select district" name="district" tabindex="6">
                                    <option selected disabled>Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="faskes_establish" class="control-label">Tanggal Dibangun</label>
                            <input type="date" class="form-control" name="faskes_establish" tabindex="7">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" class="form-control" name="password" tabindex="8">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="control-label">Konfimasi Password</label>
                            <input type="password" class="form-control" name="password_confirmation" tabindex="9">
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
