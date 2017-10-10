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
              <form id="formbuku" action="<?= $buku != '' ? base_url('master/buku/update/').str_replace('%', '-' ,urlencode($this->encrypt->encode($buku->id))) :  base_url('master/buku/insert') ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Kode Buku</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="id" id="id" value="<?= $buku != '' ? $buku->id : ''?>" <?= $buku != '' ? 'readonly' : ''?> placeholder="Kode Buku" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama / Judul</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $buku != '' ? $buku->nama : ''?>" placeholder="Nama / Judul Buku" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Penerbit</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="penerbit" id="penerbit" value="<?= $buku != '' ? $buku->penerbit : ''?>" placeholder="Penerbit Buku" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Tahun Terbit</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" name="th_terbit" id="th_terbit" required>
                      <option value="">- Tahun -</option>
                      <?php
                      for ($i=2000; $i <=date(Y) ; $i++) { ?>
                        <option value="<?=$i?>" <?=$buku->th_terbit == $i ? 'selected' : '' ?> ><?=$i?></option>";
                      <?php }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">stok</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" name="stok" id="stok" value="<?= $buku != '' ? $buku->stok : ''?>" placeholder="Jumlah Buku" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Rak Buku</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" name="rak" id="th_terbit" required>
                      <option value="">- Rak Buku -</option>
                      <?php foreach ($rak as $rak): ?>
                        <option value="<?=$rak->id?>" <?=$buku->rak == $rak->id ? 'selected' : '' ?> ><?=$rak->rak?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Deskripsi Buku</label>
                  <div class="col-sm-9">
                    <textarea name="deskripsi" id="deskripsi" class="form-control" required><?= $buku != '' ? $buku->deskripsi : ''?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Gambar / Foto</label>
                  <div class="col-sm-9">
                    <input type="file" id="gambar"  name="gambar" accept="image/*" class="form-control" onchange="showMyImage(this)" <?= $buku != '' ? '' : 'required'?>>
                    <span><i class="fa fa-info" style="color: red"> Ukuran Foto Max 1 MB !</i></span><br>
                    <img src="<?= base_url('assets/gambar/buku/'.$buku->gambar) ?>" id="thumbnil" alt="avatar" style="width: 150px; height: 200px">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"> Simpan</i></button>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i class="fa fa-close"> Cancel</i></button>
              </div>
              <!-- /.box-footer -->
            </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>

  <script type="text/javascript">
  function showMyImage(fileInput) {
      var files = fileInput.files;
      for (var i = 0; i < files.length; i++) {
          var file = files[i];
          var imageType = /image.*/;
          if (!file.type.match(imageType)) {
              continue;
          }
          var img=document.getElementById("thumbnil");
          img.file = file;
          var reader = new FileReader();
          reader.onload = (function(aImg) {
              return function(e) {
                aImg.src = e.target.result;
              };
          })(img);
          reader.readAsDataURL(file);
      }
  }
</script>