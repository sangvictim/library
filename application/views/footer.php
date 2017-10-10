<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2017 <a href="http://facebook.com/sangvictim">Setyo Purnomo</a>.</strong> All rights
    reserved.
  </footer>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>

<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url('assets/')?>bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/') ?>plugins/select2/select2.full.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url('assets/')?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/')?>dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/')?>plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url('assets/')?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url('assets/')?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?= base_url('assets/')?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?= base_url('assets/')?>plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/')?>dist/js/demo.js"></script>

<script src="<?= base_url('assets/')?>gritter/js/jquery.gritter.min.js"></script>

<script src="<?= base_url('assets/')?>serializejson/jquery.serializejson.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/')?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?= base_url('assets/')?>plugins/chartjs/Chart.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url('assets/')?>plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript">
      function suksesPesan($msg){
        var unique_id = $.gritter.add({
          title: 'Notice !',
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
  $(function () {
    $("#example1").DataTable({
      "scrollX": true
    });
    $('#example2').DataTable({
      "scrollX": true
    });
  });
</script>

</body>
</html>