<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Library</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>bootstrap/css/bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>plugins/select2/select2.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>dist/css/skins/_all-skins.min.css">
  <!-- Gritter -->
  <link rel="stylesheet" href="<?= base_url('assets/');?>gritter/css/jquery.gritter.css">

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?= base_url('')?>" class="navbar-brand"><b>Library</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li ><a href="<?= base_url('')?>">Home <span class="sr-only">(current)</span></a></li>
          </ul>
          <form class="navbar-form navbar-left" role="search" method="GET" action="<?=base_url('search')?>">
            <div class="form-group">
              <input type="text" name="nama" class="form-control" style="width: 500px" id="navbar-search-input" placeholder="Cari Judul Buku" value="<?=$this->input->get('nama')?>">
            </div>
          </form>
          <ul class="nav navbar-nav">
            <li ><a href="#daftarhadir" data-toggle="modal">Daftar Hadir Perpustakaan<span class="sr-only">(current)</span></a></li>
          </ul>
        </div>
        <div class="navbar-custom-menu">
        </div>
      </div>
    </nav>
  </header>
  <div id="daftarhadir" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Form Daftar Hadir Perpustakaan</h4>
            </div>
            <form method="POST">
              <div class="modal-body">
                    <div class="form-group">
                      <label>Nama Pengunjung :</label>
                      <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Pengunjung" autofocus>
                    </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" onclick="pengunjung()" class="btn btn-success pull-left">Berkunjung</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
  <div class="content-wrapper" style=" padding-top: 80px;">
    <div class="container ">
        <?php foreach ($filter as $fl): ?>
      <center>
          <section class="content col-md-9" style=" margin-top: -35px;">
            <div class="box box-default col-md-offset-2">
              <div class="box-header with-border">
                <h3 class="box-title"><font color="#3c8dbc"><?=$fl->nama?></font></h3>
              </div>
              <div class="box-body">
                <div class="col-md-3">
                  <img src="<?=base_url('assets/gambar/buku/').$fl->gambar?>" style="width: 150px; height: 200px">
                </div>
                <div class="col-md-9 pull-left">
                  <table class="table">
                    <tr>
                      <td width="20%">Kode Buku</td>
                      <td width="1%">:</td>
                      <td><?=$fl->id?></td>
                    </tr>
                    <tr>
                      <td>Rak Buku</td>
                      <td>:</td>
                      <td><?=$fl->rak?></td>
                    </tr>
                    <tr>
                      <td>Penerbit</td>
                      <td>:</td>
                      <td><?=$fl->penerbit?></td>
                    </tr>
                    <tr>
                      <td>Tahun Terbit</td>
                      <td>:</td>
                      <td><?=$fl->th_terbit?></td>
                    </tr>
                    <tr>
                      <td>Stok Buku</td>
                      <td>:</td>
                      <td><?=$fl->jumlah?></td>
                    </tr>
                    <tr>
                      <td>Deskripsi</td>
                      <td>:</td>
                      <td><?=$fl->deskripsi?></td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </section>
      </center>
        <?php endforeach ?>
    </div>
  </div>
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; 2017 <a href="http://facebook.com/sangvictim">Setyo Purnomo</a>.</strong> All rights
      reserved.
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?= base_url('assets/')?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url('assets/')?>bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/') ?>plugins/select2/select2.full.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url('assets/')?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url('assets/')?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/')?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/')?>dist/js/demo.js"></script>
<!-- Gritter-->
<script src="<?= base_url('assets/')?>gritter/js/jquery.gritter.min.js"></script>
<script type="text/javascript">
      function suksesPesan($msg){
        var unique_id = $.gritter.add({
          title: 'Berhasil!',
          text: '<i class ="fa fa-check"></i> '+$msg+'!',
          sticky: true,
          class_name: 'my-sticky-class'
        });

    setTimeout(function(){
      $.gritter.remove(unique_id, {
        fade: true,
        speed: 'slow'
      });
    }, 7000)


    return false;
  }

  $(document).ready(function() {
    $(".select2").select2();
    <?php if ($this->session->flashdata('sf')) {$pesan = $this->session->flashdata('sf');?>
    suksesPesan('<?php echo $pesan;?>');
    <?php }?>
  });
</script>
<script>
  function pengunjung() {
    $.ajax({
      url: '<?= base_url('search/daftarhadir')?>',
      type: 'POST',
      dataType: 'json',
      data: {nama: $('#nama').val()},
    })
    .done(function() {
      window.location.reload();
    })
    
  }
</script>
</body>
</html>
