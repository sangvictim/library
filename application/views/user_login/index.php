<div class="content-wrapper">
  <section class="content">
    <div class="row">
      <div class="col-md-4">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Form User Perpustakaan</h3>
          </div>
          <div class="box-body">
            <form method="post" accept-charset="utf-8">
              <div class="form-group">
                <label for="nik" class="control-label">NIK :</label>
                <input type="text" name="nik" placeholder="Nomor Induk Karyawan" value="<?= $find != '' ? $find->nik: '' ?>" class="form-control" autofocus required>
              </div>
              <div class="form-group">
                <label for="nama" class="control-label">Nama Lengkap :</label>
                <input type="text" name="nama" placeholder="Nama Lengkap" value="<?= $find != '' ? $find->nama: '' ?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="username" class="control-label">Username :</label>
                <input type="text" name="username" placeholder="Username" value="<?= $find != '' ? $find->username: '' ?>" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="password" class="control-label">Password :</label>
                <input type="password" name="password" placeholder="Password" class="form-control" <?= $find != '' ? '': 'required' ?>>
                <?php if ($find != ''): ?>
                  <small style="color: red"><i class="fa fa-info-circle"> Kosongi Jika Tidak Ingin Dirubah</i></small>
                <?php endif ?>
              </div>
              <div class="form-group">
                <label for="re_password" class="control-label">Ulangi Password :</label>
                <input type="password" name="re_password" placeholder="Ulangi Password" class="form-control" <?= $find != '' ? '': 'required' ?>>
                <?php if ($find != ''): ?>
                  <small style="color: red"><i class="fa fa-info-circle"> Kosongi Jika Tidak Ingin Dirubah</i></small>
                <?php endif ?>
              </div>
              <div class="form-group">
                <label for="hak_akses" class="control-label">Hak Akses :</label>
                <select name="akses" class="form-control select2" required>
                  <option value=""></option>
                  <option value="0" <?= $find->akses == '0' ? 'selected' : '' ?> >Administrator</option>
                  <option value="1" <?= $find->akses == '1' ? 'selected' : '' ?>>Petugas</option>
                </select>
              </div>
              <button type="submit" name="simpan" class="btn btn-success"><i class="fa fa-save"> Simpan</i></button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">Daftar User Perpustakaan</h3>
          </div>
          <div class="box-body">
            <table id="example2" class="table table-bordered table-striped" width="100%">
              <thead>
              <tr>
                <th width="5%">No</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Hak Akses</th>
                <th>Dibuat</th>
                <th>Akses</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($user as $usr): ?>
                  <tr>
                    <td align="center"><?= $no?></td>
                    <td><?= $usr->nik?></td>
                    <td><?= $usr->nama?></td>
                    <td><?= $usr->akses == '0' ? 'Administrator' : 'Petugas' ?></td>
                    <td><?= substr($usr->created_at, 0, 10) ?></td>
                    <td>
                      <a href="<?= base_url('pengaturan/user_login/edit/').str_replace('%', '-' ,urlencode($this->encrypt->encode($usr->id))) ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                      <a href="<?= base_url('pengaturan/user_login/delete/').str_replace('%', '-' ,urlencode($this->encrypt->encode($usr->id))) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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