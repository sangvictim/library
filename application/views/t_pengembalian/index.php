<div class="content-wrapper">
  <section class="content">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Form Pengembalian Buku Perpustakaan</h3>
      </div>
      <div class="box-body">
          <div class="row">
            <form method="GET" action="<?= base_url('transaksi/pengembalian') ?>">
              <div class="form-group col-md-4">
                <label for="nim" class="control-label">NIM :</label>
                <input type="text" id="nim" name="nim" placeholder="Nomor Induk" class="form-control" autocomplete="off" value="<?=$this->input->get('nim')?>" autofocus required>
              </div>
              </form>
              <div class="form-group col-md-4">
                <label for="nim" class="control-label">Nama Lengkap :</label>
                <input type="text" id="nama_anggota" name="nama_anggota" placeholder="Nama Lengkap" class="form-control" value="<?= $user != '' ? $user->nama :'' ?>" readonly>
              </div>
              <div class="form-group col-md-4">
                <label for="nim" class="control-label">Tahun Angkatan :</label>
                <input type="text" id="th_angkatan" name="th_angkatan" placeholder="Tahun Angkatan" value="<?= $user != '' ? $user->th_angkatan :'' ?>" class="form-control" required readonly>
              </div>            
          </div>
          <div class="box">
            <div class="box-body">
              <form id="bookform" method="POST">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th class="" width="2%">
                      <input id="inChecked" name="inChecked" type="checkbox"/>
                    </th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Jumlah</th>
                    <th>Tgl Pinjam</th>
                    <th>Denda</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if ($buku != ''): 
                      $jmlhasil = '';
                      $no=1; foreach ($buku as $bk): ?>
                        <tr>
                          <td><?=$no?></td>
                          <td><input type="checkbox" name="buku[][kode_buku]" value="<?= $bk->kode_buku;?>"></td>
                          <td>
                            <input type="text" value="<?= $bk->kode_buku?>" class="form-control" readonly>
                          </td>
                          <td><input type="text" value="<?= $bk->nama_buku?>" class="form-control" readonly></td>
                          <td><input type="text" value="<?= $bk->jumlah?>" class="form-control" readonly></td>
                          <td><input type="text" name="buku[][tgl_pinjam]" value="<?= substr($bk->created_at,0, 10) ?>" class="form-control" readonly></td>
                          <td>
                            <?php
                              // call calemder
                              $kalender   = CAL_GREGORIAN;
                              $tahun      = substr($bk->created_at,0, 4);
                              $bulan      = substr($bk->created_at,5, 2);
                              // take day
                              $hariini    = date('d');
                              $haripinjam = substr($bk->created_at,8, 2);
                              //calc hari pinjam
                              $jmlhari    = cal_days_in_month($kalender, $bulan, $tahun);
                              $bedabulan  = ($jmlhari - $haripinjam) + $hariini;
                              $bulansama  = $hariini - $haripinjam;
                              //variabel
                              $denda      = $hukuman->denda;
                              $maxpinjam  = $hukuman->hari;

                              if ($tahun == date('Y')) {  // pengecekan jika tahun sama
                                if ($bulan == date('m')) { // pengecekan jika bulan sama
                                  $hasil =  $denda * $bulansama - ($denda * $maxpinjam);
                                  if ($hasil > $maxpinjam) {
                                     echo "<input type='text' class='form-control' name='buku[][denda]' readonly value=".number_format($hasil)." >";
                                   }else{
                                     echo "<input type='text' name='buku[][denda]' value='0' class='form-control' readonly>";
                                    } 
                                }else{ // pengecekan jika beda bulan
                                  $hasil =  $denda * $bedabulan - ($denda * $maxpinjam);
                                  if ($hasil > $maxpinjam) {
                                     echo "<input type='text' class='form-control' name='buku[][denda]' readonly value=".number_format($hasil)." >";
                                  }else{
                                     echo "<input type='text' name='buku[][denda]' value='0' class='form-control' readonly>";
                                  }
                                }
                              }else{ // pengecekan jika beda tahun
                                $hasil =  $denda * $bedabulan - ($denda * $maxpinjam);
                                if ($hasil > $maxpinjam) { // pasti beda bulan dong
                                   echo "<input type='text' name='buku[][denda]' class='form-control' readonly value=".number_format($hasil)." >";
                                }else{
                                   echo "<input type='text' name='buku[][denda]' value='0' class='form-control' readonly>";
                                }
                              }
                              
                            ?>
                            
                          </td>
                        </tr>

                      <?php $jmlhasil = $jmlhasil + $hasil; $no++; endforeach;
                    endif ?>
                    <tr>
                      <td colspan="6" align="right"><h4>Jumlah Denda :</h4></td>
                      <td><h4>Rp. <b style="color: red"><?= $jmlhasil <= 0 ? '0' : number_format($jmlhasil)?></b></h4></td>
                    </tr>
                  </tbody>
                </table>
              </form>
              <br>
              <button type="submit" onclick="kembalikan()" class="btn btn-success"><i class="fa fa-refresh"></i> Kembalikan Buku</button>
            </div>
          </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  $("#inChecked").click(function(e){
      $('input').prop('checked',this.checked);
    });

  function kembalikan() {
    var bookform    = $('#bookform :input').serializeJSON();

    $.ajax({
      url: '<?= base_url('transaksi/pengembalian/kembalikan')?>',
      type: 'POST',
      dataType: 'json',
      data: {
        head: {
          nim: $('#nim').val(),
          nama_anggota: $('#nama_anggota').val(),
          th_angkatan: $('#th_angkatan').val(),
        },
        buku: bookform.buku
      },
    })
    .done(function() {
      window.location.reload();
    });
    
  }
</script>
