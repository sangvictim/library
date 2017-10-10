<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="box box-info">
          <div class="box-header">
            <center><h3 class="box-title">Form Pengaturan Aplikasi</h3></center>
          </div>
          <div class="box-body">
            <hr>
            <form method="POST">
                <div class="form-group">
                  <label class="control-label">Nama Instansi :</label>
                  <input type="text" name="instansi" placeholder="Nama Instansi" class="form-control" value="<?= $setting->instansi ?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Alamat Instansi :</label>
                  <textarea name="alamat" class="form-control" required><?= $setting->alamat ?></textarea>
                </div>
                <div class="form-group">
                  <label class="control-label">Nama Kepala Sekolah :</label>
                  <input type="text" name="kepsek" placeholder="Nama Kepala Sekolah" class="form-control" value="<?= $setting->kepsek ?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Nama Petugas Perpustakaan :</label>
                  <input type="text" name="petugas" placeholder="Nama Petugas Perpustakaan" class="form-control" value="<?= $setting->petugas ?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Provinsi :</label>
                  <input type="text" name="prov" placeholder="Provinsi" class="form-control" value="<?= $setting->prov ?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Kabupaten :</label>
                  <input type="text" name="kab" placeholder="Kabupaten" class="form-control" value="<?= $setting->kab ?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Kecamatan :</label>
                  <input type="text" name="kec" placeholder="Kecamatan" class="form-control" value="<?= $setting->kec ?>" required>
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