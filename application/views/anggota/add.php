  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Form Anggota Perpustakaan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form action="<?= $anggota != '' ? base_url('master/anggota/update/').str_replace('%', '-' ,urlencode($this->encrypt->encode($anggota->id))) : base_url('master/anggota/insert') ?> " method="post" accept-charset="utf-8">
                <div class="form-group">
                  <label for="nim" class="control-label">NIM :</label>
                  <input type="text" name="nim" placeholder="Nomor Induk" class="form-control" value="<?= $anggota != '' ? $anggota->nim : '' ?>" <?= $anggota != '' ? 'readonly' : '' ?> required>
                </div>
                <div class="form-group">
                  <label for="nama" class="control-label">Nama Lengkap :</label>
                  <input type="text" name="nama" placeholder="Nama Lengkap" value="<?= $anggota != '' ? $anggota->nama : '' ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="kelas" class="control-label">Tahun Angkatan :</label>
                  <select name="th_angkatan" class="form-control select2" required>
                    <option value="">- Pilih Tahun Angkatan -</option>
                    <?php
                      for ($i=2012; $i <= date('Y') ; $i++) {  ?>
                        <option value="<?=$i?>" <?= $anggota->th_angkatan == $i ? 'selected' : '' ?> ><?=$i?></option>
                      <?php }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="jk" class="control-label">Jenis Kelamin :</label>
                  <select name="jk" class="form-control select2" required>
                    <option value="">- Pilih Kelas -</option>
                    <option value="L" <?= $anggota->jk == 'L' ? 'selected' : ''?>>Laki - Laki</option>
                    <option value="P" <?= $anggota->jk == 'P' ? 'selected' : ''?>>Perempuan</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"> <?= $anggota != '' ? 'Update' : 'Simpan' ?></i></button>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>