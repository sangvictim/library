<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="box box-info">
          <div class="box-header">
            <center><h3 class="box-title">Form Pengaturan Denda</h3></center>
          </div>
          <div class="box-body">
            <hr>
            <form method="POST">
                <div class="form-group">
                  <label class="control-label">Jumlah Denda (Rp.)</label>
                  <input type="number" name="denda" class="form-control" value="<?= $denda->denda ?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Maksimal Peminjaman (Hari)</label>
                  <input type="number" name="hari" class="form-control" value="<?= $denda->hari ?>" required>
                </div>
                <div>
                  <center><button type="submit" name="simpan" class="btn btn-success btn-lrg"><i class="fa fa-save"></i> Simpan</button></center>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div> 
  </section>
</div>