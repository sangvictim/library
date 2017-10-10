  <div class="content-wrapper">
    <section class="content">
      <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Daftar Stok Buku Perpustakaan</h3>
              <div class="pull-right">
                <a href="<?=base_url('laporan/stok/cetak')?>" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
                <a class="btn btn-success" data-original-title="Export Excel" data-toggle="tooltip" href="<?php echo site_url('laporan/stok/excel');?>" title="Export Excel">
                <i class="fa fa-file-excel-o">
                </i>
                Export Excel
              </a>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="2%">No</th>
                  <th>Kode Buku</th>
                  <th>Nama Buku</th>
                  <th>Penerbit</th>
                  <th>Tahun Terbit</th>
                  <th>Jumlah</th>
                  <th>Stok</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($stok_buku as $st): ?>
                    <tr>
                      <td align="center"><?=$no?></td>
                      <td><?=$st->id?></td>
                      <td><?=$st->nama?></td>
                      <td><?=$st->penerbit?></td>
                      <td><?=$st->th_terbit?></td>
                      <td><?=$st->stok?></td>
                      <td><?=$st->stok2?></td>
                    </tr>
                  <?php $no++; endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
    </section>
  </div>