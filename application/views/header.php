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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>plugins/font-awesome/css/font-awesome.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>plugins/select2/select2.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>plugins/iCheck/square/blue.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>dist/css/AdminLTE.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>plugins/datatables/dataTables.bootstrap.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/');?>gritter/css/jquery.gritter.css">
  <!-- jQuery 2.2.3 -->
<script src="<?= base_url('assets/')?>plugins/jQuery/jquery-2.2.3.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">

<div class="modal fade" id="changepass" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Ganti Password</h4>
      </div>
      <form method="post" action="<?=base_url('pengaturan/user_login/changepass/'.$data_user->id)?>">
        <div class="modal-body">
          <table width="100%">
            <tr>
              <td>
                <div class="form-group">
                  <label>Password Baru</label>
                  <input type="Password" name="password" class="form-control" placeholder="Password Baru" required>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="form-group">
                  <label>Ulangi Password</label>
                  <input type="Password" name="repassword" class="form-control" placeholder="Ulangi Password" required>
                </div>
              </td>
            </tr>
            <tr>
              <td align="center"><span style="color: red"><i class="fa fa-info"> Kosongi Password Jika Tidak Ingin Dirubah</i></span></td>
            </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success pull-left"><i class="fa fa-save"></i> Simpan</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="aboutme" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <center><h4 class="modal-title">Developer Team Phoenix Library V.1</h4></center>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
            <img src="<?= base_url('assets/')?>dist/img/user2-160x160.jpg" style="width: 150px; height: 200px">
          </div>
          <div class="col-md-8">
            <table class="table">
              <tr>
                <td width="20%">Nama</td>
                <td width="1%">:</td>
                <td>Sang Victim</td>
              </tr>
              <tr>
                <td>Notelp</td>
                <td>:</td>
                <td>085726017766</td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>Belik</td>
              </tr>
            </table>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-3">
            <img src="<?= base_url('assets/')?>dist/img/user2-160x160.jpg" style="width: 150px; height: 200px">
          </div>
          <div class="col-md-8">
            <table class="table">
              <tr>
                <td width="20%">Nama</td>
                <td width="1%">:</td>
                <td>Sang Victim</td>
              </tr>
              <tr>
                <td>Notelp</td>
                <td>:</td>
                <td>085726017766</td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>Belik</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="wrapper">
  <header class="main-header">
    <a href="<?= base_url('')?>" class="logo">
      <span class="logo-mini"><b>P</b>L</span>
      <span class="logo-lg"><b>Phoenix</b> Library V.1</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><b><?= $data_user->nama?></b></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?= base_url('assets/')?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?= $data_user->nama?>
                  <small><?= $data_user->akses == '0' ? 'Administrator' : 'Petugas'?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="javascript:;" data-toggle="modal" data-target="#changepass" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Ganti Password</a>
                </div>
                <div class="pull-right">
                  <a href="<?=base_url('login/logout')?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('assets/')?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $data_user->nama?></p>
          <h4><a href="#"><i class="fa fa-circle text-success"></i> <?= $data_user->akses == '0' ? 'Administrator' : 'Petugas'?></a></h4>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class="header">MENU AKSES PETUGAS</li>
        <li class="active treeview">
          <a href="<?=base_url('')?>">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-hand-lizard-o"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('transaksi/peminjaman')?>"><i class="fa fa-circle-o"></i> Peminjaman</a></li>
            <li><a href="<?= base_url('transaksi/pengembalian')?>"><i class="fa fa-circle-o"></i> Pengembalian</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder-open-o"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('laporan/stok')?>"><i class="fa fa-circle-o"></i> Stok Buku</a></li>
            <li><a href="<?= base_url('laporan/peminjaman')?>"><i class="fa fa-circle-o"></i> Peminjaman</a></li>
            <li><a href="<?= base_url('laporan/pengembalian')?>"><i class="fa fa-circle-o"></i> Pengembalian</a></li>
          </ul>
        </li>
        <?php if ($data_user->akses == '0'): ?>
          <li class="header">AKSES ADMINISTRATOR</li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Master</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('master/anggota')?>"><i class="fa fa-circle-o"></i> Anggota</a></li>
            <li><a href="<?= base_url('master/buku')?>"><i class="fa fa-circle-o"></i> Buku</a></li>
            <li><a href="<?= base_url('master/denda')?>"><i class="fa fa-circle-o"></i> Denda</a></li>
            <li><a href="<?= base_url('master/rak')?>"><i class="fa fa-circle-o"></i> Rak</a></li>
          </ul>
        </li>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-gear"></i> <span>PENGATURAN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('pengaturan/user_login') ?>"><i class="fa fa-circle-o"></i> Pengaturan User</a></li>
            <li><a href="<?= base_url('pengaturan/aplikasi') ?>"><i class="fa fa-circle-o"></i> Aplikasi</a></li>
          </ul>
        </li>
        <?php endif ?>
        <li class="header">BANTUAN</li>
        <li class="active treeview">
          <a href="<?=base_url('')?>">
            <i class="fa fa-mouse-pointer"></i> <span>Panduan</span>
          </a>
        </li>
        <li class="active treeview">
          <a href="javascript:;" data-toggle="modal" data-target="#aboutme">
            <i class="fa  fa-adn"></i> <span>Tentang Kami</span>
          </a>
        </li>
      </ul>
    </section>
  </aside>
   