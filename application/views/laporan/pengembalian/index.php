  <div class="content-wrapper">
    <section class="content">
      <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Daftar Pengembalian Buku Perpustakaan</h3>
              <div class="pull-right">
                <button type="button" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
                <button type="button" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</button>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="2%">No</th>
                  <th>Nim</th>
                  <th>Nama Anggota</th>
                  <th>Kode Buku</th>
                  <th>Nama Buku</th>
                  <th>Jumlah</th>
                  <th>Tgl Pinjam</th>
                  <th>Tgl Pengembalian</th>
                  <th>Denda</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($pinjam as $st): ?>
                    <tr>
                      <td align="center"><?=$no?></td>
                      <td><?=$st->nim?></td>
                      <td><?=$st->nama_anggota?></td>
                      <td><?=$st->kode_buku?></td>
                      <td><?=$st->nama_buku?></td>
                      <td><?=$st->jumlah?></td>
                      <td><?=$st->tgl_pinjam?></td>
                      <td><?=substr($st->created_at, 0, 10)?></td>
                      <td>Rp. <?=number_format($st->denda)?></td>
                    </tr>
                  <?php $no++; endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
    </section>
  </div>
  