  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
    <div class="modal fade" id="modalbuku" role="dialog">
        <div class="modal-dialog ">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Hapus Anggota Berdasarkan Tahun Angkatan</h4>
            </div>
            <div class="modal-body">
              <!-- form start -->
            <form id="formbuku" action="<?= base_url('master/anggota/delete')?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Tahun Angkatan</label>
                  <div class="col-md-5">
                    <select class="form-control select2" name="th_angkatan" required>
                      <option value="">- Tahun -</option>
                      <?php foreach ($th_angkatan as $th): ?>
                        <option value="<?=$th->th_angkatan?>"><?=$th->th_angkatan?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div> 
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"> Hapus</i></button>
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i class="fa fa-close"> Cancel</i></button>
              </div>
              <!-- /.box-footer -->
            </form>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <a href="<?= base_url('master/anggota/add')?>" title=""><button type="button" class="btn btn-info"><i class="fa fa-plus"> Tambah Anggota</i></button></a>
      </div>
      <!-- Main row -->
      <!-- /.row -->
      <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Daftar Anggota Perpustakaan</h3>
              <div class="pull-right">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalbuku"><i class="fa fa-trash"> Hapus Angkatan</i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="5px">No</th>
                  <th>NIM</th>
                  <th>Nama Lengkap</th>
                  <th>Tahun Angkatan</th>
                  <th>Jenis Kelamin</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($anggota as $angg): ?>
                    <tr>
                      <td align="center"><?=$no?></td>
                      <td><?=$angg->nim?></td>
                      <td><?=$angg->nama?></td>
                      <td><?=$angg->th_angkatan?></td>
                      <td><?=$angg->jk == 'L' ? 'Laki - Laki' : 'Perempuan'?></td>
                      <td>
                        <a href="<?=base_url('master/anggota/edit/').str_replace('%', '-' ,urlencode($this->encrypt->encode($angg->id)))?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                      </td>
                    </tr>
                  <?php $no++; endforeach ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>

