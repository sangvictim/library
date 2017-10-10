  <div class="content-wrapper">
    <section class="content">
      <div class="form-group">
        <a href="<?= base_url('master/buku/add') ?>" title="Tambah Buku"><button type="button" class="btn btn-info"><i class="fa fa-plus"> Tambah Buku</i></button></a>
      </div>
      <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th width="3%">No</th>
                  <th>Kode Buku</th>
                  <th>Nama / Judul</th>
                  <th>Penerbit</th>
                  <th>Tahun Terbit</th>
                  <th>Stok Buku</th>
                  <th>Rak Buku</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($buku as $bk): ?>
                    <tr>
                      <td align="center"><?=$no?></td>
                      <td><?=$bk->id?></td>
                      <td><?=$bk->nama?></td>
                      <td><?=$bk->penerbit?></td>
                      <td><?=$bk->th_terbit?></td>
                      <td><?=$bk->stok?></td>
                      <td><?=$bk->nama_rak?></td>
                      <td>
                        <a href="<?=base_url('master/buku/edit/').str_replace('%', '-' ,urlencode($this->encrypt->encode($bk->id))) ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                        <a href="<?=base_url('master/buku/delete/').str_replace('%', '-' ,urlencode($this->encrypt->encode($bk->id))) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php $no++; endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
    </section>
  </div>