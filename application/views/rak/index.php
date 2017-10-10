<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-5">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Form Rak Buku Perpustakaan</h3>
          </div>
          <div class="box-body">
            <form action="<?= $editrak != '' ? base_url('master/rak/updaterak/').str_replace('%', '-' ,urlencode($this->encrypt->encode($editrak->id))) : base_url('master/rak/insertrak') ?>" method="post" accept-charset="utf-8">
              <div class="form-group">
                <label for="rak" class="control-label">Rak Buku :</label>
                <input type="text" name="rak" placeholder="Rak Buku" class="form-control" value="<?=$editrak != '' ? $editrak->rak : ''?>" autofocus required>
              </div>
              <button type="submit" class="btn btn-success"><i class="fa fa-save"> Simpan</i></button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-7">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Daftar Rak Buku Perpustakaan</h3>
          </div>
          <div class="box-body">
            <table id="example2" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th width="5%">No</th>
                <th width="60%">Rak Buku</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($rak as $r): ?>
                  <tr>
                    <td align="center"><?=$no?></td>
                    <td><?=$r->rak?></td>
                    <td>
                      <a href="<?= base_url('master/rak/editrak/').str_replace('%', '-' ,urlencode($this->encrypt->encode($r->id))) ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                      <a href="<?= base_url('master/rak/deleterak/').str_replace('%', '-' ,urlencode($this->encrypt->encode($r->id))) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php $no++; endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> 
  </section>
</div>