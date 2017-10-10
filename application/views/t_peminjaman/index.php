<div class="content-wrapper">
  <section class="content">
    <div class="box box-info">
      <div class="box-header">
        <h3 class="box-title">Form Peminjaman Buku Perpustakaan</h3>
      </div>
      <div class="box-body">
          <form method="POST" id="form1">
            <div class="row">
              <div class="form-group col-md-4">
                <label for="nim" class="control-label">NIM :</label>
                  <input type="text" id="nim" name="nim" class="form-control" placeholder="Nomor Induk" required>
                
              </div>
              <div class="form-group col-md-4">
                <label for="nama" class="control-label">Nama Lengkap :</label>
                <input type="text" id="nama" name="nama" placeholder="Nama Lengkap" class="form-control" required readonly>
              </div>
              <div class="form-group col-md-4">
                <label for="th_angkatan" class="control-label">Tahun Angkatan :</label>
                <input type="text" id="th_angkatan" name="th_angkatan" placeholder="Tahun Angkatan" class="form-control" required readonly>
              </div>
            </div>
          </form>

          <div class="box box-info">
            <div class="box-body">
              
                <div class="form-group">
                  <label>Masukan Kode Buku:</label>
                  <input type="text" id="cari_kode_buku" name="cari_kode_buku" placeholder="Masukan Kode Buku Disini" autocomplete="off" autofocus class="form-control">
                </div>  

                <form method="POST" id="form2">
              <table class="table table-bordered" width="100%">
                <thead>
                  <th width="25%">Kode Buku</th>
                  <th>Nama Buku</th>
                  <th width="15%">Jumlah Buku</th>
                  <th></th>
                </thead>
                <tbody id="each-body">

                    <tr id="base" style="display: none;">
                      <td width="25%">
                        <input type="text" id="kode_buku" name="buku[][kode_buku]" class="form-control" readonly>
                      </td>
                      <td><input type="text" id="nama_buku" name="buku[][nama_buku]" class="form-control" placeholder="Nama Buku Yang di Pinjam" readonly></td>
                      <td width="15%">
                        <input type="number" value="1" name="buku[][jumlah]" class="form-control">
                      </td>
                      <td width="5px"><button type="button" onclick="hapusRow(event)" style="vertical-align: bottom;" class="btn btn-danger"><i class="fa fa-close"></i></button></td>
                    </tr>
                    
                </tbody>
              </table>
              <button type="button" onclick="saveall()" class="btn btn-success"><i class="fa fa-save"> Pinjam Buku</i></button>
              </form>
              <br>
            </div>
          </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  $('#nim').keypress(function(event) {
    if (event.charCode == 13) {
      $.ajax({
        'url': '<?= base_url('transaksi/peminjaman/cari') ?>',
        'type': 'POST',
        'dataType': 'json',
        'data': {
        'nim': $('#nim').val()
        },
      })
      .success(function(data) {
        if (data) {
          $('#nama').val(data['nama']);
          $('#th_angkatan').val(data['th_angkatan']);
        }else{
          alert('Data Siswa Tidak Ditemukan');
        }
      });
    }
  });

  function tambahRow(id) {
      var rowBase = $('tr#base');
      var row     = rowBase.clone();

      // delete attribute id="base", biar saat diclone nggk double
      row.attr('id', 'base_' + id);
      row.removeAttr('style');
      rowBase.before(row);

      return row;
    }

    function hapusRow(e) {
      e.preventDefault();

      var btn = $(e.target);
      var row = btn.parents('tr');
      row.remove();
    }

  $('#cari_kode_buku').keypress(function(event) {
    if (event.charCode == 13) {
      $.ajax({
        'url': '<?= base_url('transaksi/peminjaman/caribuku') ?>',
        'type': 'POST',
        'dataType': 'json',
        'data': {
        'kode_buku': $('#cari_kode_buku').val()
        },
      })
      .success(function(data) {
       if (data) {
        tambahRow(data.id);
        $('#base_' + data.id + ' #kode_buku').val(data.id);
        $('#base_' + data.id + ' #nama_buku').val(data.nama);
        $('#cari_kode_buku').val('');
       }else{
        alert('Buku Tidak Ditemukan');
       }
      }); 
    }
  });

  function saveall()
  {
    var form1    = $('#form1').serializeJSON();
    var form2    = $('#form2 :input').serializeJSON();

    form2.buku.pop();

    $.ajax({
      url     : "<?= base_url('transaksi/peminjaman/pinjam')?>",
      type    : 'POST',
      dataType: 'json',
      data    : {
        form1  : form1,
        form2  : form2.buku,
      },
    })
    .done(function() {
      window.location.reload();
    });
  }
</script>