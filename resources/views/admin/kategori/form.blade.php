<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <form action="" method="POST" class="form-horizontal" id="modal-form">
        @csrf
        @method('POST')
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="nama_kategori" class="col-md-3 control-label">Kategori</label>
                    <div class="col-md-9">
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required autofocus>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <span class="help-block with-errors"></span>
            </div>
        </div>
    </form>
  </div>
</div>







